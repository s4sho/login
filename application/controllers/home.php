<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Home extends CI_Controller {
    
    private $logged_in;
    
    public function __construct() {
        parent::__construct();
        
        if ($this->session->userdata('logged_in'))
        {
            $this->logged_in = true;
        }
        else
        {
            $this->logged_in = false;
        }
    }
    
    public function index()
    {
        $this->load->view('includes/head');
        $this->load->view('home/home', array('logged_in' => $this->logged_in));
        $this->load->view('includes/footer');
    }
    
    public function test()
    {
        if ($this->session->userdata('logged_in'))
        {
            echo 'test';
        }
    }
}