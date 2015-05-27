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
        $data['question'] = $this->profile_model->getQuestion();
        $data1['q'] =  $this->profile_model->getQuestion();
       $data['s']= $this->profile_model->getStatuses();
        $data['friends'] = $this->profile_model->isFriend();

    //  $data['question']=array_merge($data1['q'],$data2['s']);
    //    $data['question'].UNIX_TIMESTAMP(DateTime2);
       // print_r(array_sort($people, 'age', SORT_DESC)); // Sort by oldest first

            $this->load->view('pages/home',$data);
       $this->load->view('profile',$data );
    }

    function create($par,$resp){
        $id = 1;
        $idCurr =5;
       // $this->load->library('form_validation');
        $this->load->helper('date');
        $pd = array(
            'ID' => '34' ,
            'QuestionID' => $par,
            'DateTime2' => date('Y-m-d H:i:s'),
            'Text' => $this->input->post('ans')
        );

        if($resp == NULL) {
            $fr = array(
                'ID' => '43' ,
                'User1ID' => $id,
                'User2ID' => $idCurr
            );

            $this->profile_model->addFriendship($fr);

        }
        $this->profile_model->addTableResponses($pd);
        $this->index();
    }

    function create_question(){
        $this->load->helper('date');
        $pd = array(
            'ID' => '34' ,
            'User1ID' => '2',
            'User2ID' => '1',
            'DateTime2' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
            'NumCuddles'=>'0',
        'NumSlaps'=>'0',
        'Obligatory'=>'0'
        );
        $this->profile_model->addQuestion($pd);
        $this->index();

    }

    function create_status(){
        $this->load->helper('date');
        $pd = array(
            'ID' => '34',
            'DateTime2' => date('Y-m-d H:i:s'),
            'Text' =>$this->input->post('qest'),
           'UserID'=>'1'
        );

        $this->profile_model->addStatus($pd);
        $this->index();
    }

}