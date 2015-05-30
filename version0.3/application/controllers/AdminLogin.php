<!--Stevan Milicic-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    function index()
    {
        if($this->session->userdata('admin_logged_in'))
        {
            redirect('AdminHome', 'refresh');
        }
        else
        {
            $this->load->helper(array('form'));
            $this->load->view('Admin/Login');
            $this->load->view('Admin/Register');
        }
    }
}

?>