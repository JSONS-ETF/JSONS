<?php
class TestPhoto extends CI_Controller
{
public function index()
{
$this->load->library('unit_test');
$this->load->model('profile_model');

$this->test();

echo $this->unit->report();
}

function test()
{

$result=$this->profile_model->slapPhoto(65);
$this->unit->run(!false ,$result, 'test_svinjcica');
}
}
