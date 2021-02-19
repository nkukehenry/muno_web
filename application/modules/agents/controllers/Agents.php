<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends MX_Controller {

	public function __construct()
        {
            parent::__construct();
            $this->load->model('agents_mdl');
            $this->module="agents";
           // Modules::run("auth/isLegal");
        }

	public function index(){
		$this->list();
	}
  public function agentLogin($username,$password)
	{

		$agent=$this->agents_mdl->getAgentLogin($username,$password);
		return $agent;

	}

	 public function profileUpdate($request)
	{
		//$update=$this->agents_mdl->getAgentLogin($request);
		return $request;
	}

	public function setTranPin($request)
	{
		$setpin=$this->agents_mdl->setAgentTranPin($request);
		if($setpin)
		return 'SUCCESS';
	}

	public function setPassword($request)
	{
		$setpassword=$this->agents_mdl->setAgentPassword($request);
		return $setpassword;
	}

	public function getAll()
	{
		$agents=$this->agents_mdl->getAll();
		return $agents;
	}
		public function getAgent($agentNo)
	{
		$agent=$this->agents_mdl->getByAgentNo($agentNo);
		return $agent;
	}

	public function countAgents(){
		return $this->agents_mdl->count();
	}


  public function add()
	    {
		$data['module']=$this->module;
		$data['view']="add_agent";
		$data['title']="Add Agent";
		$data['agentNo']=$this->agents_mdl->genAgentNo();
		echo Modules::run("templates/main",$data);
	}

	public function genNo(){

		print_r($this->agents_mdl->genAgentNo());
	}

	public function edit($agentId)
	 {
		$data['module']=$this->module;
		$data['view']="edit_agent";
		$data['title']="Edit Agent";
		$data['agent']=$this->agents_mdl->getByAgentId($agentId);;
		echo Modules::run("templates/main",$data);
	}

		public function createLogin($agentNo)
	 {
		$data['module']=$this->module;
		$data['view']="agent_login";
		$data['title']="Create Agent Login";
		$agent = $this->getAgent($agentNo);;
		$data['agent']=$agent;
		$data['login'] =$this->getUser($agent->phoneNumber);
		echo Modules::run("templates/main",$data);
	}

	public function reset($agentNo){
	    $agent = $this->getAgent($agentNo);;
		$data['module']=$this->module;
		$data['view']="agent_login";
		$data['title']="Reset Agent";
		$data['agent']=$agent;
		echo Modules::run("templates/main",$data);
	}

    public function saveAgentLogin($agentNo){

        $userdata=$this->input->post();

        $username=$userdata['username'];

        $user=$this->getUser($username);

        if(count($user)>0)
        {

					$userdata['password']=md5($userdata['password']);
					$userdata['userType']='1';
					$userdata['status']='1';

					$this->db->where('user_id',$user->user_id);
					$this->db->update('users',$userdata);

            redirect('agents/list');
        }

        $userdata['password']=md5($userdata['password']);
        $userdata['userType']='1';
        $userdata['status']='1';

        $this->db->insert('users',$userdata);

        $newuser=$this->getUser($username);

        if(count($newuser)>0)
        {
              $this->db->where('agentNo',$agentNo);
              $this->db->update('agents',array('userId'=>$newuser->user_id));
             redirect('agents/list');
        }

    }

    function getUser($username){

        $this->db->where('login',$username);
       $qry= $this->db->get('users');

        return $qry->row();

    }


	public function list()
	    {

	   $searchData=array();

         if($this->input->post()!==null){
             $searchData=$this->input->post();
         }


        $data['search']=$searchData;


	    $this->load->library('pagination');
	    $config = array();

        $config["base_url"] = base_url() . "agents/list/";
        $config["total_rows"] = $this->agents_mdl->count($searchData);
        $config["per_title"] = 10;
        $config["uri_segment"] = 3;

	    //CUSTOM LINKS
	    $config['full_tag_open'] = '<nav class="pt-3" aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</nav></ul>';

        $config['cur_tag_open'] = '<li class="title-item active"><a class="title-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_title_numbers'] = TRUE;
        //END CUSTOM LINKS
        $config['attributes'] = array('class' => 'title-link');

        $this->pagination->initialize($config);

        $pg=@$_GET['title'];

        $title = ($pg)? $pg:0; //($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();
		$data['module']=$this->module;
		$data['view']="agents";
		$data['agents']=$this->agents_mdl->getAll($config["per_title"],$title,$searchData);
		$data['title']="Manage Agents";

		echo Modules::run("templates/main",$data);
	}


    	public function commissionlist()
	    {
	        
	   $searchData=array();
         if($this->input->post()!==null){
             $searchData=$this->input->post();
         }
        $data['search']=$searchData;
        
        $this->load->model('reports/reports_mdl');
        
		$data['module']=$this->module;
		$data['view']="pay_commission";
		$data['comagents']=null;
		$data['title']=" Agent Payments- Commission";
		
	 if(!empty($this->input->post())){
		    
		  if(!empty($this->input->post('pay'))){
		  $comagents = $this->reports_mdl->getCommissionList($searchData);
		  
		   echo  Modules::run("payments/payCommission", $comagents,$searchData);
		    
		    return;
		  }
		  
		  else{
		      
		  $data['comagents'] = $this->reports_mdl->getCommissionList($searchData);
		  }
		}
		  echo Modules::run("templates/main",$data);
	
	}

    
    
    public function payComms()
	    {
        
        $searchData=$this->input->post();
        $this->load->model('reports/reports_mdl');
		$comagents = $this->reports_mdl->getCommissionList($searchData);
		
		echo Modules::run("payment/payCommission", $comagents,$searchData);
	}

	public function saveAgent()
	    {

		$postData=$this->input->post();

  if(!empty($_FILES['kyc']['tmp_name']) || !empty($_FILES['photo']['tmp_name'])){

	 if(!empty($_FILES['photo']['tmp_name'])){

      $config['upload_path']   = './assets/img/people/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']      = 15000;
      $config['file_name']      = str_replace(' ', '_', $postData['phoneNumber'].time().mt_rand());

      $this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('photo')) {
         $error = $this->upload->display_errors();
         echo strip_tags($error);
      }
      else{

         $data = $this->upload->data();
         $photofile =$data['file_name'];
         $postData['photo']=$photofile;
      }

     }


     if(!empty($_FILES['kyc']['tmp_name'])){

      $config['upload_path']   = './uploads/kyc/';
      $config['allowed_types'] = 'gif|jpg|png|pdf';
      $config['max_size']      = 15000;
      $config['file_name']      = $postData['phoneNumber'].time().mt_rand();

      $this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('kyc')) {
         $error = $this->upload->display_errors();
         echo strip_tags($error);
      }
      else{

         $data1 = $this->upload->data();
         $kycfile =$data1['file_name'];
         $postData['kyc_attached']=$kycfile;
      }

     }

     $res=$this->agents_mdl->saveAgent($postData);

    } //if uploads
  else{
  		//no files at all
		$res=$this->agents_mdl->saveAgent($postData);
	  }

		if($res=='ok'){
			$msg= "Agent successfully Added";
		}

		else{
			$msg= "Operation failed, please try again";
		}

            Modules::run("templates/setFlash",$msg);
			redirect('agents/list');
	}


	public function saveAgentEdit($agentNo){

	  $postData=$this->input->post();

  if(!empty($_FILES['kyc']['tmp_name']) || !empty($_FILES['photo']['tmp_name'])){

	 if(!empty($_FILES['photo']['tmp_name'])){

      $config['upload_path']   = './assets/img/people/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']      = 15000;
      $config['file_name']      = str_replace(' ', '_', $postData['phoneNumber'].time().mt_rand());

      $this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('photo')) {
         $error = $this->upload->display_errors();
         echo strip_tags($error);
      }
      else{

         $data = $this->upload->data();
         $photofile =$data['file_name'];
         $postData['photo']=$photofile;
      }

     }


     if(!empty($_FILES['kyc']['tmp_name'])){

      $config['upload_path']   = './uploads/kyc/';
      $config['allowed_types'] = 'gif|jpg|png|pdf';
      $config['max_size']      = 15000;
      $config['file_name']      = $postData['phoneNumber'].time().mt_rand();

      $this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('kyc')) {
         $error = $this->upload->display_errors();
         echo strip_tags($error);
      }
      else{

         $data1 = $this->upload->data();
         $kycfile =$data1['file_name'];
         $postData['kyc_attached']=$kycfile;
      }

     }

     $res=$this->agents_mdl->updateAgent($agentNo,$postData);

    } //if uploads
  else{
  		//no files at all
		$res=$this->agents_mdl->updateAgent($agentNo,$postData);
	  }

		if($res=='ok'){
			$msg= "Agent Updated successfully ";
		}

		else{

			$msg= "Operation failed, please try again";

		}

        Modules::run("templates/setFlash",$msg);
		redirect('agents/list');
	}

    public function getByAgentNo($agentNo)
	{
		$agent=$this->agents_mdl->getByAgentNo($agentNo);
		return $agent;

	}

	public function addAgent()
	    {
		$data['module']=$this->module;
		$data['view']="add_team";
		$data['title']="Manage Agents";

		echo Modules::run("templates/main",$data);
	}


	public function updateAgent()
	    {

		$postData=$this->input->post();

		$res=$this->agents_mdl->updateAgent($postData);

		if($res=='ok'){

			echo "Agent successfully Updated";

		}
		else{

			echo "Operation failed, please try again";

		}
	}

	public function getAge($birthDate){

     $birthDate = explode("/", $birthDate);

     $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
    ? ((date("Y") - $birthDate[0]) - 1)
    : (date("Y") - $birthDate[0]));

     return $age;
	}

	
	public function getAgentHistory($agentNo){

		$history = $this->agents_mdl->getAgentHistory($agentNo);
		$data=array();

		for($i=0;$i<count($history); $i++){
		    $history[$i]->itemName=$this->getItemName($history[$i]->paymentCode);
		    $history[$i]->commission=$history[$i]->agent_fee;
		}
		return $history;
	}




}
