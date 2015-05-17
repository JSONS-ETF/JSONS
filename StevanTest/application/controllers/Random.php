<?php
class Random extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('random_model');
    }

    public function index()
    {
        $data['data'] = $this->random_model->get_data();
        $data['title'] = 'Randomness';

        $this->load->view('templates/header', $data);
        $this->load->view('random/index', $data);
        $this->load->view('templates/footer');
    }
}