<!--Stevan Milicic-->
<?php
Class Response extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getByUser($id)
    {
        $this->db->select('r.id as r_id, r.timestamp as r_timestamp, r.text as r_text, u1.username as user1, u2.username as user2, q.text as q_text');
        $this->db->from('Responses r');
        $this->db->join('Questions q', 'r.QuestionID = q.ID');
        $this->db->join('Users u1', 'q.User1ID = u1.ID');
        $this->db->join('Users u2', 'q.User2ID = u2.ID');
        $this->db->where('q.User2ID', $id);
        $this->db->order_by('r.Timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->r_id,
                'timestamp' => $row->r_timestamp,
                'response' => $row->r_text,
                'from' => $row->user1,
                'to' => $row->user2,
                'question' => $row->q_text
            ));
        }

        return $ret;
    }

    public function insertBasic($responses)
    {
        foreach($responses as $response)
        {
            $this->db->insert('BaseResponses', $response);
        }
    }

    public function getByQuestion($id)
    {
        $this->db->select('r.id as r_id, r.timestamp as r_timestamp, r.text as r_text, q.text as q_text');
        $this->db->from('Responses r');
        $this->db->join('Questions q', 'r.QuestionID = q.ID');
        $this->db->where('QuestionID', $id);
        $this->db->order_by('r.Timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->r_id,
                'timestamp' => $row->r_timestamp,
                'text' => $row->r_text,
                'question' => $row->q_text
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Responses');
    }

    public function deleteByQuestion($id)
    {
        $this->db->where('QuestionID', $id);
        $this->db->delete('Responses');
    }

    public function deleteBasicByUser($id)
    {
        $this->db->where('UserID', $id);
        $this->db->delete('BaseResponses');
    }
}