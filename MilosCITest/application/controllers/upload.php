<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/27/2015
 * Time: 12:26 AM
 */

class upload  extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('upload_model');
        $this->load->helper(array('form', 'url'));
    }

    function index()
    {
        // if($this->session->userdata('logged_in'))
        //  {
        //     $session_data = $this->session->userdata('logged_in');
        $data['idUser'] =1;// $session_data['id'];
        $idUser=1;//$session_data['id'];

        $this->load->view('uploadView', $data);
        // }
        //  else
        //  {
        //      redirect('../index.php/login', 'refresh');
        //  }
    }

    function do_upload()
    {
        $idUser=$this->input->post("idUser");
        $description=$this->input->post("description");
        $idPhoto= $this->upload_model->newPhoto($idUser,$description);

        $config['upload_path'] = '../photos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $idPhoto;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }
}