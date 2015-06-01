<!--Stevan Milicic-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminHome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin','',TRUE);
        $this->load->model('user','',TRUE);
        $this->load->model('status','',TRUE);
        $this->load->model('notification','',TRUE);
        $this->load->model('conversation','',TRUE);
        $this->load->model('message','',TRUE);
        $this->load->model('photo','',TRUE);
        $this->load->model('question','',TRUE);
        $this->load->model('response','',TRUE);
    }

    function index()
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $session_data = $this->session->userdata('admin_logged_in');

            $headerData['path'] = '../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['username'] = $session_data['username'];
            $data['accesscode'] = $session_data['accesscode'];
            $data['users'] = $this->user->listAll();
            $this->load->view('Admin/Home', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function gotoHome()
    {
        if($this->session->userdata('admin_logged_in'))
        {
            redirect('AdminHome', 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editUser($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $this->load->view('Admin/EditUser', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editNotifications($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {

            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['notifications'] = $this->notification->getByUser($id);
            $this->load->view('Admin/EditUserNotifications', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editStatuses($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['statuses'] = $this->status->getByUser($id);
            $this->load->view('Admin/EditUserStatuses', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editConversations($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['conversations'] = $this->conversation->getByUser($id);
            $this->load->view('Admin/EditUserConversations', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editConversationMessages($userID, $conversationID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($userID);
            $data['conversation'] = $this->conversation->get($userID, $conversationID);
            $data['messages'] = $this->message->getByConversation($conversationID);
            $this->load->view('Admin/EditUserConversationMessages', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editPhotos($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['photos'] = $this->photo->getByUser($id);
            $this->load->view('Admin/EditUserPhotos', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editQuestions($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['questions'] = $this->question->getByUser($id);
            $this->load->view('Admin/EditUserQuestions', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editQuestionResponses($userID, $questionID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($userID);
            $data['question'] = $this->question->get($questionID);
            $data['responses'] = $this->response->getByQuestion($questionID);
            $this->load->view('Admin/EditUserQuestionResponses', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function editResponses($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $headerData['path'] = '../../../';
            $this->load->view('templates//HeaderAdmin',$headerData);

            $data['user'] = $this->user->get($id);
            $data['responses'] = $this->response->getByUser($id);
            $this->load->view('Admin/EditUserResponses', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function newAdmin()
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $session_data = $this->session->userdata('admin_logged_in');
            $data['username'] = $session_data['username'];

            $code = $this->admin->create();
            $data['accesscode'] = $code;

            $session_data['accesscode'] = $code;
            $this->session->set_userdata('admin_logged_in', $session_data);

            redirect('AdminHome', 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteUser($id)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->user->delete($id);
            redirect('AdminHome', 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteNotification($userID, $notificationID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->notification->delete($notificationID);
            redirect('AdminHome/editNotifications/'.$userID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteStatus($userID, $statusID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->status->delete($statusID);
            redirect('AdminHome/editStatuses/'.$userID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteConversation($userID, $conversationID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->conversation->delete($conversationID);
            redirect('AdminHome/editConversations/'.$userID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteMessage($userID, $conversationID, $messageID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->message->delete($messageID);
            redirect('AdminHome/editConversationMessages/'.$userID.'/'.$conversationID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteQuestion($userID, $questionID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->question->delete($questionID);
            redirect('AdminHome/editQuestions/'.$userID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteQuestionResponse($userID, $questionID, $responseID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->response->delete($responseID);
            redirect('AdminHome/editQuestionResponses/'.$userID.'/'.$questionID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function deleteResponse($userID, $responseID)
    {
        if($this->session->userdata('admin_logged_in'))
        {
            $this->response->delete($responseID);
            redirect('AdminHome/editResponses/'.$userID, 'refresh');
        }
        else
        {
            //If no session, redirect to login page
            redirect('AdminLogin', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        session_destroy();
        redirect('AdminHome', 'refresh');
    }
}

?>