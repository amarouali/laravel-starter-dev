<?php 

	class AdminUsersController extends AdminController{

        /**
         * User Model
         * @var User
         */
        protected $user;

        /**
         * Role Model
         * @var Role
         */
        protected $role;

        /**
         * Inject the models.
         * @param User $user
         * @param Role $role
         * @param Permission $permission
         */
        public function __construct(User $user, Role $role)
        {
            $this->user = $user;
            $this->role = $role;
        }

    	public function getIndex(){

    		$users =$this->user->has('role')->get();
            $this->layout->nest('content','admin.users.index',compact('users'));
    	}

        public function getCreate(){
            
            $roles=$this->role->findList();
            $this->layout->nest('content','admin.users.create',compact('roles'));
        }


        function postCreate(){
            $validation = Validator::make(Input::all(), User::$rules );

            if($validation->fails()){
                return Redirect::back()->withInput()->withErrors($validation);
            }
            
            $this->user->create(Input::all());
            return Redirect::to('admin/users')->with(['notif'=>['message'=>'Le compte '.Input::get('username') .' est crée','type'=>'success']]);
        }

        function getEdit($user){

            $roles=$this->role->findList();
            if($user->id){
                $this->layout->nest('content','admin.users.edit',compact('user','roles')); 
            }

        }

        function putEdit($user){
           
            User::$rules_update['username'] .=',username,'.$user->id;
            User::$rules_update['email'] .=',email,'.$user->id;
            
            $validator = Validator::make(Input::all(), User::$rules_update);
            
            if($validator->passes()){
                
                $user->username = Input::get( 'username' );
                $user->email = Input::get( 'email' );
                $user->role_id = Input::get( 'role_id' );
                $user->confirmed = Input::get( 'confirmed' );
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
                    return Redirect::to('admin/users')->with(['notif'=>['message'=>'Le compte '.Input::get('username') .' est modifié','type'=>'success']]);
                }
                return Redirect::back()->withInput()->withErrors($validation);

            }
            
            return Redirect::back()->withInput()->withErrors($validator);
    	}

        function postDelete($user){
            $user->delete();
            return Redirect::to('admin/users')->with(['notif'=>['message'=>'Le compte '.Input::get('username') .' est supprimé','type'=>'success']]);
        }
    }
