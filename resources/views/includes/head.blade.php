
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>NDC</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}" >
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('css/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('css/bs-stepper.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.4/dist/sweetalert2.min.css">
@yield('style_link')

@php
    $global_settings=getSettings(\Illuminate\Support\Facades\Auth::user()->id);
@endphp
@if(!empty($global_settings->template_color))

    <style>
        [class*=sidebar-dark-] {
            background-color: {{$global_settings->template_color}};
        }

        .navbar-white {
            background-color: {{$global_settings->template_color}};
        }
        .top_bar_area{
            background-color: {{$global_settings->template_color}};
        }
    </style>

@endif

<style>
    .content-header {
        padding: 0px 0.1rem;
    }
    body{
        font: {{isset($global_settings->font_size)?$global_settings->font_size:"11px"}} "Trebuchet MS","Lucida Grande",Verdana,sans-serif;
        font-family: "Trebuchet MS", "Lucida Grande", Verdana, sans-serif;
        color: #444
    }
    @yield('style')
</style>

