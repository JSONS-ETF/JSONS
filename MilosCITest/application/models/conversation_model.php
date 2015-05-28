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
        $this->db->order_by("TimeStamp", "DESC");
        $query = $this->db->get();

        $conversations=array();

        foreach ($query->result() as $row) {
            if ($row->User1ID == $idUser) {
                $this->db->select('*')->from('Users');
                $this->db->where('ID', $row->User2ID);
                $queryUser = $this->db->get();
                foreach ($queryUser->result() as $rowUser) {
                    $username=$rowUser->Username;
                    $picture=$rowUser->PhotoID;
                }
                $sql='SELECT Text FROM Messages WHERE ConversationID='.$row->ID.' AND Timestamp = (SELECT MAX(Timestamp) FROM Messages WHERE ConversationID='.$row->ID.')';
                $queryMessage = $this->db->query($sql);
                foreach ($queryMessage->result() as $rowMessage) {
                    $message=$rowMessage->Text;
                }
                $conversations[$row->ID] = array('idUser' => $row->User2ID,'username'=>$username, 'picture'=>$picture, 'timestamp' => $row->TimeStamp, 'message'=>$message);
            } else {
                $this->db->select('*')->from('Users');
                $this->db->where('ID', $row->User1ID);
                $queryUser = $this->db->get();
                foreach ($queryUser->result() as $rowUser) {
                    $username=$rowUser->Username;
                    $picture=$rowUser->PhotoID;
                }
                $sql='SELECT Text FROM Messages WHERE ConversationID='.$row->ID.' AND Timestamp = (SELECT MAX(Timestamp) FROM Messages WHERE ConversationID='.$row->ID.')';
                $queryMessage = $this->db->query($sql);
                foreach ($queryMessage->result() as $rowMessage) {
                    $message=$rowMessage->Text;
                }
                $conversations[$row->ID] = array('idUser' => $row->User1ID,'username'=>$username, 'picture'=>$picture,  'timestamp' => $row->TimeStamp ,'message'=>$message);
            }
        }

        return $conversations;
    }

    function newConversation($idUser1,$idUser2){
        $date = date('d.m.Y');
        $time = date('H:i');

        $this->db->trans_start();

      #  $sql="INSERT INTO conversations SET idUser1=$idUser1, idUser2=$idUser2, date='$date', time='$time', datetime=now()";
     #   $this->db->query($sql);

        $data = array(
            'User1ID' => $idUser1 ,
            'User2ID' =>  $idUser2 ,
        );
        $this->db->set('TimeStamp', 'GETDATE()', FALSE);
        $this->db->insert('Conversations', $data);

        $this->db->select('MAX(ID) as idC')->from('Conversations');
        $query = $this->db->get();

        $idConversation=0;
        foreach ($query->result() as $row) {
            $idConversation=$row->idC;
        }
        $this->db->trans_complete();

        return $idConversation;
    }
}