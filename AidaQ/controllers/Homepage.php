<?php

class Homepage extends CI_Controller 
{
    
    function __construct()
    {
         parent::__construct();
          $this->load->model('Newsfeed');
    }
    
    
    function index()
    {
     
       $data1['q'] = $this->Newsfeed->getQuestions();
       $data2['s']= $this->Newsfeed->getStatuses();
      // $data3['r']= $this->Newsfeed->getResponses();
 
 
      $data['records']=array_merge($data1['q'],$data2['s']);
      
    /*  for($i=0;$i<count($data);$i++)
      {
          $ar=array($data[$i]=>$data[$i]->Date);
      }
      
          ksort($data);*/
      if(empty($data))
          show_404 ();
    
            $this->load->view('pages/home',$data);
        
    }
    
    function submit($id=1)
    {
         if($this->input->post('cuddle'))
               $this->Newsfeed->cuddle($id);
       else if($this->input->post('slap'))
               $this->Newsfeed->slap($id);
            //redirect('questions', 'refresh');
       //$this->load->view('pages/home');
    }
    
 
    

    
}