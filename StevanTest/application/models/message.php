<?php
Class Message extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function deleteByConversation($id)
    {
        $this->db->where('ConversationID', $id);
        $this->db->delete('Messages');
    }
}