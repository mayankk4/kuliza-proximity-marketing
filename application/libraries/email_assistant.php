<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Hachi_Email_Assistant
 *
 * Authentication library for Code Igniter.
 *
 * @author		Mayank Kandpal
 * @version		1.0
 */

class Hachi_Email_Assistant{

    var $admin_emails = array(
            "mayankk4@gmail.com"
    );

	function __construct(){
		$this->ci =& get_instance();
        $this->ci->load->library('email');
	}


//////////////////////////////////// A D M I N    E M A I L S ////////////////////////////////////

    function send_mail_to_admins($subject, $message){

        $this->ci->email->from('admin@tagit.com', 'TagIt');
        $this->ci->email->to($admin_emails);

        $this->ci->email->subject($subject);
        $this->ci->email->message($message);

        $this->ci->email->send();        
    }

    function send_mail_to_user($to_email, $subject, $message){

        $this->ci->email->from('admin@tagit.com', 'TagIt');
        $this->ci->email->to($to_email);

        $this->ci->email->subject($subject);
        $this->ci->email->message($message);

        $this->ci->email->send();        
    }

}

