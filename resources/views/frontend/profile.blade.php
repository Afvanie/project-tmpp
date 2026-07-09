@extends('layouts.app')

@section('title', 'Profil D-III Teknik Mesin')

@section('content')

@include('components.profile.hero')

@include('components.profile.overview')

@include('components.profile.history')

@include('components.profile.vision-mission', [
    'section' => $profileSections['visi-misi'] ?? null
])

@include('components.profile.tujuan-prodi', [
    'section' => $profileSections['tujuan-prodi'] ?? null
])

@include('components.profile.ppm', [
    'section' => $profileSections['ppm'] ?? null
])

@include('components.profile.cpl', [
    'section' => $profileSections['cpl'] ?? null
])

@include('components.profile.accreditation')

@endsection