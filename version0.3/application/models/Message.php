//Stevan Milicic
<?php
Class Message extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getByConversation($id)
    {
        $this->db->select('m.id as m_id, m.userid as m_userid, m.timestamp as m_timestamp, m.text as m_text, u.username as u_username');
        $this->db->from('Messages m');
        $this->db->join('Users u', 'm.UserID = u.ID');
        $this->db->where('m.ConversationID', $id);
        $this->db->order_by('m.timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->m_id,
                'userid' => $row->m_userid,
                'timestamp' => $row->m_timestamp,
                'text' => $row->m_text,
                'username' => $row->u_username
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Messages');
    }

    public function deleteByConversation($id)
    {
        $this->db->where('ConversationID', $id);
        $this->db->delete('Messages');
    }
}