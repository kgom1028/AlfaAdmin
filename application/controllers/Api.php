<?php
header('Content-Type: application/json');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{

    protected $tbl_customer;
    protected $tbl_category;
    protected $tbl_location_category;
    protected $tbl_location;
    protected $tbl_activity;
    protected $tbl_user_activity;
    function __construct()
    {
        parent::__construct();
        $this->output->set_header('Content-Type: application/json');
        $this->load->database();
        $this->tbl_customer = "tbl_customer";
    		$this->tbl_notification = "tbl_notification";
    }

    public function login(){
      $device_id = $this->input->post('device_id');
      $return_ary = array();
      $result = $this->db->get_where('user',array('device_id'=>$device_id))->result_array();
      if(!$result){
        $data = array();
        $data['device_id'] = $device_id;
        $data['token'] = $this->generateToken($device_id); 
        $this->db->insert('user',$data);
        $data['id'] = $this->db->insert_id();
        $return_ary["data"] = $data;
      }else{
        $return_ary["data"] = $result[0];
      }

      $return_ary["response"] = "success";
      echo json_encode($return_ary);
    }

    private function generateToken($device_id){
       $token = mt_rand(100000, 999999);
       $result = $this->db->get_where('user',array('token'=>$token))->result_array();
       if($result){
          $token = mt_rand(100000, 999999);
       }
       return strval($token);
    }

    public function get_rate()
    {
        $id = $this->input->post('id');
        $return_ary = array();
        $result = $this->db->get_where('transfer_rate',array('id'=>$id))->result_array();
        if(!$result){
          $return_ary["response"] = "not exist";
        }else{
          $return_ary["response"] = "success";
          $return_ary["data"] = $result[0];
        }
        echo json_encode($return_ary);
    }

    public function get_info(){
      $return_ary = array();
      //rates
      $rates = $this->db->get('transfer_rate')->result_array();
      $data = array();
      $data['rates'] = $rates;
      $data['phone'] =  $this->db->get_where('settings' , array('type'=>'phone'))->row()->description;
      $data['email'] = $this->db->get_where('settings' , array('type'=>'system_email'))->row()->description;
      $data['address'] = $this->db->get_where('settings' , array('type'=>'address'))->row()->description;
      $data['front_title'] = $this->db->get_where('settings' , array('type'=>'front_title'))->row()->description;
      $data['front_header'] = $this->db->get_where('settings' , array('type'=>'front_header'))->row()->description;
      $return_ary['response'] = 'success';
      $return_ary['data'] = $data;

      echo json_encode($return_ary);
    }
  
}
