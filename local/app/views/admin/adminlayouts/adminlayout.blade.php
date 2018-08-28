<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
@include('admin.include.head')
<body class="page-quick-sidebar-over-content page-style-square {{ isset( $close_sidebar ) && $close_sidebar == true ? 'page-sidebar-closed' : '' }}">
    <div class="page-container">
        @include('admin.include.sidebar')
        <div class="page-content-wrapper">
            <div class="page-content">
                @include('admin.include.header')
                @yield('mainarea')
            </div>
        </div>
    </div> {{-- end of .page-container --}}
     @include('admin.include.footer')
    @include('admin.include.footerjs')
</body>
</html>
