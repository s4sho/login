<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class User extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function insert_user()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = sha1($this->config->item('salt').$this->input->post('password')); // sha1, salt
    
        $sql = "INSERT INTO user (username, email, password)
        VALUES (".$this->db->escape($username).",
                '".$email."',
                '".$password."')";
            
        $result = $this->db->query($sql);
    
        if ($this->db->affected_rows() === 1)
        {
            $this->set_session($username, $email);
            //print_r($this->session->all_userdata());
            $this->send_validation_email();
            return $username;  
        }
        else
        {
         // Notify the admin by email the user registration is not working
            $this->load-library('email');
            $this->email->from('aleks4nd3r@gmail.com', 'MyProject');
            $this->email->to('aleks4nd3r@gmail.com');
            $this->email->subject('Problem inserting user into database');
        
            if (isset($email))
            {
                $this->email->message('Unable to register and insert user with the email of '.$email.' to the database.');
            }
            else
            {
                $this->email->message('Unable to register and insert user to the database.');
            }
            
            $this->email->send();
            return false;
        }
    }
    
    public function validate_email($email_address, $email_code)
    {
        $sql = "SELECT email, reg_time, username FROM user WHERE email = '{$email_address}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();
        
        if ($result->num_rows() === 1 && $row->username)
        {
            if(md5((string)$row->reg_time) === $email_code) // md5
            $result = $this->activate_account($email_address);
            if ($result === true)
            {
                return true;
            }
            else
            {
                echo 'There was an error when activating your account. Plase contact WRITE E-MAIL';
                return false;
            }
        }
        else
        {
            echo 'There was an error when activating your account. Plase contact WRITE E-MAIL';
        }
    }
    
    public function set_session($username, $email)
    {
        $sql = "SELECT user_id, reg_time FROM user WHERE email = '".$email."' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();
        
        $sess_data = array(
                    'user_id' => $row->user_id,
                    'username' => $username,
                    'email' => $email,
                    'logged_in' => 0
                    );
        
        $this->email_code = md5((string)$row->reg_time); // md5
        $this->session->set_userdata($sess_data);
    }
    
    /*
    private function send_validation_email()
    {
        $this->load->library('email'); 
        $email = $this->session->userdata('email');
        $email_code = $this->email_code;
       
        $this->email->set_mailtype('html');
        $this->email->from('aleks4nd3r@gmail.com','MyProject'); // the author uses bot_email
        $this->email->to('aleks4nd3r@yahoo.com');
        $this->email->subject('Please activate your account at Myproject');
        
        $message = "<!DOCTYPE html>
                    <head>
                    </head><body>";
        $message .= "<p>Dear " .$this->session->userdata('username').",</p>";
        $message .= "<p>
                        Thanks for registrating on MyProject! Please
                        <strong>
                            <a href=".base_url().'register/validate_email/'.$email.'/'.$email_code.">
                                click here
                            </a>
                        </strong>
                        to activate your account. After you have activated your account,
                        you will be able to log into to MyProject
                        and start playing with your balance sheets.
                    </p>";
        $message .= "<p>Thank you!</p>";
        $message .= "<p>The MyProject team</p>";
        $message .= "</body></html>";
        
        $this->email->message($message);
        $this->email->send();   
    }
    */
    
    private function send_validation_email()
    {
        $config = Array ( 
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'aleks4nd3r@gmail.com',
                'smtp_pass' => 'Fr33lanc3r',
        );
            
        $this->load->library('email',$config);
        $email = $this->session->userdata('email');
        $email_code = $this->email_code;
        $this->email->set_newline("\r\n");
        
        $this->email->set_mailtype('html');
        $this->email->from('aleks4nd3r@gmail.com','MyProject');
        $this->email->to($email);
        $this->email->subject('Please activate your account at MyProject');
        
        $message = "<!DOCTYPE>
                    <head>
                    </head><body>";
        $message .= "<p>Dear " .$this->session->userdata('username').",</p>";
        $message .= "<p>
                        Thanks for registrating on MyProject! Please
                        <strong>
                            <a href=".base_url().'register/validate_email/'.$email.'/'.$email_code.">
                                click here
                            </a>
                        </strong>
                        to activate your account. After you have activated your account,
                        you will be able to log into to MyProject
                        and start playing with your balance sheets.
                    </p>";
        $message .= "<p>Thank you!</p>";
        $message .= "<p>MyProject team</p>";
        $message .= "</body></html>";
        
        $this->email->message($message);
		
		if(!$this->email->send())
        {
            //show_error($this->email->print_debugger());
			echo 'Account create problem';
			die();
        }
		
    }
    
    private function activate_account($email_address)
    {
        $sql = "UPDATE user SET activated = 1 WHERE email = '{$email_address}' LIMIT 1";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1)
        {
            return true;
        }
        else
        {
            echo 'Error when activating your account in the database, please contact WRITE E-MAIL';
            return false;
        }
    }
    
    function check_if_email_exists($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('user');
        
        if ($result->num_rows() > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}