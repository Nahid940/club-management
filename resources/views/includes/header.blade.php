<div class="row" style="margin-right: 0px">
<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <a href="">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </a>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <form method="POST" action="{{ route('logout') }}">
          <a class="nav-link" style="color: #f92065;cursor: pointer;" data-toggle="" onclick="event.preventDefault();this.closest('form').submit();">
            {{ Auth::user()->name }} Logout <i class="fas fa-sign-out-alt "></i>
          </a>
              @csrf
          </div>
      </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
</div>