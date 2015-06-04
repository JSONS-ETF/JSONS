<?php 


class TestAdminRandomString extends CI_Controller
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
        $result=$this->Admin->randomString(15);
        $this->unit->run(15,strlen($result), 'test2_jdaughter');
    }
}
