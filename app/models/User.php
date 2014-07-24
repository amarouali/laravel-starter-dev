<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = ['username','email','role_id','password','confirmed'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
    static $rules =[
            'username'  =>'required|min:4|unique:users',
            'email'     =>'required|email|unique:users',
            'password'  =>'required|min:6|confirmed'
        ];

    static $rules_update =[
            'username'  =>'required|min:4|unique:users',
            'email'     =>'required|email|unique:users'
        ];


	public function role(){
		return $this->belongsTo('Role');
	}


    public function getReminderEmail()
    {
        return $this->email;
    }

	public function isAdmin(){
		return Auth::user()->role->name;
	}

}
