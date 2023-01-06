<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="">
        @include('includes.header')
        @include('includes.sidebar')
         <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content mt-2">
                @yield('content')
            </section>

            
        </div>

        <footer class="main-footer">
            @include('includes.footer')
        </footer>
        @include('includes.tail')
    </body>
</html>
