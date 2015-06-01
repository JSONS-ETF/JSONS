//Stevan Milicic
<?php
Class Question extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('response','',TRUE);
    }

    public function get($id)
    {
        $this->db->select('q.id as q_id, q.user1id as q_u1id, q.user2id as q_u2id, q.timestamp as q_timestamp, q.text as q_text, u1.username as user1, u2.username as user2');
        $this->db->from('Questions q');
        $this->db->join('Users u1', 'q.User1ID = u1.ID');
        $this->db->join('Users u2', 'q.User2ID = u2.ID');
        $this->db->where('q.id', $id);
        $this->db->order_by('q.timestamp', 'desc');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            return array(
                'id' => $row->q_id,
                'u1id' => $row->q_u1id,
                'u2id' => $row->q_u2id,
                'timestamp' => $row->q_timestamp,
                'text' => $row->q_text,
                'user1' => $row->user1,
                'user2' => $row->user2
            );
        }
    }

    public function getByUser($id)
    {
        $this->db->select('q.id as q_id, q.user1id as q_u1id, q.user2id as q_u2id, q.timestamp as q_timestamp, q.text as q_text, u1.username as user1, u2.username as user2');
        $this->db->from('Questions q');
        $this->db->join('Users u1', 'q.User1ID = u1.ID');
        $this->db->join('Users u2', 'q.User2ID = u2.ID');
        $this->db->where('q.User1ID', $id);
        $this->db->or_where('q.User2ID', $id);
        $this->db->order_by('q.timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->q_id,
                'u1id' => $row->q_u1id,
                'u2id' => $row->q_u2id,
                'timestamp' => $row->q_timestamp,
                'text' => $row->q_text,
                'user1' => $row->user1,
                'user2' => $row->user2
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->response->deleteByQuestion($id);

        $this->db->where('ID', $id);
        $this->db->delete('Questions');
    }

    public function deleteByUser($id)
    {
        $this->db->select('id, user1id, user2id');
        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->from('Questions');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $this->response->deleteByQuestion($row->id);
        }

        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->delete('Questions');
    }
}