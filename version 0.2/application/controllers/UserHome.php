<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    function redirect()
    {
        redirect('UserHome', 'refresh');
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $session_data['username'];
			redirect('homepage', 'refresh');
            //$this->load->view('User/Home', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('UserLogin', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        //session_destroy();
        redirect('UserLogin', 'refresh');
    }
}

?>