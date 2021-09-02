@php
$src = (Auth::user()->profile_photo) ? env("AWS_URL").Auth::user()->profile_photo : asset('public/admin/images/no-user-image.png');
$src_loader = asset('images/loader-animations.gif');
@endphp
<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('includes.header')
    @stack('links')
</head>
<body class="pace-done">
    @include('includes.sidebar')
    <section class="dashboard-body dashboard-shrink">
        <div class="pace pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>
        <div class="header-toprow">
            <h1 class="page-title">
            <div class="formobbuttn">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span><span></span><span></span><span></span>
                </button>
            </div>
            <i class="fa icon-dashboard"></i>
            {{ $dataArr["page_title"] }}
        </h1>
        <div class="header-right-component">
            <ul>
                <li class="hdr-user-upload">
                    <span class="user-title">Hello, {{ Auth::guard('admin')->user()->name ? Auth::guard('admin')->user()->name : "Admin" }}</span>
                    <span class="user-pic">
                      <a id="profile-image" class="button2" href="javascript:void(0);">
                         <img src="{{ $src }}" alt="">
                     </a>
                 </span>

                 <div class="profile-setting content1">
                    <ul>
                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@include('includes.message')
@include('includes.err-msg')
@yield('content')


<footer class="btm-main-footer">
    <div class="footer-row">
            <!-- <div class="footer-contact-details">
                <ul>
                    <li><i class="fa fa-phone"></i>01223 750331</li>

                </ul>
            </div> -->
            <div class="copyright-txt">
                @include('includes.footer-text')
            </div>
        </div>
    </footer>
</section>
@include('includes.footer')
@stack('script')

</body>
</html>
