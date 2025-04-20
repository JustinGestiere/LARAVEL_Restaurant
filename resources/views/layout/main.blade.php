<!DOCTYPE html>
<html lang="fr">

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layout.head')
        @include('layout.leftbar')

        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 800px;">
          <!-- top tiles -->
          <div class="row " style="display: inline-block;">
            @yield("content")
          </div>  
        </div>
      </div>
    </div>
	
    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    
    @yield('scripts')
  </body>
</html>
