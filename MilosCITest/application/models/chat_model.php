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

        $this->db->select('*')->from('messages');
        $this->db->where('idConversation', $idConversation);
        $this->db->order_by("datetime", "asc");
        $query = $this->db->get();

        $messages = array();

        foreach ($query->result() as $row) {
            $messages[$row->idMessage] = array('message'=>$row->message,'date'=>$row->date,'time'=>$row->time,'idUser'=>$row->idUser);
        }

        return $messages;
    }
    function sendMessage($idConversation,$message,$idUser){
        $date = date('d.m.Y');
        $time = date('H:i');

        $this->db->trans_start();

        $sql="INSERT INTO messages SET idConversation=$idConversation, message='$message', 	date='$date', time='$time', idUser='$idUser', datetime=now()";
        $this->db->query($sql);

        $sql="UPDATE conversations SET date='$date', time='$time', datetime=now() WHERE idConversation=".$idConversation;
        $this->db->query($sql);

        $this->db->trans_complete();
    }

    function checkMessage($idConversation,$diff){

        //$sql='SELECT * FROM messages WHERE idConversation='.$idConversation.' AND UNIX_TIMESTAMP(datetime)>='.$timestamp;

        $sql='SELECT * FROM messages WHERE idConversation='.$idConversation.' AND UNIX_TIMESTAMP(datetime)>=(UNIX_TIMESTAMP(now())-1-'.$diff.')';
        $query = $this->db->query($sql);

        $checkmessage = array();
            foreach ($query->result() as $row) {
                $checkmessage[$row->idMessage] = array('message'=>$row->message,'date'=>$row->date,'time'=>$row->time,'idUser'=>$row->idUser);
           }

        return $checkmessage;
    }
}