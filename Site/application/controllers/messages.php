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

    public function index($idConversation){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =$session_data['id'];
            $data['username'] =$session_data['username'];
            $idUser=$session_data['id'];

            $data['info']=$this->MessagesModel->getUserInfo($idConversation,$idUser);
            $data['messages'] = $this->MessagesModel->getMessages($idConversation);

            $data['idConversation']=$idConversation;

            $this->load->view('templates/header');
            $this->load->view('conversations/MessagesView', $data);
        }
        else
        {
            redirect('../index.php/login', 'refresh');
        }
    }

    public function sendMessage(){
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $idUser = $session_data['id'];

            $message = $this->input->post("message");
            $idConversation = $this->input->post("idConversation");

            $this->MessagesModel->sendMessage($idConversation, $message, $idUser);
        }
        else
        {
        redirect('../index.php/login', 'refresh');
        }
    }

    public function checkMessage()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $idUser = $session_data['id'];

            $diff = $this->input->post("diff");
            $idConversation = $this->input->post("idConversation");

            $data['checkmessage'] = $this->MessagesModel->checkMessage($idConversation, $diff);
            header('Content-type: text/plain');
            header('Content-type: application/json');
            echo json_encode($data['checkmessage']);
        }else
            {
                redirect('../index.php/login', 'refresh');
            }
    }
}