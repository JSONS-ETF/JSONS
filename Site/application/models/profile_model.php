<?php

class Profile_model extends CI_Model
{

    function __construct(){
        parent::__construct();

        $this->load->database();

    }

function GetAns($i){

    $this->db->select('*');
    $this->db->from('responses');
    $this->db->where('responses.QuestionID', $i);
    $q = $this->db->get();

    if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
            $data[] = $row;

        }
        return $data;
    }
}

    function getAbout($id)
    {

        $data = "";
        $q = $this->db->get_where('users', array('ID' => $id));
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;
        }
    }

    function getStatus($id)
    {
        $this->db->select('*');
        $this->db->from('statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by("Timestamp", "desc");
        $q = $this->db->get();
        $i = 1;
        if ($q->num_rows() > 0) {

            foreach ($q->result() as $m) {
                if ($i == 1) {
                    $data[] = $m;
                    break;
                }
                // echo $m->name;
            }
            return $data;
        }
    }

    function getQuestion($currId)
    {

        $zavrsni = array();
        $this->db->select('questions.ID as ID, questions.User1ID as U1, questions.User2ID as U2, questions.Timestamp as QDate,questions.Text as QText, questions.NumCuddles as NumCuddles, questions.NumSlaps as NumSlaps, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname,');
        $this->db->from('questions');
        $this->db->where('User2ID',$currId);
        $this->db->join('users','questions.User1ID = users.ID');
        $this->db->order_by('questions.Timestamp', 'DESC');

        $aq = $this->db->get();
$ret='';
     //   if ($aq->num_rows() > 0) {
            foreach ($aq->result() as $m) {
                $ret[] = $m;
                // echo $m->name;
            }

      //  }


       if($ret)foreach($ret as $row){
            $this->db->select('*');
            $this->db->from('responses');
            $this->db->where('responses.QuestionID', $row->ID);
            $this->db->order_by('responses.Timestamp','DESC');
            $res = $this->db->get();
            $odgovori= array();

          //  if ($res->num_rows() > 0) {
                foreach ($res->result() as $m2) {

                    array_push($odgovori,
                        array(
                            'QuestionID' => $m2->QuestionID,
                            'TimestampR' => $m2->Timestamp,
                            'TextR'=> $m2->Text
                        )
                        );
                    // echo $m->name;
                }

         //   }

array_push($zavrsni,
array(
    'ID' => $row->ID,
    'User1ID' => $row->U1,
    'User2ID' => $row->U2,
    'TimestampQ' => $row->QDate,
    'TextQ' => $row->QText,
    'NumCuddles' => $row->NumCuddles,
    'NumSlaps' => $row->NumSlaps,
    'Name' => $row->Name,
    'UsernameU2' => $row->UsernameU2 ,
    'LastName'=> $row->Surname,
    'odg'=> $odgovori
)
);

        }





return $zavrsni;

    }

    function addTableResponses($pd){
         $this->db->insert('responses',$pd);
 }

    function addQuestion($pd){
        $this->db->insert('questions',$pd);
    }

    function addStatus($pd){
        $this->db->insert('statuses',$pd);
    }


    function addFriendship($pd){
        $this->db->insert('Friendships',$pd);
    }


    function getStatuses($id)
    {

        $this->db->select('statuses.Timestamp, statuses.Text');
        $this->db->from('statuses');
        $this->db->where('statuses.UserID', $id);
        $this->db->order_by("Timestamp", "desc");
        $q = $this->db->get();


        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;

            }
            return $data;
        }

    }

    function isFriend($id,$idCurrent){

        $a1 = array('User1ID' => $id, 'User2ID' => $idCurrent);
        $a2 = array('User2ID' => $id, 'User1ID' => $idCurrent);
            $this->db->select('*');
            $this->db->from('Friendships');
            $this->db->where($a1);
            $this->db->or_where($a2);
        $q = $this->db->get();


        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
            }
            return $data;
        }
        return NULL;
    }


    function getPhotos($idCurr){
        $photos=array();
        $this->db->select('*');
        $this->db->from('Photos');
        $this->db->where('UserID',$idCurr);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $photos[$row->ID] = array('cuddles' => $row->NumCuddles,'slaps' => $row->NumSlaps, 'timestamp' => $row->Timestamp, 'description' => $row->Description);
        }
        return $photos;
    }

    function UserData($currID){

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.ID',$currID);
        $q =  $this->db->get();

        $data[] = '';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;

        }
        return NUll;
    }


    function cuddle($id)
    {
        $this->db->set('questions.NumCuddles', 'NumCuddles+1', FALSE);
        $this->db->where('questions.ID', $id);
        $this->db->update('questions');

    }

    function cuddlePhoto($idPhoto)
    {
        $this->db->trans_start();
        $this->db->set('NumCuddles', 'NumCuddles+1', FALSE);
        $this->db->where('ID', $idPhoto);
        $this->db->update('Photos');

        $this->db->select('NumCuddles')->from('Photos');
        $this->db->where('ID', $idPhoto);
        $query = $this->db->get();
        $cud=$query->row('NumCuddles');

        $this->db->trans_complete();
        return $cud;
    }

    function slapPhoto($idPhoto)
    {

        $this->db->trans_start();
        $this->db->set('NumSlaps', 'NumSlaps+1', FALSE);
        $this->db->where('ID', $idPhoto);
        $this->db->update('Photos');

        $this->db->select('NumSlaps')->from('Photos');
        $this->db->where('ID', $idPhoto);
        $query = $this->db->get();
        $cud=$query->row('NumSlaps');

        $this->db->trans_complete();
        return $cud;
    }

    function deletePhoto($idPhoto)
    {
        $this->db->delete('Photos', array('ID' => $idPhoto));
    }

    function slap($id)
    {

        $this->db->set('NumSlaps', 'NumSlaps+1', FALSE);
        $this->db->where('ID', $id);
        $this->db->update('questions');
    }

    function addBlock($pd){
$this->db->insert('Blocks',$pd);
    }

    function newPhoto($idUser,$description){

        $this->db->trans_start();
        $idPhoto=0;

        $sql="INSERT INTO Photos (UserID, NumCuddles, NumSlaps, Timestamp, Description) VALUES (".$idUser.",0,0,GETDATE(),'".$description."')";
        $this->db->query($sql);

        $this->db->select('MAX(ID) as id')->from('Photos');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $idPhoto=$row->id;
        }

        $this->db->where('ID', $idUser);
        $this->db->update('Users', array('PhotoID' => $idPhoto));

        $this->db->trans_complete();

        return $idPhoto;
    }
}




