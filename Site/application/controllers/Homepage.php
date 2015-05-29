<?php

class Homepage extends CI_Controller 
{
    
    function __construct()
    {
         parent::__construct();
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
            $potoid = $session_data['photoid'];

            $data1['q'] = $this->Newsfeed->getQuestions($id,$photoid);
            $data2['s']= $this->Newsfeed->getStatuses($id,$photoid);

            $data['records']=array_merge($data1['q'],$data2['s']);
            $this->load->view('homepage/home',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('UserLogin', 'refresh');
        }


        
    }
    
    
    
    
      function cuddle($id)
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');

              $id= $session_data['id'];

              $this->Newsfeed->cuddle($id);
              redirect('Homepage','refresh');
          }
          else
          {
              //If no session, redirect to login page
              redirect('UserLogin', 'refresh');
          }


      }


      
        function slap($id)
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');

              $id= $session_data['id'];

              $this->Newsfeed->slap($id);
              redirect('Homepage','refresh');
          }
          else
          {
              //If no session, redirect to login page
              redirect('UserLogin', 'refresh');
          }


      }
      
    
}