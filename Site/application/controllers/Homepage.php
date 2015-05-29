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
     
       $data1['q'] = $this->Newsfeed->getQuestions();
       $data2['s']= $this->Newsfeed->getStatuses();

      $data['records']=array_merge($data1['q'],$data2['s']);
            $this->load->view('homepage/home',$data);
        
    }
    
    
    
    
      function cuddle($id)
      {
           $this->Newsfeed->cuddle($id);
           redirect('Homepage','refresh');
      }
      
        function slap($id)
      {
           $this->Newsfeed->slap($id);
           redirect('Homepage','refresh');
      }
      
    
}