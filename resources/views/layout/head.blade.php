<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png" />
    
    <title>Click'n Eat</title>

    @yield('styles')

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Ajout de Bootstrap CDN pour la mise en forme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Supprimer les marges et paddings par défaut */
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }
    /* Utiliser Bootstrap en pleine largeur */
    .container {
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
    /* Si tu veux que tout le contenu soit centré mais sans marges */
        .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }
    </style>
  </head>
    
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                @auth

                <li class="nav-item dropdown" style="padding-left: 15px;">
                    <a href="#" class="user-profile dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            {{ Auth::user()->prenom }} {{ Auth::user()->name }}
                        @else
                            Invité
                        @endauth
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        @auth
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"> 
                                    <i class="fa fa-user"></i> {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Déconnexion
                                </a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Se connecter
                                </a>
                            </li>
                        @endauth
                    </ul>
                </li>  
            </ul>
        @endauth
        </nav>
    </div>
</div>
<!-- /top navigation -->