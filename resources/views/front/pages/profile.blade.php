@extends('front.layouts.master')

@section('title')
    PMS Events
@endsection
@section('body')

    <div style="margin-top: 200px">

        <section class="section-boxed section-classic">
            <div class="image-container">
                <img src="{{ $about['photo'] }}" alt="About Us 1" class="image-responsive" />
            </div>

            <div class="content-section">
                <h4 class="profile-heading-style">{{ $about['name'] }}</h4>
                <p>{{ $about['description'] }}</p>
            </div>

            <!-- Contact Section -->
            <!-- <div class="contact-section">
                                    <h4 class="contact-heading">How can we help you?</h4>
                                    <p>Contact us or submit a business inquiry online.</p>
                                    <a href="/contact-us/" class="button">
                                      <i class="fas fa-phone-square-alt"></i> Contact Us
                                    </a>
                                  </div> -->
        </section>
        <div class="company_history">
            <ul>
                @foreach ($profiles as $profile)
                    <li>
                        <div class="year">{{ $profile->year }}</div>
                        <div class="sep"></div>
                        <div class="company_history_text">
                            @if (app()->getLocale() == 'ar')
                                <h4>{{ $profile->name_ar }}</h4>
                            @else
                                <h4>{{ $profile->name_en }}</h4>
                            @endif
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>

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
