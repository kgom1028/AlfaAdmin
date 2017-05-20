<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author : korstar
 *	date	: 2015-06-26
 *	Whatsapp Messager System
 *  Admin controlloer
 */

class Admin extends CI_Controller
{


	/**constructure**/
    function __construct()
	{
		parent::__construct();
		$this->load->database();
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        //load dashboard page
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE COUNTRY***/
    function manage_country($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
      if ($param1 == 'do_update') {
        $data['country_name']  = $this->input->post('country_name');
        $this->db->where('id', $param2);
        $this->db->update('country', $data);
        redirect(base_url() . 'index.php?admin/manage_country/', 'refresh');
      }
      $this->db->order_by("id");
      $countries =$this->db->get('country')->result_array();
      $page_data['countries'] = $countries;
      $page_data['page_name']  = 'manager_country';
      $page_data['page_title'] = get_phrase('Manage_Country');
      $this->load->view('backend/index', $page_data);
    }

    /******MANAGE CONTACT***/
    function manage_contact($param1= '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {

           $data['description'] = $this->input->post('address');
           $this->db->where('type' , 'address');
           $this->db->update('settings' , $data);

           $data['description'] = $this->input->post('phone');
           $this->db->where('type' , 'phone');
           $this->db->update('settings' , $data);

           $data['description'] = $this->input->post('system_email');
           $this->db->where('type' , 'system_email');
           $this->db->update('settings' , $data);

          redirect(base_url() . 'index.php?admin/manage_contact/', 'refresh');
        }
        $page_data['page_name']  = 'manager_contact';
        $page_data['page_title'] = get_phrase('manage_contact');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE USERS***/
    function manage_user($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

      if ($param1 == 'do_delete') {
        $this->db->where('id', $param2);
        $this->db->delete('user');
        redirect(base_url() . 'index.php?admin/manage_user/', 'refresh');
      }
      $page_data['users'] = $this->db->get('user')->result_array();
      $page_data['page_name']  = 'manager_user';
      $page_data['page_title'] = get_phrase('Manage_User');
      $this->load->view('backend/index', $page_data);
    }

    /******MANAGE USERS***/
    function manage_transfer_rate($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
      if ($param1 == 'do_update') {
        $data['rate']  = $this->input->post('rate');
        $this->db->where('id', $param2);
        $this->db->update('transfer_rate', $data);
        redirect(base_url() . 'index.php?admin/manage_transfer_rate/', 'refresh');
      }
      $sql = "select A.id, A.rate, B.country_name as from_country_name, C.country_name as to_country_name  from transfer_rate as A left join country as B on A.from_country_id = B.id left join country as C on A.to_country_id = C.id order by A.id";
      $tranfer_rates = get_sql_result_arr($sql);
      $page_data['tranfer_rates'] = $tranfer_rates;
      $page_data['page_name']  = 'manager_transfer_rate';
      $page_data['page_title'] = get_phrase('Manage_Transfer_Rate');
      $this->load->view('backend/index', $page_data);
    }

  	/******MANAGE LOCATION***/
  	function manage_notification($param1 = '', $param2 = '', $param3 = '')
  	{
  		if ($this->session->userdata('admin_login') != 1)
  			redirect(base_url() . 'index.php?login', 'refresh');
      if($param1 == 'do_create')
      {
        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $time = date('Y-m-d h:i:s');
        $data["time"] = $time;
        $this->db->insert('tbl_notification',$data);
        $insert_id = $this->db->insert_id();
        $data['id'] = $insert_id;
        $this->sendNotification($data);

  			redirect(base_url() . 'index.php?admin/manage_notification/', 'refresh');
      }

  		if ($param1 == 'do_update') {
  			$data['title']  = $this->input->post('title');
  			$data['content'] = $this->input->post('content');
        $time = date('Y-m-d h:i:s');
        $data["time"] = $time;
  			$this->db->where('id', $param2);
  			$this->db->update('tbl_notification', $data);
  			redirect(base_url() . 'index.php?admin/manage_notification/', 'refresh');
  		}
  		if ($param1 == 'do_delete') {
  			$this->db->where('id', $param2);
  			$this->db->delete('tbl_notification');
  			redirect(base_url() . 'index.php?admin/manage_notification/', 'refresh');
  		}
  		$page_data['notifications'] = $this->db->get('tbl_notification')->result_array();
    	$page_data['page_name']  = 'manager_notification';
  		$page_data['page_title'] = get_phrase('Manage_Notification');
  		$this->load->view('backend/index', $page_data);
  	}

   	function faq()
   	{
   		$this->load->view('frontend/faq');
   	}

   	function share_app()
   	{
   		$this->load->view('frontend/share_app');
   	}

   	function privacy()
   	{
   		$this->load->view('frontend/privacy_policy');
   	}

   	function declaimer()
   	{
   		$this->load->view('frontend/declaimer');
   	}


    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {

			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('system_title');
			 $this->db->where('type' , 'system_title');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('address');
			 $this->db->where('type' , 'address');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('phone');
			 $this->db->where('type' , 'phone');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('paypal_email');
			 $this->db->where('type' , 'paypal_email');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('currency');
			 $this->db->where('type' , 'currency');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('system_email');
			 $this->db->where('type' , 'system_email');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('buyer');
			 $this->db->where('type' , 'buyer');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('purchase_code');
			 $this->db->where('type' , 'purchase_code');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('language');
			 $this->db->where('type' , 'language');
			 $this->db->update('settings' , $data);

			 $data['description'] = $this->input->post('text_align');
			 $this->db->where('type' , 'text_align');
			 $this->db->update('settings' , $data);

            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }

        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('id', $this->session->userdata('admin_id'));
            $this->db->update('tbl_user', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('tbl_user', array('id' => $this->session->userdata('admin_id')))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('id', $this->session->userdata('admin_id'));
                $this->db->update('tbl_user', array('password' => $data['new_password']));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('tbl_user', array('id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function sendNotification($data)
    {
      $result = $this->db->get_where('tbl_gcm')->result_array();

      if($result)
      {
         $count = 0;
         $buf = array();
         $total_count = count($result);
          foreach ($result as $key => $row) {
            $count ++;
            $buf[] = $row['gcm_id'];
            if($count == 999 || $count == $total_count ) {
              $this->sendMessage($data['title'], $data['content'], $data, $buf);
              $count =0;
              unset($buf);
              $buf = array();
            } 
            
          }
      }

      $result = $this->db->get_where('tbl_token')->result_array();
      if($result)
      {
          $device_tokens_array = array();
          foreach ($result as $key => $row) {
            $device_tokens_array[] = $row['token'];
          }
                    var_dump($device_tokens_array);
          $this->sendPushArray($device_tokens_array, $data['content'], "");

      }
    }

    public function sendTestNotification()
    {

      $data = array();
      $data['id'] = 1;
      $data['title'] = 'Test';
      $data['TestContent'] = 'TestContent';
      $result = $this->db->get_where('tbl_gcm')->result_array();

      if($result)
      {
          foreach ($result as $key => $row) {
            $this->sendMessage("Test", "TestContent", $data, $row['gcm_id']);
          }
      }
    }
    public function sendPush($deviceToken, $message){
      $receiver = "";
        if( $deviceToken == null )  return;
        $passphrase = "";

        ////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'E:/xampp/htdocs/binaryoptions/notification/apns-dis-cert.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

/*        $fp = stream_socket_client(
        	'ssl://gateway.sandbox.push.apple.com:2195', $err,
        	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);*/
    
        //// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

       // echo 'Connected to APNS' . PHP_EOL;

        // Create the payload body
        $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                'content-available' => '1',
    			'receiver' => $receiver,
                'badge' => 0
                );
        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

      if (!$result)
                echo 'Message not delivered' . PHP_EOL;
        else
             echo 'Message successfully delivered' . PHP_EOL;
        // Close the connection to the server
        fclose($fp);
    }


    public function sendMessage($title, $text, $data, $target){
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AIzaSyAUGp332FA9UMmNIX34sjlf-N8giR4sCbo';
        $notification = array();
        $notification['title'] = $title;
        $notification['body'] = $text;
        $fields = array();
        $fields['notification']= $notification;
        $fields['data'] = $data;
        if(is_array($target)){
        	$fields['registration_ids'] = $target;
        }else{
        	$fields['to'] = $target;
        }
        //header with content_type api key
        $headers = array(
        	'Content-Type:application/json',
          'Authorization:key='.$server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
        	die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public function sendPushArray($device_tokens_array, $message, $receiver){
            if( $device_tokens_array == null )  return;
        $passphrase = "";

        ////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'E:/xampp/htdocs/binaryoptions/notification/apns-dev-cert.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
          'ssl://gateway.sandbox.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    
        //// Open a connection to the APNS server
     /*   $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);*/

        if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

       // echo 'Connected to APNS' . PHP_EOL;

        // Create the payload body
        $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                'content-available' => '1',
          'receiver' => $receiver,
                'badge' => 0
                );
        // Encode the payload as JSON
        $payload = json_encode($body);
        foreach ($device_tokens_array as $key => $deviceToken) {
         // $msg = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;

          $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

          // Send it to the server
          $result = fwrite($fp, $msg, strlen($msg));
        }
        // Build the binary notification
         

      if (!$result)
                echo 'Message not delivered' . PHP_EOL;
        else
             echo 'Message successfully delivered' . PHP_EOL;
    //
        // Close the connection to the server
        fclose($fp);
    }
}
