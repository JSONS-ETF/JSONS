<!--Maja Zivkovic 528/12-->
<?php

class ProfileController extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('profile_model');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }
    function index($idCurr)
    {


       if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] =$session_data['id'];

                $id=$session_data['id'];




                $data['idCurr'] = $idCurr;
            // OVO TREBA DA STOJI NEMOJ BRISATI . KAD SE PODESI SESIJA RADICE :)
             $isBl = $this->profile_model->IsBlocked($idCurr,$id);

            if($isBl) redirect('profileController/index/'.$id, 'refresh');
else {
    $data['prof'] = $this->profile_model->getAbout($idCurr);
    $data['status'] = $this->profile_model->getStatus($idCurr);
    $data['question'] = $this->profile_model->getQuestion($idCurr);
    //   $data1['q'] =  $this->profile_model->getQuestion();
    $data['s'] = $this->profile_model->getStatuses($idCurr);
    $data['friends'] = $this->profile_model->isFriend($id, $idCurr);
    $data['userInfo'] = $this->profile_model->UserData($idCurr);   //  i ovde je current

    $data['photos'] = $this->profile_model->getPhotos($idCurr);
    $data['bbq'] = $this->profile_model->getBQ($idCurr);

    $page["page"]=2;
    $page["id"]=$id;
    $this->load->view('templates/header',$page);
    $this->load->view('profile/profile', $data);
}
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }

    }
    function create($par,$idCurr){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id=$session_data['id'];

       // $this->load->library('form_validation');
        $this->load->helper('date');
        $pd = array(

            'QuestionID' => $par,
            'Timestamp' => date('Y-m-d H:i:s'),
            'Text' => $this->input->post('ans')
        );
$resp = $this->profile_model->GetAns($par);

        if($resp == NULL){
            $fr = array(

                'User1ID' => $id,
                'User2ID' => $idCurr
            );

            $this->profile_model->addFriendship($fr);

        }
        $this->profile_model->addTableResponses($pd);
        redirect('profileController/index/'.$idCurr,'refresh');
        }
        else
            {
                redirect(site_url().'UserHome/logout', 'refresh');
            }
    }//END_CREATE

    function create_question($idCurr){
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];
            $this->load->helper('date');
            $pd = array(
                'User1ID' => $id,
                'User2ID' => $idCurr,
                'Timestamp' => date('Y-m-d H:i:s'),
                'Text' => $this->input->post('qest'),
                'NumCuddles' => '0',
                'NumSlaps' => '0'

            );
            $this->profile_model->addQuestion($pd);
            redirect('profileController/index/' . $idCurr, 'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    } //END_CREATE_QUESTION

    function block($idCurr){
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $fr = array(

                'Blocker' => $id,
                'Blockee' => $idCurr
            );
            $this->profile_model->addBlock($fr);

            redirect('profileController/index/' . $id, 'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    } //END_BLOCK

    function create_status(){

        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $this->load->helper('date');
            $pd = array(

                'Timestamp' => date('Y-m-d H:i:s'),
                'Text' => $this->input->post('qest'),
                'UserID' => $id
            );

            $this->profile_model->addStatus($pd);
            redirect('profileController/index/' . $id, 'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }

    } // END_CREATE_STATUS

    function redirect($idCurr)
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            redirect('profileController/index' . $idCurr, 'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }//END_REDIRECT

    function cuddle()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $idQ = $this->input->post("idQ");
            echo $this->profile_model->cuddle($idQ);
            // redirect('profileController/index/'.$idCurr,'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }//END_CUDDLE
    function slap()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $idQ = $this->input->post("idQ");
            echo $this->profile_model->slap($idQ);
            // redirect('profileController/index/'.$idCurr,'refresh');
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }//END_SLAP

    function cuddlePhoto()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];


            $idPhoto = $this->input->post("idPhoto");
            echo $this->profile_model->cuddlePhoto($idPhoto);
        } else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }

    function slapPhoto()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['id'];

            $idPhoto = $this->input->post("idPhoto");
            echo $this->profile_model->slapPhoto($idPhoto);
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }

    function deletePhoto($idPhoto)
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $username = $session_data['id'];
            $id = $session_data['id'];
            $photoid = $session_data['photoid'];

            if ($idPhoto==$photoid){
                $sess_array = array(
                    'id' =>  $id,
                    'username' => $username,
                    'photoid' => $photoid
                );

                $this->session->set_userdata('logged_in', $sess_array);

                $this->profile_model->deleteProfilePhoto($id);
            }

            $this->profile_model->deletePhoto($idPhoto);
            redirect('profileController/index/' . $id, 'refresh');
        } else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }

    function do_upload()
    {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $idUser = $session_data['id'];
            $username = $session_data['id'];



            $description = $this->input->post("description");
            $idCurr = $this->input->post("idCurr");
            $idPhoto = $this->profile_model->newPhoto($idUser, $description);

            $path = 'photos/' . $idUser;
            if (!file_exists($path)) {
                mkdir($path);
            }

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg';
            //$config['max_size'] = '100';
            //$config['max_width'] = '1024';
            // $config['max_height'] = '768';
            $config['file_name'] = $idPhoto;


            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                $data["err"] = array('error' => $this->upload->display_errors());
                $data["path"] = $path;
                $this->load->view('profile/profile', $data);
                // redirect('profileController/index/'.$idCurr,'refresh');
            } else {
                //$data = array('upload_data' => $this->upload->data());
                $sess_array = array(
                    'id' =>  $idUser,
                    'username' => $username,
                    'photoid' => $idPhoto
                );

                $this->session->set_userdata('logged_in', $sess_array);
                redirect('profileController/index/' . $idCurr, 'refresh');
            }
        }
        else
        {
            redirect(site_url().'UserHome/logout', 'refresh');
        }
    }



}