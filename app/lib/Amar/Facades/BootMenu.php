<?php 

	namespace Amar\Facades;
	
	use Illuminate\Support\Facades\Facade;
	class BootMenu extends Facade{

		protected static function getFacadeAccessor() { return 'bootmenu'; }
	}
