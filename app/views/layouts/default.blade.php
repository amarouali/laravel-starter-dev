<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
        <title>
          @section('title')
            | Site
          @show
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <title></title> 
        {{HTML::style('http://getbootstrap.com/dist/css/bootstrap.min.css')}}
        {{HTML::style('http://getbootstrap.com/assets/css/docs.min.css')}}
        <link href="data:text/css;charset=utf-8," data-href="http://getbootstrap.com/dist/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">
        @section('style')
          
        @show
    </head> 

    <body>
    {{BootMenu::navbar(array(
                          'title' =>'Mon site',
                          'link'  =>URL::to('/'),
                          'class' =>'inverse',
                          'icon'  =>'home'

                       ),array(
                          'right'=>array(

                            array(
                              'title' =>'Me connecter',
                              'link'  =>URL::route('login'),
                              'show'  =>!Auth::check(), 
                              ),
                            array(
                              'title' =>"M'inscrire",
                              'link'  =>URL::route('signup'),
                              'show'  =>!Auth::check(),
                              ),
                            array(
                              'title'     =>(Auth::check())?Auth::user()->username:'Utilsateur',
                              'show'      =>Auth::check(),
                              'icon'      =>'user', 
                              'dropdown'  =>array(
                                  array(
                                    'title' =>'Profil',
                                    'icon'  =>'wrench', 
                                    'link'  =>URL::route('profil')
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
      
      <div class="row">
        <div class="page-header">
          @section('title-header')
          @show
        </div>
           @include('elements.notif')
           @yield('content',$content)
      </div>
    </div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
@section('script')
  
@show
    </body> 
 
</html>
                                