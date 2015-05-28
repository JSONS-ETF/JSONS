<?php
Class Notification extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getByUser($id)
    {
        $this->db->select('id, link, text');
        $this->db->from('Notifications');
        $this->db->where('UserID', $id);

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->id,
                'link' => $row->link,
                'text' => $row->text
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Notifications');
    }

    public function deleteByUser($id)
    {
        $this->db->where('UserID', $id);
        $this->db->delete('Notifications');
    }
}