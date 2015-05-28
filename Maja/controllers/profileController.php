<?php

class ProfileController extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('profile_model');
    }
    function index($idCurr = 3)
    {
       // $id = $sess_data['id'];
        $id = 1;
        if($idCurr == null) $idCurr = 2;
        $data['id'] = $id; // ovo izvlacim iz sesije
        $data['idCurr'] = $idCurr;

        $data['prof'] = $this->profile_model->getAbout($idCurr);
        $data['status'] = $this->profile_model->getStatus($idCurr);
        $data['question'] = $this->profile_model->getQuestion($idCurr);
     //   $data1['q'] =  $this->profile_model->getQuestion();
       $data['s']= $this->profile_model->getStatuses($idCurr);
        $data['friends'] = $this->profile_model->isFriend($id,$idCurr);
        $data['userInfo'] = $this->profile_model->UserData($idCurr);   //  i ovde je current



       $this->load->view('profile',$data );
    }

    function create($par,$idCurr){

        $id = 1;

       // $this->load->library('form_validation');
        $this->load->helper('date');
        $pd = array(
            'ID' => '50' ,
            'QuestionID' => $par,
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' => $this->input->post('ans')
        );
$resp = $this->profile_model->GetAns($par);

        if($resp == NULL) {
            $fr = array(
                'ID' => '445' ,
                'User1ID' => $id,
                'User2ID' => $idCurr
            );

            $this->profile_model->addFriendship($fr);

        }
        $this->profile_model->addTableResponses($pd);
        redirect('profileController/index/'.$idCurr,'refresh');
    }

    function create_question(){
        $this->load->helper('date');
        $pd = array(
            'ID' => '44' ,
            'User1ID' => '2',
            'User2ID' => '1',
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
            'NumCuddles'=>'0',
        'NumSlaps'=>'0',
        'Obligatory'=>'0'
        );
        $this->profile_model->addQuestion($pd);
        $this->index();

    }

    function create_status(){

        $id = 1;        /// iz sesije
        $this->load->helper('date');
        $pd = array(
            'ID' => '385',
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
           'UserID'=>'1'
        );

        $this->profile_model->addStatus($pd);
        $this->index($id);
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

    function slap($id,$idCurr)
    {
        $this->profile_model->slap($id);
        redirect('profileController/index/'.$idCurr,'refresh');
    }

}