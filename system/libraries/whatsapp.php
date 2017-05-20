<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('whatsapp/whatsprot.class.php');

/** whatsapp library **/
class Whatsapp extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * function to send whatsapp message
     * param : username, password, nickname for chanel
     * param : to - contacts to send 
     * param : message - message contents
     * 
     * return true after insert action state into db
     * */
    function sendMessage($username, $password, $nickname, $to, $messages){
        
        $identity = strtolower(urlencode(sha1($username, true)));
        
        //check chanel
        //if fail, add fail code into db
        try{
            $w = new WhatsProt($username, $nickname, false, $identity);
            $w->Connect();
            $w->LoginWithPassword($password);
        }catch(Exception $e) {
            $this->db->insert('sent_log',array('fromphone'=>$username, 'tophone'=>$to, 'type'=>'error', 'content'=>'connection error, please check chanel', 'state'=>'0'));
            return true;
        }
        
        //check content, send message and insert db
        foreach ($messages as $message){
            $dbobj = array();
            $dbobj['fromphone'] = $username;
            $dbobj['tophone'] = $to;
            
            $type = $message['kind'];
            $dbobj['type'] = $type;
            
            $content1 = $message['content1'];
            $dbobj['content'] = $content1;
            
            if ($type == "text"){
                $result = $w->sendMessage($to , $content1);
            }
            
            if ($type == "image"){
                $result =  $w->sendMessageImage($to , $content1);
                while($w->pollMessage());
            }
            
            if ($type == "video"){
                $result =  $w->sendMessageVideo($to , $content1);
                while($w->pollMessage());
            }
            
            if ($type == "audio"){
                //$base64 = base64_encode(hash_file("sha256", $content1, true));
                //$size = $this->getRemoteFilesize($content1);
                
                //$w->sendMessageAudio($to , $content1, true, $size, $base64);
                $result =  $w->sendMessageAudio($to , $content1);
                while($w->pollMessage());
            }
            
            if ($type == "location"){
                $content2 = $message['content2'];
                $content3 = $message['content3'];
                
                $dbobj['content'] = $content3;
                
                $result =  $w->sendMessageLocation($to , $content1, $content2, $content3, null);
                //$w->sendMessage($to , "123.471909", "41.62366", 'Ji Chang Lu, Dongling Qu, Shenyang Shi, Liaoning Sheng, СпБЙ', null);
                while($w->pollMessage());
            }
            
            $dbobj['state'] = $result;
            
            $this->db->insert('sent_log',$dbobj);
            
            sleep(1);
        }
        
        $w->disconnect();
        return true;
    }
    
    /**
     * function to receive message
     * @param string $username
     * @param string $password
     * @param string $nickname
     * @return boolean
     */
    function receiveMessage($username, $password, $nickname){
        
        $identity = strtolower(urlencode(sha1($username, true)));
        
        try {
            $w = new WhatsProt($username, $nickname, false, $identity);
            $w->Connect();
            $w->LoginWithPassword($password);
        } catch (Exception $e) {
            return false;
        }
        
        while (true) {
            $w->PollMessage();
            $msgs = $w->GetMessages();//get message array
            
            if(count($msgs)==0)
                break;
        
            //get info from msg and insert db
            foreach ($msgs as $m) {
                $attribute = $m->getAttributes();
                $time = date("Y-m-d H:i:s", $attribute['t']);
        
                $from = str_replace("@s.whatsapp.net", "", $attribute['from']);
                $id = $attribute['id'];
                $type = $attribute['type'];
                
                //$name = $attribute['notify'];
                $content = "";
                $caption = "";
        
                $childrens = $m->getChildren();
        
                foreach ($childrens as $child) {                    	
                    if ($child->getTag() == "body") {
                        $content .= $child->getData();
                    }
                    elseif ($child->getTag() == "notify") {
                        $childAttr = $child->getAttributes();
        
                        if (isset($childAttr) && isset($childAttr['name'])) {
                            $name = $childAttr['name'];
                        }
                    }
                    elseif ($child->getTag() == "media") {
        				$child_attribute = $child->getAttributes();
        
        				$type = $child_attribute['type'];
        
        				if ($child_attribute['type']=='image' || $child_attribute['type']=='video' || $child_attribute['type']=='audio'){
        					$content .= $child_attribute['url'];
        					if(array_key_exists('caption',$child_attribute))
        						$caption .= $child_attribute['caption'];
        				}
        				elseif ($child_attribute['type']=='location'){
        					$content .= $child_attribute['latitude'].",".$child_attribute['longitude'];
        				}
        			}
                    
                }
        
                if (!empty($content)) {
                    //check msg in db if it was exist already
                    $check = $this->db->get_where('received_log', array('message_id'=>$id, 'received_time'=>$time))->num_rows();
                    
                    if( $check == 0 ){
                        $this->db->insert('received_log', array('fromphone'=>$from, 'tophone'=>$username, 'type'=>$type, 'content'=>$content, 'received_time'=>$time, 'message_id'=>$id, 'caption'=>$caption));
                    }
                }
        
                if (strtolower($content) == "exit") {
                    break;
                }
            }
        }
        
        $w->disconnect();
        return true;
    } 
    
    /**
     * function to get remote file size
     * @param String $file_url
     * @param boolean $formatSize
     * @return number|size
     */
    function getRemoteFilesize($file_url, $formatSize = true)
    {
        $head = array_change_key_case(get_headers($file_url, 1));
        // content-length of download (in bytes), read from Content-Length: field
    
        $clen = isset($head['content-length']) ? $head['content-length'] : 0;
    
        // cannot retrieve file size, return "-1"
        if (!$clen) {
            return -1;
        }
    
        if (!$formatSize) {
            return $clen;
            // return size in bytes
        }
    
        $size = $clen;
        
        $size = round($clen / 1024, 2);
    
        return $size;
    }
}

?>