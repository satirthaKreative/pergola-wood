<!DOCTYPE html>
<html lang="en">


    @php    $link = $_SERVER['PHP_SELF']; @endphp
    @php    $link_array = explode('/',$link); @endphp
    @php    $page = end($link_array); @endphp


    @include('frontend.include.head')
    <body>
        @include('frontend.include.header')
            @yield('content')
        @include('frontend.include.footer')
            @yield('jsContent')
        @include('frontend.include.footer-js')
    </body>
</html>