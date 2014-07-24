<?php 
	namespace Amar;
/**
* BootMenu
* BootMenu::navBar(
*				$navebar=array(
*					'title'		=>'name',
*					'class'		=>'inverse nav-bar-fixed',
*					'link' 		=>URL::to('/'),
*					'icon'		=>user,
*					'fluid'		=>true 		
*				  ),
*				$lists=array(
*					'left'=>array(
*						array(
*							'title'	=>'Mon premier lien',
*							'link'	=>URL::route('articles.index'),
* 							'show'	=>true | true par default
*							'dropdown'=>array(
*											array(
*												'title'	=>'Dropdown1',
*												'link'	=>URL::route(articles.show),
*												'show'	=>true | true par default
*											),
*											array(
*												'title'	=>'Dropdown2',
*												'link'	=>URL::route(articles.show),
*												'show'	=>true | true par default
*											),
*										)	
*						)		
*					),
*					'right'=>array(
*						array(
*							'title'	=>'Mon lien à droite',
*							'link'	=>URL::route('articles.index'),
* 							'show'	=>true | true par default
*							'dropdown'=>array(
*											array(
*												'title'	=>'Dropdown3',
*												'link'	=>URL::route(articles.show),
*												'show'	=>true | true par default
*											),
*											array(
*												'title'	=>'Dropdown',
*												'link'	=>URL::route(articles.show),
*												'show'	=>true | true par default
*											),
*										)	
*						)		
*					),
*				)
*			)
**/
	class BootMenu{
		public function __construct($url){
			$this->url=$url;
		}
		function navBar(array $title ,$lists =array()){
			
			$return = ' <nav class="navbar navbar-'.(isset($title["class"]) ? $title["class"] : "default").'" role="navigation">
					  		<div class="container'.(isset($title["fluid"]) ? '-fluid' : "").'">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>';
			$return .= 			'<a class="navbar-brand" href="'.$title['link'].'">';
			$return .=(isset($title['icon']))?'<span class="glyphicon glyphicon-'.$title['icon'].'"></span> ':'';
			$return .=($title["title"] ? $title["title"] : "BootMenu").'</a>
						    </div>';
			$return .=$this->menu($lists);
			$return .='</div></nav>';
			return $return;
		}

		function menu($lists){
			$return = '<div class="collapse navbar-collapse" id="navbar-collapse-1">';
			$return .=$this->listMenu($lists);
			$return .='</div>';

			return $return;
		}

		function listMenu($lists){

			
			$return ='';
			foreach ($lists as $side => $list) {
				$class_side=($side=='right')?'navbar-right':'';
				$return .= $this->ulMenu($list,$class_side);
										
			}
		
			return $return;
		}
		
		function ulMenu($list,$class_side){
			if($class_side =='dropdown-menu'){
				$class =$class_side;
			}else{
				$class ='nav navbar-nav '.$class_side;	
			}
			
			$return ='';
			$return .='<ul class="'.$class.'">';
			$return .= $this->liMenu($list);
			$return .= '</ul>';	
			return $return;				
		} 
		function liMenu($list){
			
			$show = true;
			$li ='';
			foreach ($list as  $v) {
						//dd($v['icon']);
							if (isset($v['show'])){
								$show =$v['show'];
							}
							if($show){
								if(isset($v['dropdown'])){
									$li .= $this->dropDown($v);
								}else{
									$li .='<li><a href="'.$v['link'].'">';
									$li .=(isset($v['icon']))?'<span class="glyphicon glyphicon-'.$v['icon'].'"></span> ':'';
									$li .=$v['title'].'</a></li>';									
								}
					
							}

						}
		
			return $li;
		}

		function dropDown($list){

			$return ='';
			$dropdown=array_get($list,'dropdown');
			unset($list['dropdown']);
			$return .='<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">';
			$return .=(isset($list['icon']))?'<span class="glyphicon glyphicon-'.$list['icon'].'"></span> ':'';
			$return .= $list['title'].'<span class="caret"></span></a>';
			$return .= $this->ulMenu($dropdown, 'dropdown-menu');
			$return .='</li>';

			return $return;
		}
	}
 ?>
