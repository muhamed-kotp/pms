@extends('front.layouts.master')

@section('title')
    PMS {{ __('header.Contact') }}
@endsection
@section('style')
    <link rel="stylesheet" href={{ asset('front/css/otherStyles.css') }}>
@endsection
@section('body')
    <div style="margin-top: 200px">

        <section>
            <div class="contact-us-container">
                <div class="message">
                    <h2>{{ __('home.contactTitle') }}</h2>
                    <p>
                        {{ __('home.contact') }}
                    </p>
                </div>

                <div class="contact-info">
                    <div class="contact-left">
                        <h4>{{ __('home.contactinfo') }}</h4>
                        <div class="top-border">
                            <p>{{ __('header.email') }}: {{ $contact['email'] }}</p>
                            <p>{{ __('header.phone') }}: {{ $contact['phone'] }}</p>
                            <p>{{ __('home.Address') }}: {{ $contact['address'] }}</p>
                        </div>
                    </div>
                    <div class="contact-right">
                        <h4>{{ __('home.store') }}</h4>
                        <div class="top-border">
                            <p>{{ __('home.Hours') }}:{{ $contact['hours'] }}</p>
                            <p>{{ __('home.Location') }}: {{ $contact['location'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="map-location">
                    <h4>{{ __('home.findus') }}</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509822!2d144.95373631531667!3d-37.81627997975161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0b5d5a91%3A0x5045675218ceed5!2sQueen%20Victoria%20Market!5e0!3m2!1sar!2sau!4v1618486781234!5m2!1sar!2sau"
                        width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="contact-form">
                    <h4>{{ __('home.contactform') }}</h4>
                    <form action="{{ route('contactEmail') }}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="{{ __('home.name') }}" required />
                        <input type="email" name="email" placeholder="{{ __('header.email') }}" required />
                        <textarea name="message" placeholder="{{ __('home.message') }}" required></textarea>
                        <button type="submit">{{ __('home.send') }}</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
