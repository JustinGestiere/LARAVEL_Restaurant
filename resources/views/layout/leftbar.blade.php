<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="#" class="navbar-logo d-flex align-items-center text-white ms-3">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="me-2" style="height: 40px;">
            <h2><span>Click'n Eat</span></h2>
        </a>
    </div>

    
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_info">
            <span><h5>Welcome,</h5></span>
            @if(Auth::check())
                <h2>{{ Auth::user()->prenom }} {{ Auth::user()->name }}</h2>
            @else
                <h2>Guest</h2>
            @endif
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                @if(Auth::check())
                <h3>Espace Admins</h3>
                <ul class="nav side-menu">
                    <!-- <li><a href=""> <i class="fa fa-home"></i>Home <span class=""></span></a></li> -->
                    @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('users.index') }}"> <i class="fa fa-users"></i>Gestion Utilisateurs <span class=""></span></a></li>
                    @endif
                    <li><a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i>Tableau de bord <span class=""></span></a></li>
                    <li><a href="{{ route('restaurants.index') }}"> <i class="fa fa-cutlery"></i>Restaurants <span class=""></span></a>
                        <!-- <ul class="nav child_menu">
                            <li><a href="">Créer un restaurant</a></li>
                        </ul> -->
                    </li>
                    <li><a href="{{ route('categories.index') }}"> <i class="fa fa-table"></i>Catégories <span class=""></span></a>
                    </li>
                    <li><a href="{{ route('items.index') }}"> <i class="fa fa-coffee"></i>Items <span class=""></span></a>
                    </li>
                </ul>
                @else
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('restaurants.index') }}"> <i class="fa fa-cutlery"></i>Restaurants <span class=""></span></a></li>
                    <li><a href="{{ route('login') }}"> <i class="fa fa-sign-in"></i>Connexion <span class=""></span></a></li>
                </ul>
                @endif
            </div>

        </div>
        <!-- /sidebar menu -->



        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="nav-link btn btn-link p-0">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <p class="d-inline">Déconnexion</p>
                </button>
            </form>
            @endif
        </div>

        <!-- /menu footer buttons -->



        @yield('scripts')
        <!-- jQuery -->
        <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
        <!-- NProgress -->
        <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
        <!-- Chart.js -->
        <script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
        <!-- gauge.js -->
        <script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
        <!-- Skycons -->
        <script src="{{ asset('assets/vendors/skycons/skycons.js') }}"></script>
        <!-- Flot -->
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
        <!-- Flot plugins -->
        <script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
        <!-- DateJS -->
        <script src="{{ asset('assets/vendors/DateJS/build/date.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
        <script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ asset('assets/js/custom.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        
    </div>
</div>