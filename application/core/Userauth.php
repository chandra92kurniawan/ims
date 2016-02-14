<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userauth extends CI_Controller
{
       
    function __construct(){
        parent::__construct();
        $login=$this->session->userdata('log_in');
        if($login != 1){
            redirect('/');
        }
    }
    
    function set_user_group($user){
        if(is_array($user)){
            if(in_array($this->session->role,$user)){
                $result=TRUE;
                //echo 'ada';
            }else{
                $result=FALSE;
                //echo 'kosong';
            }
        }else{
            if($this->session->role == $user){
                $result=TRUE;
                //echo 'kosong a';
            }else{
                $result=FALSE;
            }
        }
        if($result == FALSE){
            show_404();
        }
    }
}