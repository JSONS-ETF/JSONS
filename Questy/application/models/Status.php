//Stevan Milicic
<?php
Class Status extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getByUser($id)
    {
        $this->db->select('id, timestamp, text');
        $this->db->from('Statuses');
        $this->db->where('UserID', $id);
        $this->db->order_by('timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->id,
                'timestamp' => $row->timestamp,
                'text' => $row->text
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Statuses');
    }

    public function deleteByUser($id)
    {
        $this->db->where('UserID', $id);
        $this->db->delete('Statuses');
    }
}