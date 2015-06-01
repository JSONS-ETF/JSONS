//Stevan Milicic
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminVerifyRegister extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin','',TRUE);
    }

    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        $this->form_validation->set_rules('accesscode', 'First name', 'trim|required');

        /*if ($this->admin->activate())
        {
            redirect('AdminLogin', 'refresh');
        }
        else redirect('AdminRegister', 'refresh');*/
        redirect('AdminLogin', 'refresh');
    }
}

?>