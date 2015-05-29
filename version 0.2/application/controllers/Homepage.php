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

            $page["page"]=0;
            $page["id"]=$id;
            $this->load->view('templates/header',$page);
            $this->load->view('homepage/home',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect(site_url().'UserHome/logout', 'refresh');
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
            redirect(site_url().'UserHome/logout', 'refresh');
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
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }

    public function findUser(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =$session_data['id'];
            $data['username'] =$session_data['username'];
            $data['photo'] =$session_data['photoid'];
            $idUser=$session_data['id'];

            $newUser=$this->input->post("newUser");

            $idNewUser=$this->Newsfeed->findUser($newUser);

            if ($idNewUser==-1)
                redirect(base_url().'index.php/homepage', 'refresh');
            else
                redirect(base_url().'index.php/profilecontroller/index/'.$idNewUser,'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }

    }


}