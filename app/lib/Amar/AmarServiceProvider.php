<?php 
	namespace Amar;
	
	use Illuminate\Support\ServiceProvider;

	class AmarServiceProvider extends ServiceProvider{

		function register(){
			$this->registerBootForm();
			$this->registerBootMenu();
			$this->registerImage();
		}

		function registerBootForm(){
			$this->app->bind('bootform',function($app){
				return new BootForm($app['form'],$app['session']);
			});
		}
		function registerBootMenu(){
			$this->app->bind('bootmenu',function($app){
				return new BootMenu($app['url']);
			});
		}
		function registerImage(){
			$this->app->bind('image',function($app){
				return new Image($app['html']);
			});
		}
	}
