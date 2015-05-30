<!--Kotlar Milos 115/12-->
<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/25/2015
 * Time: 7:19 PM
 */

class ConversationModel extends CI_Model{
    function __construct(){
        parent::__construct();

        $this->load->database();
    }

    function getConversation($idUser){
        $this->db->select('*')->from('Conversations');
        $this->db->where('User1ID', $idUser);
        $this->db->or_where('User2ID', $idUser);
        $this->db->order_by("TimeStamp", "DESC");
        $query = $this->db->get();

        $conversations=array();

        $this->db->trans_start();

        foreach ($query->result() as $row) {
            if ($row->User1ID == $idUser) {
                $this->db->select('Username, PhotoID')->from('Users');
                $this->db->where('ID', $row->User2ID);
                $queryUser = $this->db->get();

                $username=$queryUser->row('Username');
                $picture=$queryUser->row('PhotoID');

                $sql='SELECT Text FROM Messages WHERE ConversationID='.$row->ID.' AND Timestamp = (SELECT MAX(Timestamp) FROM Messages WHERE ConversationID='.$row->ID.')';
                $queryMessage = $this->db->query($sql);

                $message=$queryMessage->row("Text");

                $conversations[$row->ID] = array('idUser' => $row->User2ID,'username'=>$username, 'picture'=>$picture, 'timestamp' => $row->TimeStamp, 'message'=>$message);
            } else {
                $this->db->select('Username, PhotoID')->from('Users');
                $this->db->where('ID', $row->User1ID);
                $queryUser = $this->db->get();

                $username=$queryUser->row('Username');
                $picture=$queryUser->row('PhotoID');

                $sql='SELECT Text FROM Messages WHERE ConversationID='.$row->ID.' AND Timestamp = (SELECT MAX(Timestamp) FROM Messages WHERE ConversationID='.$row->ID.')';
                $queryMessage = $this->db->query($sql);

                $message=$queryMessage->row("Text");

                $conversations[$row->ID] = array('idUser' => $row->User1ID,'username'=>$username, 'picture'=>$picture,  'timestamp' => $row->TimeStamp ,'message'=>$message);
            }

        }

        $this->db->trans_complete();

        return $conversations;
    }

    function newConversation($idUser1,$newUser){
        $idConversation=0;

        $this->db->select('ID')->from('Users');
        $this->db->where('Username', $newUser);
        $query = $this->db->get();

        if ($query->num_rows()==0) {
            $idConversation = -1;
            return $idConversation;
        }
        $idUser2=$query->row('ID');

        $this->db->trans_start();

        $this->db->select('ID')->from('Conversations');
        $this->db->where('User1ID', $idUser1);
        $this->db->where('User2ID', $idUser2);
        $this->db->or_where('User1ID', $idUser2);
        $this->db->where('User2ID', $idUser1);
        $query = $this->db->get();

        if ($query->num_rows()){
            $idConversation= $query->row('ID');
        }else{
            $this->db->select('ID')->from('Friendships');
            $this->db->where('User1ID', $idUser1);
            $this->db->where('User2ID', $idUser2);
            $this->db->or_where('User1ID', $idUser2);
            $this->db->where('User2ID', $idUser1);
            $query = $this->db->get();

            if ($query->num_rows()==0) {
                $idConversation = -1;
            }else{
                $data = array(
                    'User1ID' => $idUser1 ,
                    'User2ID' =>  $idUser2 ,
                );
                $this->db->set('TimeStamp', 'GETDATE()', FALSE);
                $this->db->insert('Conversations', $data);

                $this->db->select('MAX(ID) as idC')->from('Conversations');
                $query = $this->db->get();

                $idConversation=$query->row('idC');
                }
            }

        $this->db->trans_complete();

        return $idConversation;
    }
}