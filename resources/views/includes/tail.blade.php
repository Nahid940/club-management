<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/adminlte.min.js')}}"></script>
<script src="{{asset('js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.4/dist/sweetalert2.all.min.js"></script>
@yield('script_link')
<script>
    @yield('script')
</script>