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

        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID');
        $this->db->from('questions');
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID');
        $this->db->join('users','questions.User2ID = users.ID' );
        $this->db->order_by('questions.DateTime2', 'DESC');
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

    function add_record($pd){
         $this->db->insert('responses',$pd);
 }
/*
    function getStatuses()
    {
        $id = 1;

        $this->db->select('questions.Text as QText, responses.Text as RText, questions.User2ID as User2ID,statuses.DateTime2 as QDate, questions.DateTime2 as QDate, responses.DateTime2 as RDate, questions.NumSlaps as Slaps, questions.NumCuddles as Cuddles, users.FirstName as Name, users.Username as UsernameU2 ,users.LastName as Surname, questions.ID as QID, responses.QuestionID as RQID, 2 as type');
        $this->db->from('questions');
        $this->db->where('User1ID', $id);
        $this->db->join('responses', 'questions.ID = responses.QuestionID');
        $this->db->join('users','questions.User2ID = users.ID' );
        $this->db->join('statuses','statuses.UserID='.$id);
        $this->db->order_by('questions.DateTime2', 'DESC');
        $q = $this->db->get();


        $data[] = '';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $m) {
                $data[] = $m;
                // echo $m->name;
            }
            return $data;

        }
//    "SELECT* FROM questions   Q, (SELECT* responses FROM  ORDER BY responses->DateTime2 ASC) R WHERE Q->UserID = R->QuestionId ORDER BY Q->DateTime2 ASC"

  /*      $this->db->query("
SELECT questions.Text AS QText, responses.Text AS RText, questions.User2ID AS User2ID, questions.DateTime2 AS QDate, responses.DateTime2 AS RDate, questions.NumSlaps AS Slaps, questions.NumCuddles AS Cuddles, users.FirstName AS Name, users.Username AS UsernameU2 ,users.LastName AS Surname, questions.ID AS QID, responses.QuestionID AS RQID
FROM questions
WHERE User1ID = $id
JOIN responses ON questions.ID = responses.QuestionID
JOIN users ON questions.User2ID = users.ID
UNION ALL
SELECT statuses.DateTime2 as QDate, statuses.Text as SText
FROM  statuses
WHERE statuses.UserID = $id

ORDER  by QDate

");
*/
    
}

