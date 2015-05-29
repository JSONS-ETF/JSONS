<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/18/2015
 * Time: 12:51 AM
 */

class MessagesModel extends CI_Model{
    function __construct(){
        parent::__construct();

        $this->load->database();
    }

    function getUserInfo($idConversation,$idUser){
        $info = array();

        $this->db->select('User1ID, User2ID')->from('Conversations');
        $this->db->where('ID', $idConversation);
        $query = $this->db->get();

        $User1ID=$query->row('User1ID');
        $User2ID=$query->row('User2ID');

        if ($User1ID==$idUser){
            $this->db->select('Username, PhotoID')->from('Users');
            $this->db->where('ID', $User2ID);
            $query = $this->db->get();
            $info=array("ID"=>$User2ID, "username"=>$query->row("Username"), "PhotoID"=>$query->row("PhotoID"));
        }else{
            $this->db->select('Username, PhotoID')->from('Users');
            $this->db->where('ID', $User1ID);
            $query = $this->db->get();
            $info=array("ID"=>$User1ID, "username"=>$query->row("Username"), "PhotoID"=>$query->row("PhotoID"));
        }

        return $info;
    }

    function getMessages($idConversation){
        $messages = array();

        $this->db->select('*')->from('Messages');
        $this->db->where('ConversationID', $idConversation);
        $this->db->order_by("Timestamp", "ASC");
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $messages[$row->ID] = array('message'=>$row->Text,'timestamp'=>$row->Timestamp,'idUser'=>$row->UserID);
        }

        return $messages;
    }
    function sendMessage($idConversation,$message,$idUser){

        $this->db->trans_start();

        $data = array(
            'ConversationID' => $idConversation ,
            'Text' => $message ,
            'UserID' => $idUser,
        );
        $this->db->set('Timestamp', 'GETDATE()', FALSE);
        $this->db->insert('Messages', $data);

        $this->db->set('TimeStamp', 'GETDATE()', FALSE);
        $this->db->where('ID', $idConversation);
        $this->db->update('Conversations');

        $this->db->trans_complete();
    }

    function checkMessage($idConversation, $diff){
        $checkmessage = array();

        $sql = "SELECT * FROM Messages WHERE ConversationID=".$idConversation." AND DATEDIFF(SECOND,'1970/01/01', Timestamp)>=DATEDIFF(SECOND,'1970/01/01', GETDATE())-2-".$diff;
        $query=$this->db->query($sql);

            foreach ($query->result() as $row) {
                $checkmessage[$row->ID] = array('message'=>$row->Text,'timestamp'=>$row->Timestamp, 'idUser'=>$row->UserID);
           }

        return $checkmessage;
    }
}