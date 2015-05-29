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
            $data['photoid'] =$session_data['photoid'];
            $idUser=$session_data['id'];

            $data['conversations'] = $this->ConversationModel->getConversation($idUser);

            $page["page"]=1;
            $page["id"]=$idUser;
            $this->load->view('templates/header',$page);
            $this->load->view('conversations/ConversationView', $data);
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }

    public function newConversation(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['idUser'] =$session_data['id'];
            $data['username'] =$session_data['username'];
            $data['photo'] =$session_data['photoid'];
            $idUser=$session_data['id'];

            $newUser=$this->input->post("newUser");
            $idConversation=$this->ConversationModel->newConversation($idUser,$newUser);

            if ($idConversation!=-1)
                redirect(base_url().'index.php/messages/index/'.$idConversation, 'refresh');
            else
                redirect(base_url().'index.php/conversations','refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }

    }
}