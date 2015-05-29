<?php

class ProfileController extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }
    function index($idCurr)
    {
       // $id = $sess_data['id'];
        $id = 5;
 
        $data['id'] = $id; // ovo izvlacim iz sesije
        $data['idCurr'] = $idCurr;

        $isBl = $this->profile_model->IsBlocked($idCurr);
        if($isBl) redirect('profileController/index/'.$id, 'refresh');

        $data['prof'] = $this->profile_model->getAbout($idCurr);
        $data['status'] = $this->profile_model->getStatus($idCurr);
        $data['question'] = $this->profile_model->getQuestion($idCurr);
     //   $data1['q'] =  $this->profile_model->getQuestion();
       $data['s']= $this->profile_model->getStatuses($idCurr);
        $data['friends'] = $this->profile_model->isFriend($id,$idCurr);
        $data['userInfo'] = $this->profile_model->UserData($idCurr);   //  i ovde je current

        $data['photos'] = $this->profile_model->getPhotos($idCurr);

        $this->load->view('templates/header');
       $this->load->view('profile/profile',$data );
    }
    function create($par,$idCurr){

        $id = 1;

       // $this->load->library('form_validation');
        $this->load->helper('date');
        $pd = array(

            'QuestionID' => $par,
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' => $this->input->post('ans')
        );
$resp = $this->profile_model->GetAns($par);

        if($resp == NULL) {
            $fr = array(

                'User1ID' => $id,
                'User2ID' => $idCurr
            );

            $this->profile_model->addFriendship($fr);

        }
        $this->profile_model->addTableResponses($pd);
        redirect('profileController/index/'.$idCurr,'refresh');
    }

    function create_question($idCurr){
        $id = 1;
        $this->load->helper('date');
        $pd = array(
            'User1ID' => $id,
            'User2ID' => $idCurr,
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
            'NumCuddles'=>'0',
            'NumSlaps'=>'0'

        );
        $this->profile_model->addQuestion($pd);
        redirect('profileController/index/'.$idCurr, 'refresh');

    }

    function block($idCurr){
$id = 5;
        $fr = array(

            'Blocker' => $id,
            'Blockee' => $idCurr
        );
        $this->profile_model->addBlock($fr);

        redirect('profileController/index/'.$id,'refresh');
    }

    function create_status(){

        $id = 1;        /// iz sesije
        $this->load->helper('date');
        $pd = array(

            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
           'UserID'=>$id
        );

        $this->profile_model->addStatus($pd);
        redirect('profileController/index/'.$id, 'refresh');
    }

    function redirect($idCurr)
    {

        redirect('profileController/index'.$idCurr, 'refresh');
    }

    function cuddle($ide,$idCurr)
    {
        $this->profile_model->cuddle($ide);
        redirect('profileController/index/'.$idCurr,'refresh');
    }

    function cuddlePhoto()
    {
        $idCurr=5;
        $idPhoto = $this->input->post("idPhoto");
        echo $this->profile_model->cuddlePhoto($idPhoto);
    }

    function slapPhoto()
    {
        $idCurr=5;
        $idPhoto = $this->input->post("idPhoto");
        echo $this->profile_model->slapPhoto($idPhoto);
    }

    function deletePhoto($idPhoto)
    {
        $idCurr=5;
        $this->profile_model->deletePhoto($idPhoto);
        redirect('profileController/index/'.$idCurr,'refresh');
    }

    function do_upload()
    {
        $idUser = 5;
        $description=$this->input->post("description");
        $idCurr=$this->input->post("idCurr");
        $idPhoto= $this->profile_model->newPhoto($idUser,$description);

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
            $data["err"] = array('error' => $this->upload->display_errors());
            $data["path"]=$path;
            $this->load->view('profile/profile',$data );
           // redirect('profileController/index/'.$idCurr,'refresh');
        } else {
            //$data = array('upload_data' => $this->upload->data());

            redirect('profileController/index/'.$idCurr,'refresh');
        }
    }



}