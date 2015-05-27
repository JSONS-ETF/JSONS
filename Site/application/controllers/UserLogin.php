<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    function index()
    {
        $this->load->helper(array('form'));

        $this->load->view('templates/header');
        $this->load->view('login/login_view');
        $this->load->view('templates/footer');
    }
}

?>