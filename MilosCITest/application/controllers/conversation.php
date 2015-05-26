<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/25/2015
 * Time: 8:03 PM
 */

class conversation extends CI_controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('conversation_model');
    }

    public function index(){
      //  if($this->session->userdata('logged_in'))
      //  {
       //     $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =1; //$session_data['id'];
            $idUser=1;//$session_data['id'];

            $data['conversations'] = $this->conversation_model->getConversation($idUser);
            $this->load->view('conversationView', $data);
     //   }
      //  else
     //   {
     //       redirect('../index.php/login', 'refresh');
    //    }


    }

    public function newConversation(){
        $idUser1=$this->input->post("idUser1");
        $idUser2=$this->input->post("idUser2");
        $idConversation=$this->conversation_model->newConversation($idUser1,$idUser2);

        redirect('../index.php/conversation', 'refresh');
    }
}