<?php
Class Notification extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function deleteByUser($id)
    {
        $this->db->where('UserID', $id);
        $this->db->delete('Notifications');
    }
}