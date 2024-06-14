<div class="sidebar close">
    <div class="logo-details">
        {{-- <i class='bx bxl-c-plus-plus'></i> --}}
        {{-- <img src="{{ asset('frontend\images\logo.png') }}" style="height: 20px;color:white"> --}}
        {{-- <span class="logo_name">MixueVN</span> --}}
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
        </li>
        <!-- -------------- drop down bar ----------------- -->
        <li>
            <div class="iocn-link">
                <a href="{{ route('indexAdmin') }}">
                    <i class="bi bi-people"></i>
                    <span class="link_name">Người dùng</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="{{ route('indexAdmin') }}">Người dùng</a></li>
            </ul>
        </li>
        <!-- -------------- drop down bar ----------------- -->
        <li>
            <div class="iocn-link">
                <a href="{{ route('indexBank') }}">
                    <i class="bi bi-bank"></i>
                    <span class="link_name">Ngân hàng</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="{{ route('indexBank') }}">Ngân hàng</a></li>
            </ul>
        </li>
        <!-- -------------- drop down bar ----------------- -->
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Analytics</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Analytics</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-line-chart'></i>
                <span class="link_name">Chart</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Chart</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-plug'></i>
                    <span class="link_name">Plugins</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Plugins</a></li>
                <li><a href="#">UI Face</a></li>
                <li><a href="#">Pigments</a></li>
                <li><a href="#">Box Icons</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-compass'></i>
                <span class="link_name">Explore</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Explore</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-history'></i>
                <span class="link_name">History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">History</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Setting</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Setting</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    {{-- <img src="image/profile.jpg" alt="profileImg"> --}}
                </div>
                <div class="name-job">
                    @if (isset($currentUser))
                        <div class="profile_name">{{ $currentUser->user_name }}</div>
                    @else
                        <div class="profile_name">Người dùng</div>
                    @endif
                    @if (isset($currentUser) && $currentUser->role)
                        <div class="job">{{ $currentUser->role->role_name }}</div>
                    @else
                        <div class="job">Role người dùng</div>
                    @endif

                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background: unset;border: unset;">
                        <i class='bx bx-log-out'></i></button>
                </form>
            </div>
        </li>
    </ul>
</div>
