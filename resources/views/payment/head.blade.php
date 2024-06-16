<nav class="navbar-main">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img style="height: 3rem;" src="{{ asset('frontend\images\logo.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="display: flex; gap:20px">
                    <li class="nav-item" style="cursor: pointer;">
                        <span><a style="text-decoration: none; color: #333" href="{{ route('gioi_thieu') }}">
                                Giới thiệu
                            </a>
                        </span>
                    </li>
                    <li class="nav-item" style="cursor: pointer;">
                        <span><a style="text-decoration: none; color: #333" href="{{ route('lien_he') }}">
                                Liên hệ</span>
                        </a>
                    </li>
                </ul>
                <div class="dropdown">
                    <span class="navbar-item">
                        @if (isset($currentUser))
                            <a href="" class="fs-6 text-decoration-none dropdown-toggle"
                                style="color:black; font-weight: 500;" data-bs-toggle="dropdown">
                                <span style="color:#cb1c3b">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                </span>
                                <span>{{ $currentUser->user_name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('donhang') }}" method="GET">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đơn hàng</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('login') }}" class="fs-6 text-decoration-none"
                                style="color:black; font-weight: 500;">
                                <span style="color:#cb1c3b">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                </span>
                                <span>Thành viên</span>
                            </a>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </nav>
</nav>
