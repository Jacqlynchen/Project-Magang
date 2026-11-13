<?php

namespace App\Services;

use App\Models\KasusIt;

class SolutionRecommender
{
    public function __construct(private TextPreprocessor $pre) {}

    /**
     * @param string $metode 'euclidean' | 'minkowski' | 'cosine'
     * @param float  $p      orde Minkowski (p=1 Manhattan, p=2 Euclidean, p=3 dst), hanya dipakai bila metode = minkowski
     */
    public function recommend(string $newCase, int $top = 3, string $metode = 'euclidean', float $p = 3): array
    {
        $cases = KasusIt::all();
        if ($cases->isEmpty()) {
            return [];
        }

        // 1. Token semua dokumen
        $docs = [];
        foreach ($cases as $c) {
            $docs[$c->id] = array_values(array_filter(explode(' ', (string) $c->kasus_olahan)));
        }
        $N = count($docs);

        // 2. Document Frequency: berapa dokumen yang memuat tiap kata
        $df = [];
        foreach ($docs as $tokens) {
            foreach (array_unique($tokens) as $t) {
                $df[$t] = ($df[$t] ?? 0) + 1;
            }
        }

        // 3. IDF (versi smoothing) dan pembentuk vektor TF-IDF (dinormalisasi)
        $idf = fn ($t) => log((1 + $N) / (1 + ($df[$t] ?? 0))) + 1;

        $toVector = function (array $tokens) use ($idf) {
            $total = count($tokens) ?: 1;
            $vec = [];
            foreach (array_count_values($tokens) as $t => $count) {
                $vec[$t] = ($count / $total) * $idf($t);   // TF * IDF
            }

            // Normalisasi: panjang vektor dibuat 1
            $norm = sqrt(array_sum(array_map(fn ($x) => $x * $x, $vec)));
            if ($norm > 0) {
                foreach ($vec as $t => $v) {
                    $vec[$t] = $v / $norm;
                }
            }
            return $vec;
        };

        // 4. Vektor kasus baru
        $queryVec = $toVector($this->pre->tokenize($newCase));

        // 5. Hitung kedekatan ke setiap kasus lama (skor 0-1, makin besar makin mirip)
        $scores = [];
        foreach ($docs as $id => $tokens) {
            $docVec = $toVector($tokens);

            $scores[$id] = match ($metode) {
                'cosine'    => $this->cosine($queryVec, $docVec),                       // pembanding
                'minkowski' => $this->minkowskiSimilarity($queryVec, $docVec, $p),      // BARU
                default     => $this->euclideanSimilarity($queryVec, $docVec),          // Euclidean
            };
        }
        arsort($scores);

        // 6. Ambil top N, solusi yang sama hanya tampil sekali
        $result = [];
        $seen   = [];

        foreach ($scores as $id => $score) {
            if ($score < 0.10) {
                break;
            }

            $case = $cases->firstWhere('id', $id);
            $key  = md5($case->solusi);

            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;

            $result[] = [
                'kasus'  => $case->kasus,
                'solusi' => $case->solusi,
                'skor'   => round($score * 100, 1),
            ];

            if (count($result) >= $top) {
                break;
            }
        }

        return $result;
    }

    /* ---------------------------------------------------------------
     |  EUCLIDEAN (tetap ada, tidak dihapus)
     * ------------------------------------------------------------- */

    /** Jarak Euclidean: akar dari jumlah kuadrat selisih (makin kecil = makin mirip) */
    private function euclidean(array $a, array $b): float
    {
        $sum = 0.0;
        foreach (array_unique(array_merge(array_keys($a), array_keys($b))) as $t) {
            $diff = ($a[$t] ?? 0) - ($b[$t] ?? 0);
            $sum += $diff * $diff;
        }
        return sqrt($sum);
    }

    /** Ubah jarak Euclidean menjadi skor 0-1 (1 = identik) */
    private function euclideanSimilarity(array $a, array $b): float
    {
        $d = $this->euclidean($a, $b);

        $maxD = sqrt(
            array_sum(array_map(fn ($x) => $x * $x, $a)) +
            array_sum(array_map(fn ($x) => $x * $x, $b))
        );

        return $maxD > 0 ? max(0.0, 1 - ($d / $maxD)) : 0.0;
    }

    /* ---------------------------------------------------------------
     |  MINKOWSKI (BARU, fungsi terpisah)
     * ------------------------------------------------------------- */

    /**
     * Jarak Minkowski orde p: (jumlah |selisih|^p) ^ (1/p)
     * p = 1 -> Manhattan, p = 2 -> sama dengan Euclidean, p = 3 dst.
     */
    private function minkowski(array $a, array $b, float $p): float
    {
        $sum = 0.0;
        foreach (array_unique(array_merge(array_keys($a), array_keys($b))) as $t) {
            $sum += abs(($a[$t] ?? 0) - ($b[$t] ?? 0)) ** $p;
        }
        return $sum ** (1 / $p);
    }

    /** Ubah jarak Minkowski menjadi skor 0-1 (1 = identik) */
    private function minkowskiSimilarity(array $a, array $b, float $p): float
    {
        $d = $this->minkowski($a, $b, $p);

        // jarak terjauh: dua vektor yang tidak punya kata yang sama
        $maxD = (
            array_sum(array_map(fn ($x) => abs($x) ** $p, $a)) +
            array_sum(array_map(fn ($x) => abs($x) ** $p, $b))
        ) ** (1 / $p);

        return $maxD > 0 ? max(0.0, 1 - ($d / $maxD)) : 0.0;
    }

    /* ---------------------------------------------------------------
     |  COSINE (pembanding)
     * ------------------------------------------------------------- */
    private function cosine(array $a, array $b): float
    {
        $dot = 0.0;
        foreach ($a as $t => $v) {
            if (isset($b[$t])) {
                $dot += $v * $b[$t];
            }
        }
        $na = sqrt(array_sum(array_map(fn ($x) => $x * $x, $a)));
        $nb = sqrt(array_sum(array_map(fn ($x) => $x * $x, $b)));

        return ($na > 0 && $nb > 0) ? $dot / ($na * $nb) : 0.0;
    }
}