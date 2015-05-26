<?php
Class Conversation extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('message','',TRUE);
    }

    public function deleteByUser($id)
    {
        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->from('Conversations');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $this->message->deleteByConversation($row['id']);
        }

        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->delete('Conversations');
    }
}