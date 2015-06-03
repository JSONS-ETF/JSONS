<!--Stevan Milicic-->
<?php
Class Photo extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getByUser($id)
    {
        $this->db->select('id, timestamp, description');
        $this->db->from('Photos');
        $this->db->where('UserID', $id);
        $this->db->order_by('Timestamp', 'desc');

        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->id,
                'timestamp' => $row->timestamp,
                'description' => $row->description
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('Photos');
    }

    public function deleteByUser($id)
    {
        $this->db->where('UserID', $id);
        $this->db->delete('Photos');
    }
}