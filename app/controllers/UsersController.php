<?php

class UsersController extends \BaseController {
  	
    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user, Role $role)
    {
      
        $this->user = $user;
        $this->role = $role;
    }


  	public function login()
	{
		if (Request::isMethod('POST'))
		{
			//dd(Input::all());
			
			$field = filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
			$remember =(Input::get('remember') ? true:false);
				

			
			if(Auth::attempt([ $field=>Input::get('email'),'password'=>Input::get('password'),'confirmed'=>1],$remember))
			{  
				
				if(Auth::user()->role->name =='admin'){
					return Redirect::route('admin.dashboard')->with(['notif'=>['message'=>'Vous étes connecté','type'=>'success']]);
				}
				
				return Redirect::intended()->with(['notif'=>['message'=>'Vous étes connecté','type'=>'success']]);
			}
			
			return Redirect::back()->with(['notif'=>['message'=>"Erreur d'identifiant",'type'=>'danger']])->withInput();
		}
		
		$user =$this->user;
		$this->layout->nest('content','Users.login',compact('user'));
	}

	/**
	* 
	**/
	function logout(){
		Auth::logout();
		return Redirect::to('/')->with(['notif'=>['message'=>'Vous étes déconnecté','type'=>'success']]);
	}

	function signup(){

			if (Request::isMethod('POST'))
			{
				//dd(Input::all());
				$validation = Validator::make(Input::all(), User::$rules );

				if($validation->fails()){
					return Redirect::back()->withInput()->withErrors($validation);
				}
		
				
				$this->user->username = Input::get('username');
				$this->user->email = Input::get('email');
				$this->user->password=Hash::make( Input::get('password'));
				$this->user->confirmed = 1;
				$this->user->role_id = $this->role->where('name','=','membre')->firstOrFail()->id;
				$this->user->save();
				
				/**
				* Connexion automatique
				**/
				Auth::loginUsingId($this->user->id);
				 
				return Redirect::to('/')->with(['notif'=>['message'=>'Votre compte est crée','type'=>'success']]);

				
			}
		
			$user =$this->user;
			$this->layout->nest('content','Users.signup',compact('user'));
		}

	function profil(){
		if (Request::isMethod('PUT'))
			{
			
			$user =$this->user->findOrFail(Auth::id());	
			User::$rules_update['username'] .=',username,'.$user->id;
            User::$rules_update['email'] .=',email,'.$user->id;
            
            $validator = Validator::make(Input::all(), User::$rules_update);
            
            if($validator->passes()){
                
                $user->username = Input::get( 'username' );
                $user->email = Input::get( 'email' );
                $password = Input::get( 'password');
                           
                if(empty($password)) {
                    unset($user->password);
                    unset($user->password_confirmation);
                }else{
                   $user->password = Hash::make($password);
                    User::$rules_update['password'] =User::$rules['password'];
                }
                if($user->confirmed == null) {
                     $user->confirmed = $oldUser->confirmed;
                }
                
                $validation=Validator::make(Input::all(), User::$rules_update);
                
                if($validation->passes()){
                    $user->save();

                    return Redirect::back()->with(['notif'=>['message'=>'Le compte '.Input::get('username') .' est modifié','type'=>'success']]);
                }
                return Redirect::back()->withInput()->withErrors($validation);

            }
            
            return Redirect::back()->withInput()->withErrors($validator);
			}

		$user =Auth::user();
		$this->layout->nest('content','Users.profil',compact('user'));
	}

}
