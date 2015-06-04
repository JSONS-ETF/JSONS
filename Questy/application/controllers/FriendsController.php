<?php
class FriendsController extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('friends_model');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }

    function index($idCurr){

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['id'] =$session_data['id'];

            $id=$session_data['id'];
            $data["username"]=$session_data['username'];


            $data['idCurr'] = $idCurr;
            $data['idCurrUserName'] = $this->friends_model->getName($idCurr);

          $data['friends'] = $this->friends_model->getFriends($idCurr);
            $page["page"]=2;
            $page["id"]=$id;
            $this->load->view('templates/header',$page);
            $this->load->view('profile/friends', $data);
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }

    }


}