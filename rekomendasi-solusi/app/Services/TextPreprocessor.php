<?php

namespace App\Services;

use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;

class TextPreprocessor
{
    private $stemmer;
    private $stopword;

    public function __construct()
    {
        $this->stemmer  = (new StemmerFactory())->createStemmer();
        $this->stopword = (new StopWordRemoverFactory())->createStopWordRemover();
    }

    /** Hasil berupa string bersih, untuk disimpan di database */
    public function process(string $text): string
    {
        return implode(' ', $this->tokenize($text));
    }

    /** Hasil berupa array token */
    public function tokenize(string $text): array
    {
        $text = mb_strtolower($text);
        $text = preg_replace('/\b\d{5,}\b/', ' ', $text);       // buang angka panjang (NIK, dll)
        $text = preg_replace('/[^a-z0-9_\-\s]/u', ' ', $text);  // buang tanda baca, kode seperti ka-001 tetap utuh
        $text = $this->stopword->remove($text);                 // hapus kata umum (yang, di, dan, ...)
        $text = $this->stemmer->stem($text);                    // ubah ke kata dasar

        $tokens = preg_split('/\s+/', trim($text));
        return array_values(array_filter($tokens, fn ($t) => mb_strlen($t) > 1));
    }
}