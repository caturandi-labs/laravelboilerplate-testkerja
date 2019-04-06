
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('dist/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('dist/css/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('dist/css/components.css') }}">
    <!-- DataTables -->
  <link href="http://andi.biqinin.com/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="http://andi.biqinin.com/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="http://andi.biqinin.com/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="{{ asset('dist/modules/jquery.min.js') }} "></script>
</head>

<body class="layout-2">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="dashboard-general.html" class="navbar-brand sidebar-gone-hide">TestKerja</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../dist/img/avatar/avatar-1.png" width="30" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">

              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand sidebar-gone-show"><a href="dashboard-general.html">TestKerja</a></div>
          <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li><a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            
            <li class="menu-header">Master</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ url('categories') }}">Categories</a></li>
                <li><a class="nav-link" href="#">Products</a></li>
                <li><a class="nav-link" href="#">Customers</a></li>
              </ul>
            </li>
            
            <li class="menu-header">Transactions</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Transactions</span></a>
              <ul class="dropdown-menu">
                <li><a href="auth-forgot-password.html">Orders</a></li> 
              </ul>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Dev by <a href="https://caturandi.com">Catur Andi Pamungkas</a>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  
  <script src="{{ asset('dist/modules/popper.js') }} "></script>
  <script src="{{ asset('dist/modules/tooltip.js') }} "></script>
  <script src="{{ asset('dist/modules/bootstrap/js/bootstrap.min.js') }} "></script>
  <script src="{{ asset('dist/modules/nicescroll/jquery.nicescroll.min.js') }} "></script>
  <script src="{{ asset('dist/modules/moment.min.js') }} "></script>
  <script src="{{ asset('dist/js/stisla.js') }} "></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('dist/modules/sticky-kit.js') }} "></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('dist/js/scripts.js') }} "></script>
  <script src="{{ asset('dist/js/custom.js') }} "></script>

    <!-- Required datatable js -->
  <script src="http://andi.biqinin.com/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Buttons examples /-->
  <script src="http://andi.biqinin.com/assets/plugins/datatables/dataTables.buttons.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/jszip.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/pdfmake.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/vfs_fonts.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/buttons.html5.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/buttons.print.min.js"></script>

  <!-- Key Tables -->
  <script src="http://andi.biqinin.com/assets/plugins/datatables/dataTables.keyTable.min.js"></script>

  <!-- Responsive examples -->
  <script src="http://andi.biqinin.com/assets/plugins/datatables/dataTables.responsive.min.js"></script>
  <script src="http://andi.biqinin.com/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <!-- Selection table -->

  @stack('scripts')

</body>
</html>