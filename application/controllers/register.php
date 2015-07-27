<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Register extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user');
    }
    
    public function index()
    {
        $this->load->view('includes/head');
        $this->load->view('registration/register_form');
        $this->load->view('includes/footer');
    }
    
    function get_version()
    {
        echo CI_VERSION; // echoes something like 1.7.1
    }
    
    public function register_user()
    {
        $this->load->library('form_validation');
        
        // rules to become a member
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[14]|xss_clean');
        $this->form_validation->set_rules('email', 'Email Adress', 'trim|required|min_length[6]|max_length[50]|valid_email|callback_check_if_email_exists|xss_clean'); //PREVERI user.email
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|matches[password_conf]|xss_clean');   
        $this->form_validation->set_rules('password_conf', 'Confirm Password', 'trim|required|min_length[6]|max_length[50]|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            // user didn't validate, send back to signup form and show errors
            $this->load->view('includes/head');
            $this->load->view('registration/register_form');
            $this->load->view('includes/footer');
        }
        else
        {
            // successful signup
            $this->load->model('user');
            
            // returns username if successful
            $result = $this->user->insert_user();
            
            if ($result)
            {
                $this->load->view('includes/head');
                $this->load->view('registration/signup_success', array('username' => $result));
                $this->load->view('includes/footer');
            }
            else
            {
                // this should occur
                echo 'Sorry, there\'s a problem with the website. Contact ... and le them know.';
            }        
        }
   }

   public function validate_email($email_address, $email_code)
   {
        $email_code = trim($email_code);
        
        $validated = $this->user->validate_email($email_address, $email_code);
        
        if($validated ===true)
        {
            $this->load->view('includes/head');
            $this->load->view('registration/view_email_validated',array('email_address' => $email_address));
            $this->load->view('includes/footer');
        }
        else
        {
            echo 'Error giving email activated confirmation, please contact WRITE E-MAIl';
        }
   }
   
   function check_if_email_exists($requested_email)
   {
        $this->load->model('user');
        
        $email_not_in_use = $this->user->check_if_email_exists($requested_email);
        
        if ($email_not_in_use)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
   }

}






















