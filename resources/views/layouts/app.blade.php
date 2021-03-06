<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Catat Basic - {{$title}}</title>
  
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/css/sweetalert2.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/css/jquery-ui-1.12.1.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/loading/loading.css')}}" rel="stylesheet">
  <style>
    .scroll{
      overflow-y: scroll;
      overflow-x: auto;
      border: 1px solid lightgrey;
      border-radius: 3px;
      height: 556px;
    }
    #autoSuggestionsList > li {
      background: none repeat scroll 0 0 #F3F3F3;
      /* border-bottom: 1px solid #E3E3E3; */
      list-style: none outside none;
      padding: 5px 15px 5px 15px;
      text-align: left;
      height: 34px;
		}
		
		#autoSuggestionsList > li:hover {
			background: none repeat scroll 0 0 lightgrey;
			color: black;
	   }
		.auto_list {
      border: 1px solid #E3E3E3;
            /* border-radius: 5px 5px 5px 5px; */;
      position: absolute;
      z-index: 1;
      width: 96%;
    }
    .card-header{
      background: #e9ecef;
      /* color: white; */
      border-bottom: 2px solid #ffb300;
    }
    .right{
      float: right;
    }
  </style>
</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/">Catat Basic Order</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          {{-- <span class="badge badge-danger">9+</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          {{-- <span class="badge badge-danger">7</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Master</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <label class="dropdown-header">Produk:</label>
          <a class="dropdown-item" href="/produk">Produk</a>
          <a class="dropdown-item" href="/kategori">Kategori Produk</a>
          <div class="dropdown-divider"></div>
          <label class="dropdown-header">Transaksi:</label>
          <a class="dropdown-item" href="/pesan">Pesanan</a>
          <a class="dropdown-item" href="/pengeluaran">Pengeluaran</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tambahPesan">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Pesanan Baru</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Laporan</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        {{-- {{$sess}} --}}
        @yield('content')

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © basic13.com 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/loading/loading.js')}}"></script>
  <script src="{{ asset('assets/js/jquery-ui-1.11.0.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script>
    function swal_success(msg){
      swal({
        title: "Success",
        text: msg,
        timer: 2500,
        showConfirmButton: false,
        type: 'success'
      });
    }

    function swal_failed(msg){
      swal({
        title: "Error",
        text: msg,
        timer: 2500,
        showConfirmButton: false,
        type: 'error'
      });
    }

    function swal_info(msg){
      swal({
        title: "Warning",
        text: msg,
        timer: 2500,
        showConfirmButton: false,
        type: 'warning'
      });
    }
  </script>
  @yield('js');
  
</body>

</html>
