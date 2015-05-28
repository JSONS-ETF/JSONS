<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/18/2015
 * Time: 1:23 AM
 */

class messages extends CI_controller{

    function __construct(){
        parent::__construct();
		$this->load->library('session');
        $this->load->model('MessagesModel');
        $this->load->helper('url');
    }

    public function index($idConversation,$guestUsername){

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] = $session_data['id'];
            $idUser=$session_data['id'];

            $data['messages'] = $this->MessagesModel->getMessages($idConversation);
            $data['idConversation']=$idConversation;
            $data['guestUsername']=$guestUsername;

            $this->load->view('templates/header');
            $this->load->view('conversations/MessagesView', $data);
        }
        else
        {
            redirect('../index.php/login', 'refresh');
        }


    }

    public function sendMessage(){
        $message=$this->input->post("message");
        $idConversation=$this->input->post("idConversation");
        $idUser=$this->input->post("idUser");
        $this->MessagesModel->sendMessage($idConversation,$message,$idUser);
    }

    public function checkMessage()
    {
        $idConversation=$this->input->post("idConversation");
        $diff=$this->input->post("diff");
        $data['checkmessage'] = $this->MessagesModel->checkMessage($idConversation,$diff);
        header('Content-type: text/plain');
        header('Content-type: application/json');
        echo json_encode($data['checkmessage']);
    }
}