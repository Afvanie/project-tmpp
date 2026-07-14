@extends('layouts.app')

@section('title', $page['title'])

@section('content')

    {{-- ========================================================= --}}
    {{-- HERO HALAMAN AKADEMIK --}}
    {{-- ========================================================= --}}

    @include('components.academic.hero')


    {{-- ========================================================= --}}
    {{-- DAFTAR DOKUMEN AKADEMIK --}}
    {{-- ========================================================= --}}

    @include('components.academic.documents')

@endsection