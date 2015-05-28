<?php
Class Conversation extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('message','',TRUE);
    }

    public function get($userID, $conversationID)
    {
        $this->db->select('c.id as c_id, c.user1id as c_u1id, c.user2id as c_u2id, c.timestamp as c_timestamp, u1.username as user1, u2.username user2');
        $this->db->from('Conversations c');
        $this->db->join('Users u1', 'c.User1ID = u1.ID');
        $this->db->join('Users u2', 'c.User2ID = u2.ID');
        $this->db->where('c.id', $conversationID);
        $this->db->order_by('c.timestamp', 'desc');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            return array(
                'id' => $row->c_id,
                'u1id' => $row->c_u1id,
                'u2id' => $row->c_u2id,
                'timestamp' => $row->c_timestamp,
                'user1' => $row->user1,
                'user2' => $row->user2,
                'participant' => ($row->c_u1id == $userID ? $row->user2 : $row->user1)
            );
        }
    }

    public function getByUser($id)
    {
        $this->db->select('c.id as c_id, c.user1id as c_u1id, c.user2id as c_u2id, c.timestamp as c_timestamp, u1.username as user1, u2.username user2');
        $this->db->from('Conversations c');
        $this->db->join('Users u1', 'c.User1ID = u1.ID');
        $this->db->join('Users u2', 'c.User2ID = u2.ID');
        $this->db->where('c.User1ID', $id);
        $this->db->or_where('c.User2ID', $id);
        $this->db->order_by('c.timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->c_id,
                'u1id' => $row->c_u1id,
                'u2id' => $row->c_u2id,
                'timestamp' => $row->c_timestamp,
                'user1' => $row->user1,
                'user2' => $row->user2,
                'participant' => ($row->c_u1id == $id ? $row->user2 : $row->user1)
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->message->deleteByConversation($id);

        $this->db->where('ID', $id);
        $this->db->delete('Conversations');
    }

    public function deleteByUser($id)
    {
        $this->db->select('id, user1id, user2id');
        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->from('Conversations');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $this->message->deleteByConversation($row->id);
        }

        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->delete('Conversations');
    }
}