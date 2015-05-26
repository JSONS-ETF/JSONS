<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/18/2015
 * Time: 1:23 AM
 */

class chat extends CI_controller{

    function __construct(){
        parent::__construct();
        $this->load->model('chat_model');
    }

    public function index($idConversation,$guestUsername){

       // if($this->session->userdata('logged_in'))
      //  {
       //     $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =1;// $session_data['id'];
            $idUser=1;//$session_data['id'];

            $data['messages'] = $this->chat_model->getMessages($idConversation);
            $data['idConversation']=$idConversation;
            $data['guestUsername']=$guestUsername;
            $this->load->view('chatView', $data);
       // }
      //  else
      //  {
      //      redirect('../index.php/login', 'refresh');
      //  }


    }

    public function sendMessage(){
        $message=$this->input->post("message");
        $idConversation=$this->input->post("idConversation");
        $idUser=$this->input->post("idUser");
        $this->chat_model->sendMessage($idConversation,$message,$idUser);
    }

    public function checkMessage()
    {
        $idConversation=$this->input->post("idConversation");
        $diff=$this->input->post("diff");
        $data['checkmessage'] = $this->chat_model->checkMessage($idConversation,$diff);
        header('Content-type: text/plain');
        header('Content-type: application/json');
        echo json_encode($data['checkmessage']);
    }
}