<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Model {
	protected $tbl_customer;
	protected $tbl_category;
	protected $tbl_location_category;
	protected $tbl_location;
	protected $tbl_activity;
	protected $tbl_user_activity;
	function __construct()
    {
        parent::__construct();
				$this->tbl_customer = "tbl_customer";
    		$this->tbl_category = "tbl_category";
    		$this->tbl_location_category = "tbl_location_category";
    		$this->tbl_location = "tbl_location";
    		$this->tbl_activity = "tbl_activity";
    		$this->tbl_user_activity = "tbl_user_activity";
    }

    function is_existuser($username, $email)
    {
        $sql = "SELECT id FROM {$this->tbl_customer} WHERE username='{$username}' OR email = '{$email}' LIMIT 1";
        return get_sql_value($sql);
    }

}
