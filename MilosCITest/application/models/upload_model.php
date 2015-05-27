<?php
/**
 * Created by PhpStorm.
 * User: solim
 * Date: 5/27/2015
 * Time: 12:38 AM
 */

class upload_model extends CI_Model{
    function __construct(){
        $this->load->database();
        parent::__construct();
    }

    function newPhoto($idUser,$description){

        $this->db->trans_start();
        $idPhoto=0;

        $sql="INSERT INTO Photos (UserID, NumCuddles, NumSlaps, Timestamp, Description, Content) VALUES (".$idUser.",0,0,GETDATE(),'".$description."',0x4F)";
        $this->db->query($sql);

        $this->db->select('MAX(ID) as id')->from('Photos');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $idPhoto=$row->id;
        }
        $this->db->trans_complete();

        return $idPhoto;
    }
}