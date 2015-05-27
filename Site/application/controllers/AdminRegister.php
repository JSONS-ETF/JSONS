<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminRegister extends CI_Controller
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
        $this->load->view('Admin/Register');
    }
}

?>