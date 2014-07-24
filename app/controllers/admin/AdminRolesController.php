<?php 

class AdminRolesController extends AdminController{

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
        $roles =$this->role->all();
        $this->layout->nest('content','admin.roles.index',compact('roles'));		
	}
    
    public function getCreate(){
            
        $this->layout->nest('content','admin.roles.create');
    }


    function postCreate(){
        $validation = Validator::make(Input::all(), Role::$rules );

        if($validation->fails()){
            return Redirect::back()->withInput()->withErrors($validation);
        }
            
        $this->role->create(Input::all());
        return Redirect::to('admin/roles')->with(['notif'=>['message'=>'Le role '.Input::get('username') .' est crée','type'=>'success']]);
    }

    function getEdit($role){

        if($role->id){
            $this->layout->nest('content','admin.roles.edit',compact('role')); 
        }

    }
    
    function putEdit($role){
           
            Role::$rules['name'] .=',name,'.$role->id;
            $validator = Validator::make(Input::all(), Role::$rules);
            if($validator->passes()){
                $role->name=Input::get('name');
                $role->update();
                return Redirect::to('admin/roles')->with(['notif'=>['message'=>'Le role '.Input::get('name') .' est modifié','type'=>'success']]);
            }
                return Redirect::back()->withInput()->withErrors($validator);
                
    }

    function postDelete($role){
        $role->delete();
        return Redirect::to('admin/roles')->with(['notif'=>['message'=>'Le role '.Input::get('name') .' est supprimé','type'=>'success']]);
    }
}