<?php 


class TestAdminWrongLogin extends CI_Controller
{
    public function index()
    {
        $this->load->library('unit_test');
        $this->load->model('Admin');

        $this->test();

        echo $this->unit->report();
    }

    function test()
    {
        $username="Random";
        $password="random";
        
        $result=$this->Admin->login($username, $password);
        $this->unit->run(false,$result, 'test3_jdaughter');
    }
}
