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
            $data['username'] =$session_data['username'];
            $idUser=$session_data['id'];

            $data['conversations'] = $this->ConversationModel->getConversation($idUser);

            $this->load->view('templates/header');
            $this->load->view('conversations/ConversationView', $data);
        }
        else
        {
            redirect('../index.php/UserLogin', 'refresh');
        }
    }

    public function newConversation(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =$session_data['id'];
            $data['username'] =$session_data['username'];
            $data['photo'] =$session_data['photo'];
            $idUser=$session_data['id'];

            $newUser=$this->input->post("newUser");
            $idConversation=$this->ConversationModel->newConversation($idUser,$newUser);

            if ($idConversation!=-1)
                redirect('../index.php/messages/index/'.$idConversation, 'refresh');
            else
                redirect('../index.php/conversations','refresh');
        }
        else
        {
            redirect('../index.php/UserLogin', 'refresh');
        }

    }
}