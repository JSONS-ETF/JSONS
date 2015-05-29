<?php

    class Site extends CI_Controller {

        function index()
        {
/*
    $this->load->model('data_model');
    $data['rows'] = $this->data_model->getAll();
*/
  //  $this->load->view('profile');
            $this->load->model('site_model');
            $data['record'] = $this->site_model->getAll();
        }
        }
     /*
        $data1 = "";

          $data['record'] = $this->site_model->getAll();
            $this->load->view('templates/home',$data );
         //  echo 'opsa0';
        }

        function about(){
            $this->load->view('templates/about');
        }
        function doSomething(){
            echo 'DO SOMETHING';
        }*/


