<!--Stevan Milicic-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserVerifyRegister extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('user','',TRUE);
        $this->load->model('question','',TRUE);
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

        $questions = $this->question->getBasic();

        foreach ($questions as $question)
        {
            $this->form_validation->set_rules('question'.$question['id'], 'question'.$question['id'], 'trim|required');
        }

        if ($this->user->create($questions))
        {
            redirect('UserLogin', 'refresh');
        }
        else redirect('UserRegister', 'refresh');

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