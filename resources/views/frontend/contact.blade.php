@extends('layouts.app')

@section('title','Kontak')

@section('content')

@include('components.contact.hero')

@include('components.contact.info')

@include('components.contact.map')

@include('components.contact.form')
@include('components.contact.instagram')

@endsection