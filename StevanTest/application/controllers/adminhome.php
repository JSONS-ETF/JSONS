<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class AdminHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin','',TRUE);
        $this->load->model('user','',TRUE);
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $session_data['username'];
            $data['accesscode'] = $session_data['accesscode'];
            $data['users'] = $this->user->listAll();

            $this->load->view('login/admin_home_view', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('adminlogin', 'refresh');
        }
    }

    function newadmin()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            $code = $this->admin->create();
            $data['accesscode'] = $code;

            $session_data['accesscode'] = $code;
            $this->session->set_userdata('logged_in', $session_data);

            redirect('adminhome', 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('adminlogin', 'refresh');
        }

    }

    function deleteUser($id)
    {
        $this->user->delete($id);
        redirect('adminhome', 'refresh');
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('adminhome', 'refresh');
    }
}

?>