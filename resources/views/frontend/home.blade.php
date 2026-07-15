@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    @include('components.home.hero')

    @include('components.home.statistics')

    @include('components.home.about')

    

    @include('components.home.video-profile')

@endsection