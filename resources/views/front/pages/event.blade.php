@extends('front.layouts.master')
@section('title')
    PMS - {{ $event['name'] }}
@endsection
@section('body')
    <div style="margin-top: 200px">

        <div class="container section-title aos-init aos-animate" data-aos="fade-up">

            <h2>{{ $event['name'] }}</h2>
            <div class="title-underline"></div>
        </div>

        <section class="section-boxed section-classic">
            <div class="image-container">
                <img src="{{ $event['photo'] }}" alt="Cardiovascular Homer" class="image-responsive" />
            </div>

            <div class="content-section">
                <h4 class="">{{ $event['division_name'] }} ~</h4>
                <h6 class="">{{ $event['date'] }} </h6>
                <p>{{ $event['description'] }}</p>
            </div>



        </section>
        {{-- <section class="staff-section">
        <div class="staff-title-section">
          <h2>Our Staff</h2>
        </div>

        <div class="container section-title" data-aos="fade-up">
          <div class="staff-list-section">
            <div class="staff-item" data-aos="fade-up" data-aos-delay="100">
              <img
                src="images/testimonials-1.jpg"
                alt="Staff Name"
                class="staff-image"
              />
              <ul class="staff-details">
                <li class="staff-name">John Doe</li>
                <li class="staff-title">Senior Manager</li>
                <li class="staff-details">+123 456 7890</li>
                <li class="staff-details">+123 456 7891</li>
                <li class="staff-details">johndoe@example.com</li>
              </ul>
            </div>

            <div class="staff-item" data-aos="fade-up" data-aos-delay="200">
              <img
                src="images/testimonials-2.jpg"
                alt="Staff Name"
                class="staff-image"
              />
              <ul class="staff-details">
                <li class="staff-name">Jane Smith</li>
                <li class="staff-title">Marketing Director</li>
                <li class="staff-details">+123 456 7892</li>
                <li class="staff-details">+123 456 7893</li>
                <li class="staff-details">janesmith@example.com</li>
              </ul>
            </div>
          </div>
        </div>
      </section> --}}

        <section class="message-section">
            <div class="message-container">
                <p class="message-text">
                    Join our community and stay updated with the latest news!
                </p>
                <a href="#" class="message-button">Contact Us<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>

    </div>
    <!-- Arabic Main Body  -->
@endsection
