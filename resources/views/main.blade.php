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
            <div class="content-header" style="height: 7px">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                                <h1 class="m-0">@yield('pageHeading')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>

            
        </div>

        <footer class="main-footer">
            @include('includes.footer')
        </footer>
        @include('includes.tail')
    </body>
</html>
