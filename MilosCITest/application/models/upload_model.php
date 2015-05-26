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

        $sql="INSERT INTO Photos (UserID, NumCuddles, NumSlaps, Timestamp, Description) VALUES (".$idUser.",0,0,GETDATE(),'".$description."')";
        $this->db->query($sql);

        $sql="SELECT MAX(ID) FROM Photos";
        $query=$this->db->query($sql);
        foreach ($query->result() as $row) {
            $idPhoto=$row->ID;
        }
        $this->db->trans_complete();

        return $idPhoto;
    }
}