@extends('front.layouts.master')
@php
    $locale = app()->getlocale();
@endphp
@section('title')
    PMS
@endsection

@section('body')
    <!-- Carousel Section  -->
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }} c-item">
                    <img src="{{ $banner->image->photo }}" class="d-block w-100 c-img" alt="Slide {{ $loop->index + 1 }}" />
                    <div class="carousel-caption top-0">
                        <p>{{ optional($banner->translate($locale))->name }}</p>
                        <h1>{{ optional($banner->translate($locale))->description }}</h1>
                        <button class="btn btn-primary px-4 py-2 fs-5 mt-2">
                            <a style="text-decoration: none; color:white;" href="{{ route('contact') }}">
                                {{ __('header.getintouch') }}
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- About Us Section -->
    <section id="services" class="services section">
        <div class="container section-title">
            <h2>{{ __('header.Aboutus') }}</h2>
            <div class="title-underline"></div>
        </div>

        <div class="container">
            <div class="row gy-4">
                @foreach ($abouts as $about)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <img src="{{ $about->image->photo }}" class="service-img" alt="About" />
                            <a href="{{ route('about.' . $about->id) }}" class="stretched-link">
                                <h3>{{ optional($about->translate($locale))->name }}</h3>
                            </a>
                            <p>{{ optional($about->translate($locale))->description }}</p>
                            <a href="{{ route('about.' . $about->id) }}">{{ __('header.read_more') }} <i
                                    class="fa fa-chevron-right"></i></a>
                            <div class="link-line"></div>
                        </div>
                    </div>
                    <!-- End Service Item -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- Who We Are Section -->
    <section id="about" class="about section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>{{ __('header.Aboutus') }}</h2>
            <div class="title-underline"></div>
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 content aos-init aos-animate" data-aos="fade-up" data-aos-delay="200" id="about-text">
                    <h3 data-aos="fade-in" data-aos-duration="1000" class="aos-init aos-animate mb-5 mt-5">
                        {{ optional($webanner->translate($locale))->name }}
                    </h3>

                    <p>
                        {{ optional($webanner->translate($locale))->description }}

                    </p>
                </div>

                <div class="col-lg-6 position-relative align-self-start aos-init aos-animate" data-aos="fade-up"
                    data-aos-delay="100" data-aos-duration="1000">
                    <img src="{{ $webanner->image->photo }}" class="img-fluid" alt="" />
                    <a href="#" class="glightbox pulsating-play-btn"><i class="fa-solid fa-play"></i></a>
                </div>
            </div>
        </div>

        <section id="stats" class="stats section">
            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                            <i class="fa-solid fa-check mr-2"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="70" data-purecounter-duration="0"
                                    class="purecounter">70</span>
                                <p>{{ __('home.suppliers') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                            <i class="fa-solid fa-user-tie mr-2"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="69" data-purecounter-duration="0"
                                    class="purecounter">69</span>
                                <p>{{ __('home.staffs') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mr-2">
                        <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                            <i class="fa-solid fa-laptop-medical"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="300" data-purecounter-duration="0"
                                    class="purecounter">300</span>
                                <p>{{ __('home.machines') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mr-2">
                        <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                            <i class="fa-solid fa-trophy"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="33" data-purecounter-duration="0"
                                    class="purecounter">33</span>
                                <p>{{ __('home.awards') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Stats Item -->
                </div>
            </div>
        </section>
        <!-- /Stats Section -->
    </section>

    <!-- Call to Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background"
        style='
        background-image: url("{{ asset('images/hero-carousel-1.jpg') }}");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        height: 500px;
        '>
        <div class="container h-100 d-flex justify-content-center align-items-end">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center overlay-content p-4">
                        <h5 class="mb-5">
                            {{ __('home.whoWeAreBanner') }}
                        </h5>
                        <a class="cta-btn" href="{{ route('contact') }}">{{ __('header.Contact') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Divisions -->
    <section id="services" class="services section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>{{ __('home.ourDivision') }}</h2>
            <div class="title-underline"></div>
        </div>

        <div class="container">
            <div class="row gy-4">
                @foreach ($divisions as $division)
                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <img src="{{ $division->image->photo }}" height="150px" alt="" />
                            <a href="{{ route('division', $division->id) }}" class="stretched-link">
                                <h3 data-aos="slide-left" data-aos-duration="1000">
                                    {{ optional($division->translate($locale))->name }}
                                </h3>
                            </a>
                            <p>{{ optional($division->translate($locale))->description }}</p>
                            <a href="{{ route('division', $division->id) }}">{{ __('header.read_more') }} <i
                                    class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                @endforeach
                <!-- End Service Item -->
            </div>
        </div>
    </section>

    <!-- New & Events Section -->
    <section id="services" class="services section" style="position: relative; z-index: 999">
        <section id="call-to-action" class="call-to-action section"
            style='
            background-image: url("{{ asset('images/hero-carousel-1.jpg') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            z-index: 997;
            height: 40vh;
        '>
            <div class="container">
                <div class="row justify-content-center aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h2 class="call-to-action-title"> {{ __('home.recentNews') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container news-container">
            <div class="row gy-4">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"
                        data-aos-duration="1000">
                        <div class="service-item">
                            <img src="{{ $event->image->photo }}" class="service-img" alt="News Image" />
                            <div class="service-content">
                                <p>
                                    {{ optional($event->translate($locale))->name }}
                                </p>
                                <a href="{{ route('event', $event->id) }}"> <i class="fa fa-clock"></i>
                                    {{ $event->date }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
