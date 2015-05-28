<?php

class Profile_model extends CI_Model
{

    function __construct(){
        parent::__construct();

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

   /*   $q = $this->db->query(/*" SELECT*
       FROM questions   Q
        JOIN  responses R
         ON Q->UserID = R->QuestionId
ORDER BY Q->DateTime2 ASC " */
    //    "SELECT* FROM questions   Q, (SELECT* responses FROM  ORDER BY responses->DateTime2 ASC) R WHERE Q->UserID = R->QuestionId ORDER BY Q->DateTime2 ASC"
     // );
/*
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID');
        //$this->db->join('users', 'users.ID = questions.User2ID');
        $this->db->order_by('questions.DateTime2');
        $q = $this->db->get();
*/
/*
        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID, 2 as type');
        $this->db->from('questions');   //type = 2
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID', 'left outer');
        $this->db->join('users','questions.User2ID = users.ID' );
        $this->db->order_by('questions.DateTime2,responses.DateTime2', 'DESC');
        $q = $this->db->get();*/
/*
 *
 *
 * SELECT suppliers.supplier_id, suppliers.supplier_name, orders.order_date
FROM suppliers
INNER JOIN orders
ON suppliers.supplier_id = orders.supplier_id;

        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('User1ID', $id);

        $this->db->order_by("DateTime2", "desc");
        $q = $this->db->get();*/



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

        $this->db->select('statuses.Timestamp, statuses.Text, 1 as type');       //type je 1 za status
        $this->db->from('statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by("Timestamp", "desc");
        $q = $this->db->get();

$data='';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;

            }
        }
        return $data;
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

    function slap($id)
    {

        $this->db->set('NumSlaps', 'NumSlaps+1', FALSE);
        $this->db->where('ID', $id);
        $this->db->update('questions');
    }


}




