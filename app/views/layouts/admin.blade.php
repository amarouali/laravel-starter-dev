<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <title>
          @section('title')
            | Administration 
          @show
        </title>
        {{HTML::style('http://getbootstrap.com/dist/css/bootstrap.min.css')}}
        {{HTML::style('http://getbootstrap.com/assets/css/docs.min.css')}}
        <link href="data:text/css;charset=utf-8," data-href="http://getbootstrap.com/dist/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">

    </head> 
    <body>

    {{BootMenu::navbar(array(
                          'title' =>'Administration',
                          'link'  =>URL::to('/'),
                          'class' =>'inverse',
                          'icon'  =>'home'

                       ),array(
                          'left'=>array(
                            array(
                              'title'     =>'Utilisateurs',
                              'icon'      =>'user', 
                              'dropdown'  =>array(
                                  array(
                                    'title' =>'Utilisateurs',
                                    'icon'  =>'user', 
                                    'link'  =>URL::to('admin/users')
                                  ),
                                  array(
                                    'title' =>'Roles',
                                    'icon'  =>'user', 
                                    'link'  =>URL::to('admin/roles')
                                  ),

                                )  
                            )
                            
                          ),
                          'right'=>array(
                              array(
                                  'title' =>'Voir le site',
                                  'link'  =>URL::route('home')
                                ),
                            array(
                              'title'     =>(Auth::check())?Auth::user()->username:'Utilsateur',
                              'show'      =>Auth::check(),
                              'icon'      =>'user', 
                              'dropdown'  =>array(
                                  array(
                                    'title' =>'Profil',
                                    'icon'  =>'wrench', 
                                    'link'  =>URL::route('admin.users.edit',Auth::id())
                                  ),
                                  array(
                                    'title' =>'Déconnexion',
                                    'icon'  =>'share', 
                                    'link'  =>URL::route('logout')
                                  ),

                                )  
                            ),
                          )
                       )
    )}}
   
           
    <div class="container">

        <div class="page-header">
          @section('title-header')
          @show
        </div>
         @include('elements.notif')
        

          @yield('content',$content)   
    </div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
<script src="https://raw.githubusercontent.com/rails/jquery-ujs/master/src/rails.js"></script>

@section('script')

@show
    </body> 
 
</html>
                                