<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyAdminRegister extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin','',TRUE);
    }

    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        $this->form_validation->set_rules('accesscode', 'First name', 'trim|required');

        /*$data = array(
            'email' => 'jane@aol.com',
            'username' => 'janedoe',
            'password' => 'janepass',
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'about' => 'kuracpalac'
        );*/

        /*if ($this->admin->create())
        {
            redirect('login', 'refresh');
        }
        else redirect('register', 'refresh');*/

        if ($this->admin->activate())
        {
            redirect('adminlogin', 'refresh');
        }
        else redirect('adminregister', 'refresh');

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