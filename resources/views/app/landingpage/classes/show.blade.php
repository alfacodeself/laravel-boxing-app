@extends('layouts.landingpage.app')

@section('title', 'Detail Class')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('landingpage/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Our Classes Detail</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <a href="#">Classes</a>
                            <span>Detail Classes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="class-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="class-details-text">
                        <div class="cd-text">
                            <div class="cd-single-item">
                                <h3>Body buiding</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua accusantium doloremque
                                    laudantium. Excepteur sint occaecat cupidatat non proident sculpa.</p>
                            </div>
                            <div class="cd-single-item">
                                <h3>Trainer</h3>
                                <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur officia
                                    deserunt mollit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ts-slider owl-carousel">
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-1.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-2.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-3.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-4.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-5.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="{{ asset('landingpage/img/team/team-6.jpg') }}">
                                <div class="ts_text">
                                    <h4>Athart Rachel</h4>
                                    <span>Gym Trainer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-landingpage.contact></x-landingpage.contact>
@endsection
