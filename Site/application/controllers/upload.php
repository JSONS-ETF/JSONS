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
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }

    function index()
    {
        // if($this->session->userdata('logged_in'))
        //  {
        //     $session_data = $this->session->userdata('logged_in');
        $data['idUser'] =2;// $session_data['id'];
        $idUser=2;//$session_data['id'];

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

        $path = 'photos/'.$idUser;
        if (!file_exists($path)) {
            mkdir($path);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = '100';
        //$config['max_width'] = '1024';
       // $config['max_height'] = '768';
        $config['file_name'] = $idPhoto;


        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            //$data = array('error' => $this->upload->display_errors());
            $data["idUser"]=$idUser;

            $this->load->view('uploadView', $data);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data["idUser"]=$idUser;

            $this->load->view('uploadView', $data);
        }
    }
}