<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info" style="font-size: 18px;">
          <a href="{{route('home')}}" class="d-block"><i class="fa fa-user-circle"></i> {{ucfirst(Auth::user()->name)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('home')}}" class="nav-link active">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item {{request()->routeIs('member*')?'menu-open ':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-circle" style="color: #7cbdff"></i>
              <p>
                Members
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('member-index')}}" class="nav-link">
                  <i class="fa fa-list-ol nav-icon" style="font-size: 10px;color: #00dcff"></i>
                  <p>Member list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('member-admission')}}" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon" style="font-size: 10px;color: #ff730e"></i>
                  <p>Add new</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user" style="color: #7cbdff"></i>
              <p>
                Employee
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('inployee-index')}}" class="nav-link">
                  <i class="fa fa-th-large nav-icon" style="font-size: 10px;color: #00dcff"></i>
                  <p>Employee List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users" style="color: #7cbdff"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right "></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user-add')}}" class="nav-link">
                  <i class="fa fa-plus-square nav-icon" style="font-size: 10px;color: #ff0b4f"></i>
                  <p>Add new</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('role-index')}}" class="nav-link">
                  <i class="fa fa-cogs nav-icon" style="font-size: 10px;color: #00dcff"></i>
                  <p>Manage User Role</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign" style="color: #7cbdff"></i>
              <p>
                Payment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('payment-index')}}" class="nav-link">
                  <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #00dcff"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-key" style="color: #7cbdff"></i>
              <p>
                Account
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('password-update')}}" class="nav-link">
                  <i class="fa fa-unlock-alt nav-icon" style="font-size: 10px;color: #17ff0a"></i>
                  <p>Password update</p>
                </a>
              </li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="nav-link">
                  <a  style="cursor:pointer;color: #ecaf00" data-toggle="" onclick="event.preventDefault();this.closest('form').submit();">
                    <p>
                      <i class="fas fa-sign-out-alt "></i> 
                      Logout
                    </p>
                  </a>
                      @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>