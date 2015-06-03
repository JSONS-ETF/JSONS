<!--Stevan Milicic-->
<?php
Class User extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('friendship','',TRUE);
        $this->load->model('notification','',TRUE);
        $this->load->model('status','',TRUE);
        $this->load->model('conversation','',TRUE);
        $this->load->model('question','',TRUE);
        $this->load->model('response','',TRUE);
        $this->load->model('photo','',TRUE);
    }

    public function login($username, $password)
    {
        $this->db->select('id, username, password, photoid');
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

    public function create($questions)
    {
        $this->load->helper('url');

        $pass = $this->input->post('password');
        $passRepeat = $this->input->post('password2');

        $email = $this->input->post('email');
        $username = $this->input->post('username');

        $data = array(
            'email' => $email,
            'username' => $username,
            'password' => MD5($pass),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'about' => $this->input->post('about')
        );

        if ($pass === $passRepeat)
        {
            $this->db->insert('Users', $data);

            $this->db->select('id');
            $this->db->from('Users');
            $this->db->where('email', $email);
            $this->db->where('username', $username);

            $query = $this->db->get();

            $id = 0;
            foreach ($query->result() as $row)
            {
                $id = $row->id;
            }

            //$row = $query->result()[0];

            $responses = array();

            foreach ($questions as $question)
            {
                $responseData = array(
                    'questionID' => $question['id'],
                    'userID' => $id,
                    'timestamp' => date('Y-m-d H:i:s'),
                    'text' => $this->input->post('question'.$question['id'])
                );
                array_push($responses, $responseData);
            }

            $this->response->insertBasic($responses);

            return TRUE;
        }
        else return FALSE;
    }

    public function get($id)
    {
        $this->db->select('id, username, firstname, lastname, about');
        $this->db->from('users');
        $this->db->where('id', $id);

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            return array(
                'id' => $row->id,
                'username' => $row->username,
                'firstname' => $row->firstname,
                'lastname' => $row->lastname,
                'about' => $row->about
            );
        }
    }

    public function listAll()
    {
        $this->db->select('id, username');
        $this->db->from('users');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        $ret = array();

        foreach ($query->result() as $row)
        {
            array_push($ret, array(
                'id' => $row->id,
                'username' => $row->username
            ));
        }

        return $ret;
    }

    public function delete($id)
    {
        $this->friendship->deleteByUser($id);
        $this->notification->deleteByUser($id);
        $this->status->deleteByUser($id);
        $this->conversation->deleteByUser($id);
        $this->question->deleteByUser($id);
        $this->photo->deleteByUser($id);

        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}