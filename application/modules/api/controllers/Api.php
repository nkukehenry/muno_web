<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api_model','api_mdl');
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Headers:*");
    }

    public function login_post(){
        $request = $this->post();
        $headers = $this->getHeaders();
        $login   = $this->api_mdl->agentLogin($request);
         $response = array(
            'status'    => HTTP_OK,
            'message'   =>  $login
        );
        $this->response($response,200);
    }
     public function customer_post(){

        $request = $this->post();
        $headers = $this->getHeaders();
        $result  = $this->api_mdl->saveBorrower($request);
        $response    = array(
            'status' => HTTP_OK,
            'data'   => $result
        );
        $this->response($response,HTTP_OK);
    }

    public function request_post(){
        $request  = $this->post();
        $headers  = $this->getHeaders();
        $response = array(
            'status'    => HTTP_OK,
            'message'   => 'Request received'
        );
        $this->response($response,200);
    }

    public function myrequests_get($agentId) {
        $headers  = $this->getHeaders();
        $result   = $this->api_mdl->get_loan_requests($agentId);
        $response = array(
            'status' => HTTP_OK,
            'data'   => $result
        );
        $this->response($response,200);
    }

    public function customers_get($agentId){
        $headers   = $this->getHeaders();
        $customers = $this->api_mdl->getBorrowers($agentId);
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $customers
        );
       $this->response($response,200);
    }

     public function applications_get($agentId){
        $headers   = $this->getHeaders();
        $customers = $this->api_mdl->getBorrowerApplications($agentId);
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $customers
        );
       $this->response($response,200);
    }

    public function history_get($agentId){
        $headers   = $this->getHeaders();
        $loans = $this->api_mdl->get_agent_loans($agentId);
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $loans
        );
       $this->response($response,200);
    }

    public function dueloans_get($agentId){
        $headers   = $this->getHeaders();
        $payments = $this->api_mdl->getDuePayments($agentId);
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $payments
        );
       $this->response($response,200);
    }

    public function loan_products_get(){
        $headers   = $this->getHeaders();
        $customers = $this->api_mdl->getProducts();
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $customers
        );
       $this->response($response,200);
    }

    public function calculate_post(){

        $request  = $this->post();

        $amount = $request['amount'];
        $loan_id = $request['loan_id'];
        $period = $request['period'];
     
        $schedule = $this->api_mdl->calculate($amount,$period,$loan_id);
        $response  = array(
            'status' => HTTP_OK,
            'data'   => $schedule //$schedule
        );
       $this->response($response,200);
    }

    public function request_loan_post(){
        $headers  = $this->getHeaders();
        $request  = $this->post();
        $result   = $this->api_mdl->add_loan_request($request);
        $response = array(
            'status' => HTTP_OK,
            'data'   => ($result==true)?'Request received successfully':$result
        );
        $this->response($response,HTTP_OK);
    }

    public function balance_get()
    {
        $request  = $this->post();
        $headers  = $this->getHeaders();
        $balances = array("balance" =>0,"commission"=>0,"unsettledLoans"=>0);
        $response = array(
            'status' => HTTP_OK,
            'message' =>$balances
        );
        $this->response($response,200);
    }
    public function redis_get(){

        $this->load->library('redis', array('connection_group' => 'slave'), 'redis');
        //print_r($this->redis_slave->command('PING'));
        $this->redis->set('foo', 'bar');

    }

    public function redisget_get(){
        $this->load->library('redis', array('connection_group' => 'slave'), 'redis');
        print_r($this->redis->get('foo'));
    }



}