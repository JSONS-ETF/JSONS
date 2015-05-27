<?php


class Newsfeed extends CI_Model 
{
    public function __construct()
    {
         parent::__construct();
             
        $this->load->database();
    
    }
    
    
    
    function getQuestions($id=1)
    {
  
      $this->db->distinct();  
      $this->db->select('questions.ID, questions.Timestamp as Date,questions.User1ID, questions.User2ID, questions.Text as TextQ, questions.NumCuddles as NumCuddlesQ, questions.NumSlaps as NumSlapsQ,  responses.Timestamp as DateR, responses.Text as TextR, u1.Username as Username1, u2.Username as Username2, 2 as type');
      $this->db->from('questions','users as u1','users as u2','responses');
      
      $this->db->join('friendships','questions.User1ID = friendships.User2ID OR questions.User1ID = friendships.User1ID');
      $this->db->join('users as u1','questions.User1ID = u1.ID');
      $this->db->join('users as u2','questions.User2ID = u2.ID');
         $this->db->join('responses','questions.ID=responses.QuestionID');
  
     $this->db->where('friendships.User1ID =',$id);
      $this->db->or_where('friendships.User2ID =',$id);
     
       $this->db->order_by('Date','desc');
     // $this->db->limit(3);
       $q=$this->db->get();

          foreach($q->result() as $row)
           {
           $data[]=$row;
        
           }
  
             return $data;
     }
     
     
     
     
     function getStatuses($id=1)
    {
      $this->db->distinct();  
      $this->db->select('statuses.Timestamp as Date, statuses.UserID, statuses.Text as TextS,u.Username as Username, 1 as type');
      $this->db->from('statuses','users as u');
      
      $this->db->join('friendships','statuses.UserID = friendships.User2ID OR statuses.UserID = friendships.User1ID');
      $this->db->join('users as u','statuses.UserID = u.ID');
    
     $this->db->where('friendships.User1ID =',$id);
      $this->db->or_where('friendships.User2ID =',$id);
     
       $this->db->order_by('Date','desc');
      // $this->db->limit(3);
       $q=$this->db->get();
       
          foreach($q->result() as $row)
           {
               $data[]=$row;
     
           }
   
            
       return $data; 
    }
    
    
     function getResponses($id=1)
      {
       $this->db->distinct();  
      $this->db->select('responses.Timestamp as DateR, responses.Text as TextR, questions.User1ID, questions.User2ID, questions.Text as TextQ, u1.Username as Username1, u2.Username as Username2, 3 as type');
      $this->db->from('questions','users as u1','users as u2','responses');
      
      $this->db->join('responses','questions.ID=responses.QuestionID');
      $this->db->join('friendships','questions.User1ID = friendships.User2ID OR questions.User1ID = friendships.User1ID');
      $this->db->join('users as u1','questions.User1ID = u1.ID');
      $this->db->join('users as u2','questions.User2ID = u2.ID');
  
  
     $this->db->where('friendships.User1ID =',$id);
      $this->db->or_where('friendships.User2ID =',$id);
     
       $this->db->order_by('Date','desc');
     // $this->db->limit(3);
       $q=$this->db->get();
      
          foreach($q->result() as $row)
           {
               $data[]=$row;
     
           }
      
            
       return $data; 
      }
       
     
      
      function cuddle($id)
      {
         $this->db->where('ID', $id);
         $this->db->set('NumCuddles', 'NumCuddles+1', FALSE);
         $this->db->update('questions');  
      }
      
      function slap($id)
      {
         $this->db->where('ID', $id);
         $this->db->set('NumSlaps', 'NumSlaps+1', FALSE);
         $this->db->update('questions');  
      }
      
      
    }
 
    





    


