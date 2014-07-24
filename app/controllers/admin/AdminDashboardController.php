<?php 

	class AdminDashboardController extends AdminController{



	public function getIndex(){
        
		$this->layout->nest('content','admin.dashboard');
	}

	}