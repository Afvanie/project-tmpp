@extends('layouts.app')

@section(
    'title',
    'Profil D-IV Teknik Mesin Produksi dan Perawatan'
)

@section('content')

    {{-- ========================================================= --}}
    {{-- HERO PROFIL --}}
    {{-- ========================================================= --}}

    @include('components.profile.hero')


    {{-- ========================================================= --}}
    {{-- GAMBARAN UMUM PROGRAM STUDI --}}
    {{-- ========================================================= --}}

    @include('components.profile.overview')


    {{-- ========================================================= --}}
    {{-- SEJARAH PROGRAM STUDI --}}
    {{-- ========================================================= --}}
    {{-- Otomatis tidak tampil jika belum memiliki materi. --}}

    @include('components.profile.history')


    {{-- ========================================================= --}}
    {{-- VISI DAN MISI --}}
    {{-- Slug database: visi-misi --}}
    {{-- ========================================================= --}}

    @include('components.profile.vision-mission', [
        'section' => $profileSections['visi-misi'] ?? null,
    ])


    {{-- ========================================================= --}}
    {{-- TUJUAN PROGRAM STUDI --}}
    {{-- Slug database: tujuan-prodi --}}
    {{-- Otomatis tidak tampil jika item masih kosong. --}}
    {{-- ========================================================= --}}

    @include('components.profile.tujuan-prodi', [
        'section' => $profileSections['tujuan-prodi'] ?? null,
    ])


    {{-- ========================================================= --}}
    {{-- PROFIL PROFESIONAL MANDIRI --}}
    {{-- Slug database: ppm --}}
    {{-- ========================================================= --}}

    @include('components.profile.ppm', [
        'section' => $profileSections['ppm'] ?? null,
    ])


    {{-- ========================================================= --}}
    {{-- CAPAIAN PEMBELAJARAN LULUSAN --}}
    {{-- Slug database: cpl --}}
    {{-- ========================================================= --}}

    @include('components.profile.cpl', [
        'section' => $profileSections['cpl'] ?? null,
    ])


    {{-- ========================================================= --}}
    {{-- AKREDITASI --}}
    {{-- Mengambil data aktif langsung dari tabel accreditations. --}}
    {{-- ========================================================= --}}

    @include('components.profile.accreditation')

@endsection