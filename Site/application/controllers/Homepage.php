<?php

class Homepage extends CI_Controller 
{
    
    function __construct()
    {
         parent::__construct();

        $this->load->library('session');
		 $this->load->helper("url");
          $this->load->model('Newsfeed');
    }
    
    function redirect()
    {
        redirect('Homepage', 'refresh');
    }
    
    function index()
    {

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $id= $session_data['id'];
            $photoid = $session_data['photoid'];

            $data1['q'] = $this->Newsfeed->getQuestions($id,$photoid);
            $data2['s']= $this->Newsfeed->getStatuses($id,$photoid);

            $data['records']=array_merge($data1['q'],$data2['s']);

            $this->load->view('templates/header');
            $this->load->view('homepage/home',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('UserLogin', 'refresh');
        }


        
    }




    function cuddle()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $idQ = $this->input->post("idQ");
            echo $this->Newsfeed->cuddle($idQ);

        }
        else
        {
            redirect('../index.php/UserLogin', 'refresh');
        }
    }


    function slap()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $idQ = $this->input->post("idQ");
            echo $this->Newsfeed->slap($idQ);

        }
        else
        {
            redirect('../index.php/UserLogin', 'refresh');
        }
    }
    
}