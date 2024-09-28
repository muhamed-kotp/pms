@extends('front.layouts.master')

@section('title')
    PMS Events
@endsection
@section('body')
    <div style="margin-top: 200px">

        <section class="news-events-page">
            <div class="news-events-container">
                <div class="news-events-left">
                    @foreach ($events as $event)
                        <div class="news-event-item">
                            <h2 class="news-title">{{ $event['name'] }}</h2>
                            <div class="news-meta">
                                <span class="news-date">{{ $event['date'] }}</span>
                                <span class="news-vertical-separator"></span>
                                <span class="news-category">{{ $event['division_name'] }}</span>
                            </div>
                            <img src="{{ $event['photo'] }}" alt="Event Image" class="news-image" />
                            <a href="event-page.html" class="news-button">{{ __('header.read_more') }}</a>
                        </div>
                    @endforeach
                </div>

                <div class="news-events-right">
                    <div class="search-bar-wrapper">
                        <input type="text" placeholder="Search..." class="search-bar" />
                        <button class="search-icon-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="separator"></div>
                    <h3 style="font-size: 20px">{{ __('home.recentNews') }}</h3>
                    <ul class="news-menu">
                        @foreach ($events as $event)
                            <li><a href="#">{{ $event['name'] }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
