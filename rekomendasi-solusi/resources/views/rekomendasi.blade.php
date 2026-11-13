@extends('layouts.app')

@section('title', 'Rekomendasi Solusi IT')

@section('content')
    <section class="hero">
        <h1>Sistem Rekomendasi Solusi Kasus IT</h1>
        <p>Jelaskan masalah yang Anda alami. Sistem akan mencari kasus serupa dan menampilkan solusinya.</p>
    </section>

    @if (session('sukses'))
        <div class="alert">{{ session('sukses') }}</div>
    @endif

    <form method="POST" action="/cari" class="card" id="form-cari">
        @csrf
        <div class="field" style="margin-bottom:0">
            <label for="kasus">Deskripsi kasus</label>
            <textarea id="kasus" name="kasus" rows="4" required
                placeholder="Contoh: tidak bisa submit cuti tahunan, muncul error">{{ $input }}</textarea>
            @error('kasus') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="chips">
            <span>Coba contoh:</span>
            <button type="button" class="chip">email kontrak tidak terkirim</button>
            <button type="button" class="chip">error 419 page expired saat simpan</button>
            <button type="button" class="chip">laporan sangat lambat saat dibuka</button>
            <button type="button" class="chip">user tidak bisa mark location</button>
        </div>

        <div class="actions">
            <button type="submit" class="btn" id="btn-cari">Cari Solusi</button>
            <a href="/kasus/create" class="btn btn-ghost">+ Tambah kasus baru</a>
        </div>
        <p class="hint">Tips: sebutkan modul, aksi, dan pesan error agar hasil lebih akurat.</p>
    </form>

    @if (!is_null($hasil))
        <div class="section-title">
            <h2>Hasil Rekomendasi</h2>
            <small>{{ count($hasil) }} kasus ditemukan</small>
        </div>

        @forelse ($hasil as $i => $h)
            @php
                $level = $h['skor'] >= 35 ? 'good' : ($h['skor'] >= 20 ? 'mid' : 'low');
                $teks  = ['good' => 'Sangat mirip', 'mid' => 'Cukup mirip', 'low' => 'Kemiripan rendah'][$level];
            @endphp
            <article class="card result">
                <div class="result-head">
                    <div style="display:flex;align-items:center;gap:10px">
                        <span class="rank">{{ $i + 1 }}</span>
                        <span class="badge {{ $level }}">{{ $teks }} &middot; {{ $h['skor'] }}%</span>
                    </div>
                </div>
                <div class="meter"><i class="{{ $level }}" style="width: {{ min(100, max(4, $h['skor'])) }}%"></i></div>

                <div class="label">Kasus mirip</div>
                <p class="kasus">{{ $h['kasus'] }}</p>

                <div class="label">Solusi</div>
                <div class="solusi" id="solusi-{{ $i }}">{{ $h['solusi'] }}</div>

                <button type="button" class="btn btn-ghost copy" data-target="solusi-{{ $i }}">Salin solusi</button>

                @if ($level === 'low')
                    <p class="hint">Kemiripan rendah, solusi ini mungkin kurang relevan.</p>
                @endif
            </article>
        @empty
            <div class="card empty">
                <div class="icon">&#128269;</div>
                <strong>Belum ditemukan kasus yang cukup mirip</strong>
                <p>Coba deskripsikan lebih spesifik (sebutkan modul, aksi, dan pesan error),
                   atau tambahkan kasus ini ke basis pengetahuan.</p>
                <p style="margin-top:16px"><a href="/kasus/create" class="btn">Tambah kasus ini</a></p>
            </div>
        @endforelse
    @endif
@endsection

@push('scripts')
<script>
    // Isi textarea dari contoh
    document.querySelectorAll('.chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            var box = document.getElementById('kasus');
            box.value = chip.textContent.trim();
            box.focus();
        });
    });

    // Salin solusi
    document.querySelectorAll('.copy').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var teks = document.getElementById(btn.dataset.target).innerText;
            navigator.clipboard.writeText(teks).then(function () {
                var awal = btn.textContent;
                btn.textContent = 'Tersalin!';
                setTimeout(function () { btn.textContent = awal; }, 1500);
            });
        });
    });

    // Status loading saat mencari
    document.getElementById('form-cari').addEventListener('submit', function () {
        var b = document.getElementById('btn-cari');
        b.disabled = true;
        b.textContent = 'Mencari...';
    });
</script>
@endpush