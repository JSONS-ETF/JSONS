<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/25/2015
 * Time: 8:03 PM
 */

class conversations extends CI_controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('ConversationModel');
        $this->load->helper(array('form'));
    }

    public function index(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =$session_data['id'];
            $idUser=$session_data['id'];

            $data['conversations'] = $this->ConversationModel->getConversation($idUser);
            $this->load->view('templates/header');
            $this->load->view('conversations/ConversationView', $data);
        }
        else
        {
            redirect('../index.php/login', 'refresh');
        }


    }

    public function newConversation(){
        $idUser1=$this->input->post("idUser1");
        $idUser2=$this->input->post("idUser2");
        $idConversation=$this->conversation_model->newConversation($idUser1,$idUser2);

        redirect('../index.php/conversations', 'refresh');
    }
}