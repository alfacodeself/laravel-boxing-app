@extends('layouts.landingpage.app')

@section('title', 'Classes')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('landingpage/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Our Classes</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <span>Classes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-landingpage.programs></x-landingpage.programs>
    <x-landingpage.trainers></x-landingpage.trainers>
    <x-landingpage.contact></x-landingpage.contact>
@endsection
