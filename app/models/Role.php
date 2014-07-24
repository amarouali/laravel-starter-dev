<?php

class Role extends \Eloquent {

    static $rules =[
            'name'  =>'required|min:4|unique:roles'
            ];

	protected $fillable = ['name'];

	public function findList(){
		$return =array();
		foreach ($this->all() as $k => $v) {
			$return[$v->id]=$v['name'];
		}
		return $return;
	}

	public function users(){
		return $this->hasMany('User');
	}

}