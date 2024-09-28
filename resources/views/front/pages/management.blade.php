@extends('front.layouts.master')

@section('title')
    PMS Events
@endsection
@section('body')
    <div style="margin-top: 200px">
        <div class="container section-title">
            <h2>{{ __('header.manegment') }}</h2>
            <div class="title-underline"></div>
        </div>

        <section class="staff-section">
            <div class="container section-title" data-aos="fade-up">
                <div class="staff-list-section">
                    @foreach ($manegments as $manegment)
                        <div class="staff-item" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ $manegment['photo'] }}" alt="Staff Name" class="staff-image" />
                            <ul class="staff-details">
                                <li class="staff-name">{{ $manegment['name'] }}</li>
                                <li class="staff-title">{{ $manegment['title'] }}</li>
                                <li class="staff-details">{{ $manegment['description'] }}</li>
                            </ul>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <section class="message-section">
            <div class="message-container">
                <p class="message-text">
                    {{ __('header.joinus') }}
                </p>
                <a href="{{ route('contact') }}" class="message-button">{{ __('header.contactus') }}<i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>


    </div>
    <!-- Arabic Main Body  -->
@endsection
