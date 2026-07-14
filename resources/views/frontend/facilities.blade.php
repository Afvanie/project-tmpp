@extends('layouts.app')

@section(
    'title',
    'Fasilitas D-IV Teknik Mesin Produksi dan Perawatan'
)

@section('content')

    {{-- ========================================================= --}}
    {{-- HERO FASILITAS --}}
    {{-- ========================================================= --}}

    @include('components.facilities.hero')


    {{-- ========================================================= --}}
    {{-- KATEGORI DAN DOKUMENTASI FASILITAS --}}
    {{-- ========================================================= --}}

    @include('components.facilities.categories')


    {{-- ========================================================= --}}
    {{-- KOMPETENSI PENDUKUNG --}}
    {{-- ========================================================= --}}
    {{-- Dipertahankan sebagai struktur lama dan akan diaudit. --}}

    @includeIf('components.facilities.competency')


    {{-- ========================================================= --}}
    {{-- DENAH FASILITAS --}}
    {{-- ========================================================= --}}
    {{-- Dipertahankan sebagai struktur lama dan akan diaudit. --}}

    @includeIf('components.facilities.floor-plan')


    {{-- ========================================================= --}}
    {{-- GALERI AKTIVITAS --}}
    {{-- ========================================================= --}}

    @include('components.facilities.gallery')

@endsection