@extends('layouts.app')

@section('title', 'Tambah Kasus')

@section('content')
    <section class="hero">
        <h1>Tambah Kasus Baru</h1>
        <p>Kasus yang Anda simpan menjadi basis pengetahuan. Makin banyak kasus, makin akurat rekomendasinya.</p>
    </section>

    <form method="POST" action="/kasus" class="card">
        @csrf

        <div class="field">
            <label for="user_id">User ID</label>
            <input type="text" id="user_id" name="user_id" value="{{ old('user_id') }}" required>
            @error('user_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="kasus">Kasus</label>
            <textarea id="kasus" name="kasus" rows="4" required
                placeholder="Tulis gejala dan pesan error. Jangan cantumkan NIK atau nama karyawan.">{{ old('kasus') }}</textarea>
            @error('kasus') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="solusi">Solusi</label>
            <textarea id="solusi" name="solusi" rows="5" required
                placeholder="Format yang disarankan: Penyebab: ... Solusi: ...">{{ old('solusi') }}</textarea>
            @error('solusi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="actions">
            <button type="submit" class="btn">Simpan kasus</button>
            <a href="/" class="btn btn-ghost">Kembali</a>
        </div>
    </form>
@endsection