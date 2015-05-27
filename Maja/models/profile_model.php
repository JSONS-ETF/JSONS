<?php

class Profile_model extends CI_Model
{

    function __construct(){
        parent::__construct();

    }

    function getAbout()
    {
        //    $q = $this->db->query("select* from users");
        $data = "";
        $id = 1;
        $q = $this->db->get_where('users', array('ID' => $id));
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;
        }
    }

    function getStatus()
    {
        $id = 1;

        // SELECT * FROM questions ORDER BY questions.DateTime2 DESC


        //    $q = $this->db->get_where('statuses', array('UserID' => $id));
        // $q = $this->db->query(" SELECT * FROM statuses WHERE UserID=>$id ORDER BY DateTime2 DESC ");
        $this->db->select('*');
        $this->db->from('statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by("DateTime2", "desc");
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

    function getQuestion()
    {
        $id = 1;
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

        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID, 2 as type');
        $this->db->from('questions');   //type = 2
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID', 'left outer');
        $this->db->join('users','questions.User2ID = users.ID' );
        $this->db->order_by('questions.DateTime2,responses.DateTime2', 'DESC');
        $q = $this->db->get();
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
        $data[] = '';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;

        }

    }

    function addTable($pd){
         $this->db->insert('responses',$pd);
 }

    function addQuestion($pd){
        $this->db->insert('questions',$pd);
    }

    function addStatus($pd){
        $this->db->insert('statuses',$pd);
    }

    function sortStatusQuestion(){
        $id = 1;
        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID, 2 as type');
        $this->db->from('questions');   //type = 2
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID');
        $this->db->join('users','questions.User2ID = users.ID' );
        $this->db->order_by('questions.DateTime2,responses.DateTime2', 'DESC');
        $q1 = $this->db->get();
        $join1 = $this->db->last_query();
        $this->db->select('statuses.DateTime2, statuses.Text, 1 as type');       //type je 1 za status
        $this->db->from('statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by("DateTime2", "desc");
        $q2 = $this->db->get();
        $join2 = $this->db->last_query();
        $union_query = $this->db->query($join1.' UNION '.$join2);
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;

            }
            return $data;
        }
    }


    function getStatuses()
    {
        $id = 1;
/*
        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID,statuses.DateTime2 as QDate, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID, 2 as type');
        $this->db->from('questions');
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID');
        $this->db->join('users', 'questions.User2ID = users.ID');
        $this->db->join('statuses', 'statuses.UserID=' . $id);
        $this->db->order_by('questions.DateTime2', 'DESC');
        $q = $this->db->get();


        $data[] = '';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;

        }*/
        $this->db->select('statuses.DateTime2, statuses.Text, 1 as type');       //type je 1 za status
        $this->db->from('statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by("DateTime2", "desc");
        $q = $this->db->get();


        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;

            }
        }
        return $data;
    }

}

