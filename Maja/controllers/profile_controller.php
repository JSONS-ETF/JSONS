<?php

class Profile_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('profile_model');
    }
    function index()
    {

        $data['prof'] = $this->profile_model->getAbout();
        $data['status'] = $this->profile_model->getStatus();
        $data['question'] = $this->profile_model->sortByDate();
       $this->load->view('profile',$data );
    }

    function create($par){

       // $this->load->library('form_validation');
$m = $this->input->post('Text');

        $pd = array(
            'ID' => '12' ,
            'QuestionID' => $par,
            'DateTime2' => '2015-05-20 00:00:00',
            'Text' => 'npr ovo bude teskt zanima me da li ce da ubaci u bazu'
        );

        $this->profile_model->add_record($pd);
        $this->index();
    }
}