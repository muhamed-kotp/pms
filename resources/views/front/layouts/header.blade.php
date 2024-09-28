@php
    $contact = App\Models\Contact::with('translations')->get();
    $locale = app()->getlocale();
    $hours = optional($contact[0]->translate($locale))->hours;
    $divisions = App\Models\Division::with('translations')->get();
    $abouts = App\Models\About::with('translations')->get();
@endphp
<header class="header">
    <div class="announcement-bar">
        <div class="announcement-left">
            <i class="fa fa-clock-o"></i> {{ $hours }}
        </div>
        <div class="announcement-right">
            <i class="fa fa-phone"></i> {{ __('header.callus') }} {{ $contact[0]->phone }}
        </div>
    </div>

    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('images/Logo.png') }}" alt="Company Logo" class="logo" /></a>
    </div>

    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fa fa-bars"></i>
    </div>

    <nav class="header-nav">
        <ul>
            <li><a href="{{ route('home') }}">{{ __('header.Home') }}</a></li>
            <li>
                <a href="#">{{ __('header.Aboutus') }}<i class="fa-solid fa-chevron-down chevron"></i></a>
                <ul class="submenu">
                    @foreach ($abouts as $about)
                        <li>
                            <a href="{{ route('about.' . $about->id) }}">
                                {{ optional($about->translate($locale))->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('careers') }}">{{ __('header.career') }}</a></li>
            <li><a href="{{ route('Frontevents') }}">{{ __('header.news') }}</a></li>
            <li><a href="{{ route('partners') }}">{{ __('header.partner') }}</a></li>
            <li>
                <a href="#">{{ __('header.divisions') }}<i class="fa-solid fa-chevron-down chevron"></i></a>
                <ul class="submenu">
                    @foreach ($divisions as $division)
                        <li><a
                                href="{{ route('division', $division->id) }}">{{ optional($division->translate($locale))->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('contact') }}">{{ __('header.Contact') }}</a></li>
            <li class="language-switcher">
                <a class="text-reset" rel="alternate" hreflang="ar"
                    href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                    style="font-size: 18px; font-weight: 600; font-family: 'Cairo', sans-serif; font-variant: all-petite-caps;">
                    Arabic
                </a>/
                <a class="text-reset" rel="alternate" hreflang="en"
                    href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                    style="font-size: 18px; font-weight: 600; font-family: 'Cairo', sans-serif; font-variant: all-petite-caps;">
                    English
                </a>
            </li>
        </ul>
    </nav>
    {{-- <div class="header-button">
        <a href="#" class="btn">Get in Touch</a>
    </div> --}}
</header>
