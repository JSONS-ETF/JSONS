<?php
Class Question extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('response','',TRUE);
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