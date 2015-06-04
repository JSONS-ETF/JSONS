<?php


class TestConversation extends CI_Controller
{
    public function index()
    {
        $this->load->library('unit_test');
        $this->load->model('ConversationModel');

        $this->test();

        echo $this->unit->report();
    }

    function test()
    {
        $idUser1=2;
        $newUser='boka';

        $result=$this->ConversationModel->newConversation($idUser1,$newUser);
        $this->unit->run(-3 ,$result, 'test_svinjcica');
    }
}
