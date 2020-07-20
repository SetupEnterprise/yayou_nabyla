<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title ?? ''}}</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('theme-asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  @yield('head')
  <!-- Custom styles for this template-->
  <link href="{{ asset('theme-asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme-asset/js/sweetalert.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/yearpicker.css') }}">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #0295e0">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">Yayou Nabyla</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Administrateur</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
      <a class="nav-link" href="{{ route('gerant.dashboard')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Tableau Bord</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Automobiles</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operations sur les AUTOS:</h6>
            <a class="collapse-item" href="{{ route('automobile.index') }}">Lister</a>
          <a class="collapse-item" href="{{ route('automobile.create') }}">Ajouter</a>
          <a class="collapse-item" href="{{route('marque.index')}}">Marque</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Modèles</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operations sur les Modèles:</h6>
          <a class="collapse-item" href="{{ route('modele.create') }}">Ajouter</a>
            <a class="collapse-item" href="{{ route('modele.index') }}">Lister</a>
          </div>
        </div>
      </li>


      <!-- Nav Item - Vendeur -->
      <li class="nav-item">
      <a class="nav-link" href="{{ route('gerant.index')}}">
          <i class="fas fa-fw fa-tools"></i>
          <span>Mon compte</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('_partials/_nav_gerant')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <!-- Contenue de la page -->
          @yield('contenu_page')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>
                @yield('footer') <!-- Copyright &copy; Your Website 2019 -->
            </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pretes à quitter?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Sélectionnez "déconnecter" si vous etes sur de vouloir fermer votre session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
          <a class="btn btn-primary" href="">Déconnecter</a>
          </div>
        </div>
      </div>
    </div>

  <!-- Bootstrap core JavaScript-->
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script src="{{ asset('theme-asset/vendor/js/bootstrap.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/yearpicker.js') }}"></script>
<script type="text/javascript">
    $('.yearpicker').yearpicker();
</script>
  <script src="{{ asset('theme-asset/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('theme-asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js')}}" type="text/javascript"></script>

  {{--  Gestion des notifications  --}}

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('theme-asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('theme-asset/js/sb-admin-2.min.js') }}"></script>
  <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('js/light-bootstrap-dashboard.js?v=2.0.0')}}" type="text/javascript"></script>

<script src="{{asset('theme-asset/vendor/chart.js/Chart.min.js')}}"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('/js/demo.js')}}"></script>
  <script src="{{ asset('/js/bar-vendeur.js')}}"></script>
  @yield('scripts')

<script src="{{ asset('/js/notification.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            notification.showNotification();

        });
    </script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/chart-area-demo.js')}}"></script>
<script src="{{asset('js/chart-pie-demo.js')}}"></script>

  @yield('scripts')
<script src="{{ asset('js/app.js') }}"></script>


</body>

</html>
