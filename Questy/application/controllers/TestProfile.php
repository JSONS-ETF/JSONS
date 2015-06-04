<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 6/4/2015
 * Time: 11:53 PM
 */

class TestProfile extends CI_Controller{

    public function index()
    {
        $this->load->library('unit_test');
        $this->load->model('profile_model');

        $this->test1();
        $this->test2();

        echo $this->unit->report();
    }

    function test1()
    {
        $idUser1=3;
        $idUser2=2;

        $result=$this->profile_model->isFriend($idUser1,$idUser2);
        $this->unit->run(true ,$result, 'test_friendship');
    }

    function test2()
    {
        $idUser1=1;
        $idUser2=3;

        $result=$this->profile_model->IsBlocked($idUser1,$idUser2);
        $this->unit->run(false ,$result, 'test_block');
    }
}