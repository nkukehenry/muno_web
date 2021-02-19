<?php

/**
 * Auth Controller
 * This controller does all user management.
 *
 * @package Auth
 * @author Henry Nkuke
 * @link http://waldir.org/
 **/
class Auth extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->module="auth";
	}
	
	function index()
	{
		// If user is already logged in, send it to private page
		$this->user->on_valid_session('dashboard');
		// Loads the login view
		$data['view']='login';
		$data['module']=$this->module;
		echo Modules::run('templates/plain',$data);
	}
	
	function private_page(){
		// if user tries to direct access it will be sent to login
		$this->user->on_invalid_session('login');
		// ... else he will view home
		redirect('dashboard');
	}
	
	function validate()
	{
		// Receives the login data
		$login = $this->input->post('login');
		$password = $this->input->post('credential');
		/* 
		 * Validates the user input
		 * The user->login returns true on success or false on fail.
		 * It also creates the user session.
		*/
		if($this->user->login($login, $password)){
			// Success
			redirect('dashboard');
		} else {
			$msg = "<font color='red'>Invalid login credentials</font>";
			Modules::run('utility/setFlash',$msg);
			// Oh, holdon sir.
			redirect('auth');
		}
	}
	
	// Simple logout function
	function logout()
	{
		// Removes user session and redirects to login
		$this->user->destroy_user('auth');
	}


	function initialPermissions(){

		$permission_id = $this->user_manager->save_permission('edit', 'Manages data &makes changes');
		$permission_id = $this->user_manager->save_permission('create', 'Creates new data');
		$permission_id = $this->user_manager->save_permission('delete', 'Can delete Entries');
		$permission_id = $this->user_manager->save_permission('edit_loan', 'Modifies loan Entries');
		$permission_id = $this->user_manager->save_permission('edit_customer', 'Modifies loan Entrie');
		$permission_id = $this->user_manager->save_permission('view_loans', 'Sees loan Entries');
	}

	public function deleteUser(){
	  if($this->user_manager->delete_user($user_id)){
	  echo "User was deleted.";
     }
   }

   public function users(){

	  $permissions = $this->db->get('permissions')->result();
	  $users = $this->db->get('users')->result();
		$data = array(
			'view' => 'manage_users', 
			'location' => 'Users / Manage',
			'title' => 'User Management',
			'permissions' => $permissions,
			'module'=>$this->module,
			'users' => $users
		);
		echo Modules::run('templates/main', $data);
   }

   public function edit($userId){

	$user_permissions = $this->db->where('user_id',$userId)->get('users_permissions')->result();
	$user_perms =[];

	foreach($user_permissions as $perm):
		array_push($user_perms,$perm->permission_id);
	endforeach;
	
	$permissions = $this->db->get('permissions')->result();
	$user = $this->db->where('id',$userId)->get('users')->row();

	  $data = array(
		  'view' => 'edit_user', 
		  'location' => 'Users / Edit User',
		  'title' => 'Edit User',
		  'permissions' => $permissions,
		  'module'=>$this->module,
		  'user'=>$user,
		  'user_permissions'=>$user_perms
	  );
	  echo Modules::run('templates/main', $data);
 }

   public function saveUser(){

		$data = $this->input->post();
		$fullname = $data['names'];
		$login = $data['username'];
		$password = $data['password'];
		$permissions = $data['permissions'];
		$email = $data['email'];
		$active = true;

		if($this->user_manager->login_exists($login)){
				Modules::run('utility/setFlash','Username already taken');
		}else{
		  $this->user_manager->save_user($fullname, $login, $password,$email, $active, $permissions);
		  Modules::run('utility/setFlash','User successfully created');
	     }
	    redirect('auth/users');
	}

	public function saveEdit(){

		$post = $this->input->post();
		$data['name']   = $post['names'];
		$data['login']  = $post['username'];
		$data['email']  = $post['email'];
		$user_id        = $post['user_id'];
		$permissions    = $post['permissions'];
		$password       = $post['password'];
		$data['active'] = $post['active'];

		if(!empty($password))
		$this->user_manager->update_pw($password,$user_id);

		if(count($permissions)>0){
			$this->db->where('user_id',$user_id);
			$this->db->delete('users_permissions');

		     $this->user_manager->add_permission($user_id,$permissions);
		}

		$this->db->where('id',$user_id);
		$this->db->update('users',$data);
		Modules::run('utility/setFlash','User successfully created');

		redirect('auth/users');
	}

	
}
?>
