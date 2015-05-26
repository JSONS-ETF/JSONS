<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/25/2015
 * Time: 7:19 PM
 */

class conversation_model extends CI_Model{
    function __construct(){
        $this->load->database();
        parent::__construct();
    }

    function getConversation($idUser){
        $this->db->select('*')->from('Conversations');
        $this->db->where('User1ID', $idUser);
        $this->db->or_where('User2ID', $idUser);
        $this->db->order_by("Timestamp", "desc");
        $query = $this->db->get();

        $conversations=array();

        foreach ($query->result() as $row) {
            if ($row->idUser1 == $idUser) {
                $this->db->select('*')->from('Users');
                $this->db->where('ID', $row->idUser2);
                $queryUser = $this->db->get();
                foreach ($queryUser->result() as $rowUser) {
                    $username=$rowUser->Username;
                    $picture=$rowUser->picture;
                }
                $sql='SELECT message FROM messages WHERE idConversation='.$row->idConversation.' AND datetime = (SELECT MAX(datetime) FROM messages WHERE idConversation='.$row->idConversation.')';
                $queryMessage = $this->db->query($sql);
                foreach ($queryMessage->result() as $rowMessage) {
                    $message=$rowMessage->message;
                }
                $conversations[$row->idConversation] = array('idUser' => $row->idUser2,'username'=>$username, 'picture'=>$picture, 'date' => $row->date, 'time' => $row->time, 'message'=>$message);
            } else {
                $this->db->select('*')->from('users');
                $this->db->where('idUser', $row->idUser1);
                $queryUser = $this->db->get();
                foreach ($queryUser->result() as $rowUser) {
                    $username=$rowUser->username;
                    $picture=$rowUser->picture;
                }
                $sql='SELECT message FROM messages WHERE idConversation='.$row->idConversation.' AND datetime = (SELECT MAX(datetime) FROM messages WHERE idConversation='.$row->idConversation.')';
                $queryMessage = $this->db->query($sql);
                foreach ($queryMessage->result() as $rowMessage) {
                    $message=$rowMessage->message;
                }
                $conversations[$row->idConversation] = array('idUser' => $row->idUser1,'username'=>$username, 'picture'=>$picture,  'date' => $row->date, 'time' => $row->time,'message'=>$message);
            }
        }

        return $conversations;
    }

    function newConversation($idUser1,$idUser2){
        $date = date('d.m.Y');
        $time = date('H:i');

        $this->db->trans_start();

        $sql="INSERT INTO conversations SET idUser1=$idUser1, idUser2=$idUser2, date='$date', time='$time', datetime=now()";
        $this->db->query($sql);

        $sql="SELECT MAX(idConversation) as idC FROM conversations";
        $query =$this->db->query($sql);

        $idConversation=0;
        foreach ($query->result() as $row) {
            $idConversation=$row->idC;
        }
        $this->db->trans_complete();

        return $idConversation;
    }
}