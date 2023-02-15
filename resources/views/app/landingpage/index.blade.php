@extends('layouts.landingpage.app')

@section('title', 'Boxing')
@section('content')
    <!-- Hero Section Begin -->
    <x-landingpage.carrousel></x-landingpage.carrousel>
    <!-- Hero Section End -->

    <!-- ChoseUs Section Begin -->
    <x-landingpage.chooseus></x-landingpage.chooseus>
    <!-- ChoseUs Section End -->

    <!-- Classes Section Begin -->
    <x-landingpage.programs></x-landingpage.programs>
    <!-- ChoseUs Section End -->

    <!-- Gallery Section Begin -->
    <x-landingpage.galleries></x-landingpage.galleries>
    <!-- Gallery Section End -->

    <!-- Team Section Begin -->
    <x-landingpage.trainers></x-landingpage.trainers>
    <!-- Team Section End -->

    <!-- Get In Touch Section Begin -->
    <x-landingpage.contact></x-landingpage.contact>
    <!-- Get In Touch Section End -->
@endsection