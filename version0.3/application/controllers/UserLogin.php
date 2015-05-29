//Stevan Milicic
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
        if($this->session->userdata('logged_in'))
        {
            redirect('UserHome', 'refresh');
        }
        else
        {
            $this->load->helper(array('form'));

            $this->load->view('User/Login');
            $this->load->view('User/Register');
        }
    }
}

?>