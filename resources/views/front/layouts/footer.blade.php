@php
    $contact = App\Models\Contact::with('translations')->get();
    $locale = app()->getlocale();
    $hours = optional($contact[0]->translate($locale))->hours;
    $divisions = App\Models\Division::with('translations')->get();
    $abouts = App\Models\About::with('translations')->get();
@endphp
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6" id="foot-first">
                    <div class="footer-info">
                        <img src="{{ asset('images/Logo-removebg.png') }}" height="50px" alt="Footer Logo"
                            id="foot-img" />
                        <p style="text-transform: capitalize">
                            {{ optional($contact[0]->translate($locale))->address }}<br />
                            <strong>{{ __('header.phone') }}:</strong> {{ $contact[0]->phone }}<br />
                            <strong>{{ __('header.email') }}:</strong> {{ $contact[0]->email }}<br />
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="facebook"><i class="fa-brands fa-facebook fa-lg"
                                    style="color: #ffffff"></i></a>
                            <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="tiktok"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <div class="flex flex-column">
                        <h4>{{ __('header.links') }}</h4>
                        <ul>
                            <li>
                                <i class="fa fa-chevron-right"></i> <a href="#">{{ __('header.Home') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-chevron-right"></i> <a href="#">{{ __('header.Aboutus') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-chevron-right"></i> <a href="#">{{ __('header.divisions') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <a href="#">{{ __('header.terms') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <a href="#">{{ __('header.privacy') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <div class="flex flex-column">
                        <h5>{{ __('header.ourservice') }}</h5>
                        <ul>
                            @foreach ($divisions as $division)
                                <li>
                                    <i class="fa fa-chevron-right"></i>
                                    <a href="#">{{ optional($division->translate($locale))->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <div class="flex flex-column">
                        <h4>{{ __('header.newsletter') }}</h4>
                        <p style="text-transform: capitalize">
                            {{ __('header.follow') }}
                        </p>
                        <form action="{{ route('newsuser.store') }}" method="post" class="newsletter-form">
                            @csrf
                            <input id="newsemail" type="email" name="email" placeholder="email"
                                class="newsletter-input" />
                            <button type="submit" class="newsletter-submit">
                                {{ __('header.subscribe') }}
                            </button>
                        </form>
                        <span class="error-message text-danger" id="newsemailError" style="display:none;">Please
                            Enter your email address.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.newsletter-form');
        const email = document.querySelector('#newsemail');
        const emailError = document.querySelector('#newsemailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for basic email validation

        form.addEventListener('submit', function(e) {
            let valid = true;

            // Check if the email field is empty
            if (email.value.trim() === '') {
                emailError.textContent = 'Please enter your email address.';
                emailError.style.display = 'block';
                valid = false;
            }
            // Check if the email format is valid
            else if (!emailRegex.test(email.value.trim())) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.style.display = 'block';
                valid = false;
            } else {
                emailError.style.display = 'none';
            }

            if (!valid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Hide error message when the user starts typing a valid email
        email.addEventListener('input', function() {
            if (email.value.trim() !== '' && emailRegex.test(email.value.trim())) {
                emailError.style.display = 'none';
            }
        });
    });
</script>
