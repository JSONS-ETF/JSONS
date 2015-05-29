//Stevan Milicic
<?php
Class Friendship extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function deleteByUser($id)
    {
        $this->db->where('User1ID', $id);
        $this->db->or_where('User2ID', $id);
        $this->db->delete('Friendships');
    }
}