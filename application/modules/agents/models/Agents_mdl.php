<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents_mdl extends CI_Model {

	public function __construct()
        {
                parent::__construct();

                $this->table="agents";
               // $this->user=$this->session->userdata['user_id'];
        }


	public function getAgentLogin($username,$password){

		$this->db->where('login',$username);
		$this->db->where('password',md5($password));
		$this->db->where('agents.status',1);
		$this->db->join('agents','agents.userId=users.id');
		$qry=$this->db->get('users');
		return $qry->row();

	}
	public function getTable()
	{

		$table="agents";
		return $table;
	}

	public function count($searchData=null){

        if(!empty($searchData['agentNo']))
		 $this->db->where('agentNo',$searchData['agentNo']);

		if(!empty($searchData['names']))
		 $this->db->where("names like '%".$searchData['names']."%'");
		$table=$this->getTable();
		$this->db->select('id');
		$rows=$this->db->get($table)->result_array();
		return count($rows);
	}

	public function getAll($limit=10,$start=0,$searchData=null)
	{
		$table=$this->getTable();

		if(!empty($searchData['agentNo']))
		 $this->db->where('agentNo',$searchData['agentNo']);

		 if(!empty($searchData['names']))
		 $this->db->where("names like '%".$searchData['names']."%'");

		$this->db->limit($limit,$start);
		$this->db->order_by("id","desc");
		$query=$this->db->get($table);

		return $query->result();
	}


	public function getByAgentNo($agentNo)
	{
		$table=$this->table;
		$this->db->where('agentNo',$agentNo);
		$query=$this->db->get($table);
		return $query->row();
	}

	public function getByAgentId($agentId)
	{
		$table=$this->table;
		$this->db->where('id',$agentId);
		$query=$this->db->get($table);
		return $query->row();
	}


	public function genAgentNo(){

	    $qry=$this->db->query("SELECT max(id) as agentNo FROM `agents`");

	    $agentNo=$qry->row()->agentNo;
			$agentNo=$agentNo+1;
			
    if($agentNo<10)
      $agentNo="0".$agentNo;

	    $prefix="";
	    if(strlen($agentNo)<3)
	     $prefix="000";
    
    if(strlen($agentNo)==3)
	     $prefix="00";
    if(strlen($agentNo)==4)
	     $prefix="0";
    if(strlen($agentNo)>4)
	     $prefix="";

	    return "MN".$prefix.($agentNo);

	}

	public function saveAgent($postdata)
	{
		$table=$this->getTable();

		$saved=$query=$this->db->insert($table,$postdata);

		if($saved){

			return "ok";
		}
		else{

			return "failed";
		}
	}

  public function updateAgent($agentNo,$postdata)
	{
		$table=$this->getTable();

		$this->db->where('agentNo',$agentNo);
		$saved=$this->db->update($table,$postdata);

		if($saved){

			return "ok";
		}
		else{

			return "failed";
		}
	}

	public function deleteAgent($agentNo){

			$this->db->where('agentNo',$agentNo);
			$done=$this->db->delete($this->table);

		if($done){

			return 'ok';
		}

		else{

			return 'failed';
		}



	}



public function setAgentTranPin($request){

    $agentNo=$request->agentNo;
    $tranPin=$request->oldPin;
    if(!empty($request->newPin))
    $tranPin=$request->newPin;
    $agent=$this->getByAgentNo($agentNo);
    $data=array('tranPin'=> sha1($tranPin));
    $this->db->where('id',$agent->userId);
    $update=$this->db->update('users',$data);
    return $update;

}


public function setAgentPassword($request){

    $agentNo=$request->agentNo;
    $oldPin=md5($request->oldPin);
    $newPin=md5($request->newPin);

    $agent=$this->getByAgentNo($agentNo);
    $data=array('password'=> $newPin,"pwd_changed"=>1);
    $this->db->where('id',$agent->userId);
    $qry=$this->db->get("users");

    $user=$qry->row();

    if($user->password==$oldPin){

      $this->db->where('id',$agent->userId);
      $update=$this->db->update('users',$data);
      $response="SUCCESS";
    }
    else{
        $response="INCORRECT OLD PASSWORD";
    }

    return $response;

}



}
