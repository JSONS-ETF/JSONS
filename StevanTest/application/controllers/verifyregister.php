<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyRegister extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
    }

    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        $this->form_validation->set_rules('password2', 'Repeat password', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last name', 'trim|required');
        $this->form_validation->set_rules('about', 'About', 'trim');

        /*$data = array(
            'email' => 'jane@aol.com',
            'username' => 'janedoe',
            'password' => 'janepass',
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'about' => 'kuracpalac'
        );*/

        if ($this->user->create())
        {
            redirect('login', 'refresh');
        }
        else redirect('register', 'refresh');

        /*if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->load->view('login_view');
        }
        else
        {
            //Go to private area
            redirect('home', 'refresh');
        }*/
    }
}

?>