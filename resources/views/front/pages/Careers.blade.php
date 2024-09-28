@extends('front.layouts.master')

@section('title')
    PMS {{ __('header.career') }}
@endsection
@section('style')
    <link rel="stylesheet" href={{ asset('front/css/otherStyles.css') }}>
@endsection
@section('body')
    <div style="margin-top: 200px">

        <section class="join-brand-family-section content-en" id="content-en">
            <div class="container">
                <div class="heading text-center">
                    <div class="icon">
                        <i class="fas fa-handshake" style="color: #c9c95a"></i>
                    </div>
                    <h4>JOIN OUR BRAND FAMILY!</h4>
                </div>

                <div class="open-positions">
                    <h4>Open Positions</h4>
                    @if ($careers)
                        @foreach ($careers as $career)
                            <h5>{{ $career['name'] }}</h5>
                            <p>{{ $career['description'] }}</p>
                        @endforeach
                    @else
                        <div class="subtitle">No open positions.</div>
                    @endif
                </div>

                <div class="space"></div>
                <hr class="dotted-line" />

                <div class="contact-form">
                    <form action="{{ route('careersEmail') }}" method="post" class="contact-form"
                        enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="form-left">
                            <input type="text" name="name" placeholder="Your Name" />
                            <input type="email" name="email" placeholder="Your Email" />
                            <input type="text" name="position" placeholder="Desired Position" />
                            <input type="text" name="phone" placeholder="Phone Number" />
                        </div>
                        <div class="form-right">
                            <input type="file" name="cv" placeholder="Upload CV" />
                            <input type="text" name="linkedin" placeholder="LinkedIn Profile" />
                            <textarea name="message" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
