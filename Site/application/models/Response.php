<?php
Class Response extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function deleteByQuestion($id)
    {
        $this->db->where('QuestionID', $id);
        $this->db->delete('Responses');
    }
}