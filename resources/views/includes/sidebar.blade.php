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
          @role('member')
            <li class="nav-item {{request()->routeIs('member*')?'menu-open ':''}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-circle" style="color: #7cbdff"></i>
                <p>
                  Membership
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('member-admission')}}" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon" style="font-size: 10px;color: #ff730e"></i>
                    <p>New Membership Application</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book" style="color: #7cbdff"></i>
                <p>
                  Member Book
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('member-book')}}" class="nav-link">
                    <i class="fa fa-book-open nav-icon" style="font-size: 10px;color: #ffb812" aria-hidden="true"></i>
                    <p>Book</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-credit-card" style="color: #7cbdff"></i>
                <p>
                  Payment
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('member-payment-index')}}" class="nav-link">
                    <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>List</p>
                  </a>
                </li>
              </ul>
            </li>
          @elserole('billing-manager')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book" style="color: #7cbdff"></i>
                <p>
                  Billing
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('member-book')}}" class="nav-link">
                    <i class="fa fa-book-open nav-icon" style="font-size: 10px;color: #ffb812" aria-hidden="true"></i>
                    <p>Book</p>
                  </a>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item {{request()->routeIs('member*')?'menu-open ':''}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-circle" style="color: #7cbdff"></i>
                <p>
                  Membership
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('new-applications-index')}}" class="nav-link">
                    <i class="fa fa-exclamation-triangle nav-icon" style="font-size: 10px;color: #ffb812" aria-hidden="true"></i>
                    <p>Pending Approvals</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('member-index')}}" class="nav-link">
                    <i class="fa fa-list-ol nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>Approved Member list</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('member-admission')}}" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon" style="font-size: 10px;color: #ff730e"></i>
                    <p>New Membership Application</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('classification-index')}}" class="nav-link">
                        <i class="fa fa-star nav-icon" style="font-size: 10px;color: #ff2450"></i>
                        <p>Membership Classification</p>
                    </a>
                 </li>
                <li class="nav-item">
                  <a href="{{route('occupation-index')}}" class="nav-link">
                    <i class="fa fa-list nav-icon" style="font-size: 10px;color: #ff2450"></i>
                    <p>Member Occupations</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book" style="color: #7cbdff"></i>
                <p>
                  Member Book
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('member-book')}}" class="nav-link">
                    <i class="fa fa-book-open nav-icon" style="font-size: 10px;color: #ffb812" aria-hidden="true"></i>
                    <p>Book</p>
                  </a>
                </li>
              </ul>
            </li>
            {{--<li class="nav-item">--}}
              {{--<a href="#" class="nav-link">--}}
                {{--<i class="nav-icon fas fa-user" style="color: #7cbdff"></i>--}}
                {{--<p>--}}
                  {{--Employee--}}
                  {{--<i class="fas fa-angle-left right"></i>--}}
                {{--</p>--}}
              {{--</a>--}}
              {{--<ul class="nav nav-treeview">--}}
                {{--<li class="nav-item">--}}
                  {{--<a href="{{route('inployee-index')}}" class="nav-link">--}}
                    {{--<i class="fa fa-th-large nav-icon" style="font-size: 10px;color: #00dcff"></i>--}}
                    {{--<p>Employee List</p>--}}
                  {{--</a>--}}
                {{--</li>--}}
              {{--</ul>--}}
            {{--</li>--}}
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-credit-card" style="color: #7cbdff"></i>
                <p>
                  Payment
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('payment-add')}}" class="nav-link">
                    <i class="fa  fa-plus nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>Add New</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('payment-index')}}" class="nav-link">
                    <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('payment-types')}}" class="nav-link">
                    <i class="fa  fa-list-alt nav-icon" style="font-size: 10px;color: #94ff08"></i>
                    <p>Payment Types</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-donate" style="color: #7cbdff"></i>
                <p>
                  Donation
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('donation-add')}}" class="nav-link">
                    <i class="fa  fa-plus nav-icon" style="font-size: 10px;color: #fff60e"></i>
                    <p>Add New Donation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('donation-index')}}" class="nav-link">
                    <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('add-donor')}}" class="nav-link">
                    <i class="fa  fa-user-alt nav-icon" style="font-size: 10px;color: #ff7000"></i>
                    <p>Add Donor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('donor-index')}}" class="nav-link">
                    <i class="fa  fa-users nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>Donors</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs" style="color: #7cbdff"></i>
                <p>
                  Donation Purpose
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('purpose-add')}}" class="nav-link">
                    <i class="fa  fa-plus-circle nav-icon" style="font-size: 10px;color: #fff60e"></i>
                    <p>Add New Donation Purpose</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('purpose-index')}}" class="nav-link">
                    <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #ff7000"></i>
                    <p>Purpose List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-chart-pie" style="color: #7cbdff"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('payments-report-index')}}" class="nav-link">
                    <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                    <p>Payment Report</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('donation-report-index')}}" class="nav-link">
                    <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                    <p>Donation Report</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('batch-wise-report-index')}}" class="nav-link">
                      <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                      <p>Batch-wise report</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('donation-report-index')}}" class="nav-link">
                        <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                        <p>Profession-wise report</p>
                    </a>
                 </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>Blood group-wise report</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>DOB-wise report</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>Membership-wise due report</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>Membership-wise full-payment report</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>Membership fee due report</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('donation-report-index')}}" class="nav-link">
                          <i class="fa fa-chart-bar nav-icon" style="font-size: 10px;color: #ffb300"></i>
                          <p>Monthly payment due report</p>
                      </a>
                  </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-clipboard" style="color: #7cbdff"></i>
                <p>
                  Notice
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('notice-add')}}" class="nav-link">
                    <i class="fa fa-pen nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>New Notice</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('notice-index')}}" class="nav-link">
                    <i class="fa  fa-list nav-icon" style="font-size: 10px;color: #00dcff"></i>
                    <p>Notice List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-mail-bulk" style="color: #7cbdff"></i>
                <p>
                  Email Config
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('email-config')}}" class="nav-link">
                    <i class="fa fa-cogs nav-icon" style="font-size: 10px;color: #ff1826"></i>
                    <p>Configure Email</p>
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
                  <a href="{{route('user-index')}}" class="nav-link">
                    <i class="fa fa-list nav-icon" style="font-size: 10px;color: #ffd511"></i>
                    <p>User List</p>
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
          @endrole
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