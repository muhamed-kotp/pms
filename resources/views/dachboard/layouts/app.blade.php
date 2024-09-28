<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    {{-- CSS Style --}}
    <link rel="stylesheet" href="{{ asset('dachboard/style.css') }}">
</head>

<body>

    <!-- Header -->
    <a class="sidbar-toggle-btn nav-link toggle-btn" href="javascript:void(0)" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </a>
    <!-- Sidebar (Left) -->
    <div class="sidebar bg-dark" id="sidebar">
        <ul class="nav flex-column mt-3">
            <li class="nav-item d-flex ">
                <a class="nav-link" href="{{ route('admin') }}"> <img src="{{ asset('images/Logo.png') }}"
                        class="img-circle elevation-2" alt="User Image">
                    <span class="fw-bold ms-3">Admin</span></a>

            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('abouts.index') }}"><i class="fas fa-edit"></i><span>About
                        Us</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profiles.index') }}"><i class="fas fa-cogs"></i><span>Company
                        Profile</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manegments.index') }}"><i class="fas fa-table"></i>
                    <span>Manegment</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('missions.index') }}"><i
                        class="fas fa-cogs"></i><span>Mission</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('visions.index') }}"><i
                        class="fas fa-home"></i><span>Vision</span></a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="#"><i class="far fa-plus-square"></i>
                    <span>
                        Values
                        <i class="right fas fa-angle-left"></i>
                    </span>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('qualities.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Quality</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('humans.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Human Focus</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('skills.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Developing Skills</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('experts.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Experts</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('banners.index') }}"><i class="far fa-image"></i>
                    <span>Header Banners</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('webanners.index') }}"><i class="far fa-image"></i>
                    <span>Who We Are Banner</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users') }}"><i class="fa-solid fa-users"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('divisions.index') }}"><i class="fas fa-chart-pie"></i>
                    <span>Divissions</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('partners.index') }}"><i class="fas fa-copy"></i>
                    <span>Partners</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('careers.index') }}"><i class="fas fa-edit"></i>
                    <span>Careers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}"><i class="fas fa-book"></i> <span>News &
                        Events</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts.index') }}"><i class="fas fa-tree"></i> <span>Contact
                        US</span></a>
            </li>
            <!-- Add more menu items here -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content p-4" id="mainContent">
        <h3 class="text-center">@yield('title')</h3>
        <p>@yield('content')</p>
        <!-- Your dashboard content goes here -->
    </div>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Script for Sidebar Toggle -->
    <script src="{{ asset('dachboard/main.js') }}"></script>

    @stack('scripts')

</html>
</body>

</html>
