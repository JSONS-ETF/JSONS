<?php
class Random_model extends CI_Model
{
    public function __contruct()
    {
        // load db
    }

    public function get_data()
    {
        $data = array(
            'glupost',
            'random',
            'stagod',
            'blabla'
        );

        return $data;
    }
}