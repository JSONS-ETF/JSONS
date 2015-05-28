<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/18/2015
 * Time: 12:51 AM
 */

class chat_model extends CI_Model{
    var $times=0;
    function __construct(){
        $this->load->database();
        parent::__construct();
    }

    function getMessages($idConversation){

        $this->db->select('*')->from('Messages');
        $this->db->where('ConversationID', $idConversation);
        $this->db->order_by("Timestamp", "ASC");
        $query = $this->db->get();

        $messages = array();

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

    function checkMessage($idConversation,$diff){

        #$sql='SELECT * FROM messages WHERE idConversation='.$idConversation.' AND UNIX_TIMESTAMP(datetime)>=(UNIX_TIMESTAMP(now())-1-'.$diff.')';
        //return 'SELECT * FROM Messages WHERE ConversationID='.$idConversation.' AND DATEDIFF(SECOND,Timestamp, GETDATE())>=DATEDIFF(SECOND,"1970/01/01", GETDATE())-1-'.$diff;
        $sql = "SELECT * FROM Messages WHERE ConversationID=".$idConversation." AND DATEDIFF(SECOND,'1970/01/01', Timestamp)>=DATEDIFF(SECOND,'1970/01/01', GETDATE())-2-".$diff;


       /* $this->db->select('*')->from('Messages');
        $this->db->where('ConversationID', $idConversation);
        $this->db->where("DATEDIFF(SECOND,Timestamp, GETDATE())>=",(int)( "DATEDIFF(SECOND,'1970/01/01', GETDATE())-1-".$diff));
        $this->db->order_by("Timestamp", "ASC");
        $query = $this->db->get();
*/
        $query=$this->db->query($sql);
        $checkmessage = array();

            foreach ($query->result() as $row) {
                $checkmessage[$row->ID] = array('message'=>$row->Text,'timestamp'=>$row->Timestamp, 'idUser'=>$row->UserID);
           }

        return $checkmessage;
    }
}