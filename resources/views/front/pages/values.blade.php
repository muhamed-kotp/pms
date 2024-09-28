@extends('front.layouts.master')

@section('title')
    PMS Events
@endsection
@section('body')
    <div style="margin-top: 200px">
        <div class="container section-title">
            <h2>{{ __('header.MissionVisionValues') }}</h2>
            <div class="title-underline"></div>
        </div>

        <section class="vision-mission-values">
            <div class="vision-block">
                <div class="vision-title">
                    <h2>{{ __('header.vision') }} <span class="line-icon"></span></h2>
                </div>
                <div class="vision-content">
                    <div class="hexagon-icon">
                        <i class="outer-icon"></i>
                        <i class="fa-solid fa-eye inner-icon"></i>
                    </div>
                    @foreach ($visions as $vision)
                        @if (app()->getLocale() == 'ar')
                            <p>{{ $vision->name_ar }}</p>
                        @else
                            <p>{{ $vision->name_en }}</p>
                        @endif
                    @endforeach

                </div>
            </div>

            <div class="separator">
                <i class="separator-icon">
                    <i class="fa-solid fa-kit-medical" style="color: #c0c03f"></i>
                </i>
            </div>

            <div class="mission-block">
                <div class="vision-title">
                    <h2>{{ __('header.mission') }}<span class="line-icon"></span></h2>
                </div>
                <div class="vision-content">
                    <div class="hexagon-icon">
                        <i class="outer-icon"></i>
                        <i class="fa-solid fa-bullseye inner-icon"></i>
                    </div>
                    @foreach ($missions as $mission)
                        @if (app()->getLocale() == 'ar')
                            <p>{{ $mission->name_ar }}</p>
                        @else
                            <p>{{ $mission->name_en }}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="separator">
                <i class="separator-icon"><i class="fa-solid fa-kit-medical"
                        style="color: #c0c03f; margin-bottom: 15px"></i></i>
            </div>

            <div class="vision-title">
                <h2>{{ __('header.values') }} <span class="line-icon"></span></h2>
            </div>
            <div class="values-block">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-regular fa-lightbulb fa-2xl"></i>
                    </div>
                    <div class="value-detail-item">
                        <h3>{{ __('header.quality') }}</h3>
                        <div class="value-detail-item-list">
                            @foreach ($qualities as $quality)
                                @if (app()->getLocale() == 'ar')
                                    <p>{{ $quality->name_ar }}</p>
                                @else
                                    <p>{{ $quality->name_en }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-regular fa-circle-user fa-2xl"></i>
                    </div>
                    <div class="value-detail-item">
                        <h3>{{ __('header.human') }}</h3>
                        <div class="value-detail-item-list">
                            @foreach ($humans as $human)
                                @if (app()->getLocale() == 'ar')
                                    <p>{{ $human->name_ar }}</p>
                                @else
                                    <p>{{ $human->name_en }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-mug-saucer fa-2xl"></i>
                    </div>
                    <div class="value-detail-item">
                        <h3>{{ __('header.experts') }}</h3>
                        <div class="value-detail-item-list">
                            @foreach ($experts as $expert)
                                @if (app()->getLocale() == 'ar')
                                    <p>{{ $expert->name_ar }}</p>
                                @else
                                    <p>{{ $expert->name_en }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fa-solid fa-bullhorn fa-2xl"></i>
                    </div>
                    <div class="value-detail-item">
                        <h3>{{ __('header.skills') }}</h3>
                        <div class="value-detail-item-list">
                            @foreach ($skills as $skill)
                                @if (app()->getLocale() == 'ar')
                                    <p>{{ $skill->name_ar }}</p>
                                @else
                                    <p>{{ $skill->name_en }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <!-- <div class="contact-section">
                                                  <h4 class="contact-heading">How can we help you?</h4>
                                                  <p>Contact us or submit a business inquiry online.</p>
                                                  <a href="/contact-us/" class="button">
                                                    <i class="fas fa-phone-square-alt"></i> Contact Us
                                                  </a>
                                                </div> -->

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
@endsection
