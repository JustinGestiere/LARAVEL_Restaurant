<!DOCTYPE html>
<html lang="fr">

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layout.head')
        @include('layout.leftbar')

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
            @yield("content")
          </div>  
        </div>
      </div>
    </div>
	
  </body>
</html>
