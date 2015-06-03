<!--Stevan Milicic-->
<?php
Class Admin extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    function login($username, $password)
    {
        $this->db->select('id, username, password');
        $this->db->from('administrators');
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

    function randomString($length = 16)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charCount = strlen($chars);
        $str = '';
        for ($i = 0;  $i < $length; $i++)
            $str .= $chars[rand(0, $charCount - 1)];

        return $str;
    }

    function create()
    {
        $code = $this->randomString(32);

        $this->load->helper('url');

        $data = array(
            'email' => null,
            'username' => null,
            'password' => null,
            'accesscode' => $code,
            'activated' => 0
        );

        $this->db->insert('administrators', $data);

        return $code;
    }

    function activate()
    {
        $code = $this->input->post('accesscode');

        $this->db->where('accesscode', $code);
        $this->db->where('activated', 0);
        $result = $this->db->get('administrators');

        if ($result->num_rows() === 1)
        {

            $data = array(
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => MD5($this->input->post('password')),
                'activated' => 1
            );


            $this->db->where('accesscode', $code);
            $this->db->where('activated', 0);
            $this->db->update('administrators', $data);
            return TRUE;
        }

        return FALSE;
    }
}