<?php
class Friends_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    function getFriends($idCurr)
    {

        $this->db->select('users.UserName as UserName, users.FirstName as FirstName, users.LastName as LastName, users.PhotoID as PhotoID, Friendships.User2ID as UserID');
        $this->db->from('Friendships');
        $this->db->where('User1ID', $idCurr);
        $this->db->join('users', 'users.ID = Friendships.User2ID');
        //   $this->db->or_where('User2ID', $idCurr);


        $q1 = $this->db->get();
        $this->db->select('users.UserName as UserName, users.FirstName as FirstName, users.LastName as LastName, users.PhotoID as PhotoID, Friendships.User1ID as UserID');
        $this->db->from('Friendships');
        $this->db->where('User2ID', $idCurr);
        $this->db->join('users', 'users.ID = Friendships.User1ID');

        $q2 = $this->db->get();

        $data = array();
        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $row) {
                $t = array(
                    'UserName' => $row->UserName,
                    'FirstName' => $row->FirstName,
                    'LastName' => $row->LastName,
                    'PhotoID' => $row->PhotoID,
                    'UserID' => $row->UserID
                );
                array_push($data, $t);
            }

        }
        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $row) {
                $t = array(
                    'UserName' => $row->UserName,
                    'FirstName' => $row->FirstName,
                    'LastName' => $row->LastName,
                    'PhotoID' => $row->PhotoID,
                    'UserID' => $row->UserID
                );
                array_push($data, $t);

            }

        }


        return $data;
    }


    function getName($idCurr)
    {
        $this->db->select('users.UserName as UserName');
        $this->db->from('users');
        $this->db->where('ID', $idCurr);
        $q = $this->db->get();

        $res = $q->result();

        return array(
            'UserName' => $res[0]->UserName
        );

    }
}