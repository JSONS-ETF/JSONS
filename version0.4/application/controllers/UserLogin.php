<!--Stevan Milicic-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('question','',TRUE);
        $this->load->model('response','',TRUE);
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

            $data['questions'] = $this->question->getBasic();
            $this->load->view('User/Login');
            $this->load->view('User/Register', $data);
        }
    }
}

?>