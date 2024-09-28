@extends('front.layouts.master')
@section('title')
    PMS - {{ __('home.ourpartners') }}
@endsection
@section('body')
    <div style="margin-top: 200px">
        <section class="vision-mission-values">
            <div class="vision-block">
                <div class="vision-title">
                    <h2>{{ __('home.ourpartners') }} <span class="line-icon"></span></h2>
                </div>

                <section class="partners-section">
                    <div class="partners-container">
                        @foreach ($partners as $partner)
                            <div class="partner-item">
                                <img src="{{ $partner['photo'] }}" alt="Partner 1 Logo" class="partner-logo" />
                                <h4>{{ $partner['name'] }}</h4>
                                <p>{{ $partner['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </section>

        <section class="message-section">
            <div class="message-container">
                <p class="message-text">
                    Join our community and stay updated with the latest news!
                </p>
                <a href="#" class="message-button">Contact Us<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>
    </div>
@endsection
