@extends('layouts.app')

@section(
    'title',
    'Dosen dan Staf D-IV Teknik Mesin Produksi dan Perawatan'
)

@section('content')

    {{-- ========================================================= --}}
    {{-- HERO DOSEN DAN STAF --}}
    {{-- ========================================================= --}}

    @include('components.lecturers.hero')


    {{-- ========================================================= --}}
    {{-- DAFTAR DOSEN DAN STAF --}}
    {{-- ========================================================= --}}

    @include('components.lecturers.list')

@endsection