<?php
Class User extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    function login($username, $password)
    {
        $this->db->select('id, username, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function create()
    {
        $this->load->helper('url');

        $pass = $this->input->post('password');
        $passRepeat = $this->input->post('password2');

        $data = array(
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => MD5($pass),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'about' => $this->input->post('about')
        );

        if ($pass === $passRepeat)
        {
            $this->db->insert('users', $data);
            return TRUE;
        }
        else return FALSE;
    }
}