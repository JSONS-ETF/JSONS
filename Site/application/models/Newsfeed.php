<?php


class Newsfeed extends CI_Model 
{
    public function __construct()
    {
         parent::__construct();
             
        $this->load->database();
    
    }
    
    
    
    
     function getQuestions($id,$photoid)
    {
      $this->db->distinct();  
      $this->db->select('questions.ID, questions.Timestamp as DateQ,questions.User1ID, questions.User2ID, questions.Text as TextQ,questions.NumCuddles,questions.NumSlaps, u1.Username as Username1, u2.Username as Username2,u1.PhotoID as U1PhotoID, u2.PhotoID as U2PhotoID, 2 as type');
      $this->db->from('questions');
      
      $this->db->join('friendships','questions.User1ID = friendships.User2ID OR questions.User1ID = friendships.User1ID');
      $this->db->join('users as u1','questions.User1ID = u1.ID');
      $this->db->join('users as u2','questions.User2ID = u2.ID');
      
  
     $this->db->where('friendships.User1ID =',$id);
      $this->db->or_where('friendships.User2ID =',$id);
     
       $this->db->order_by('DateQ','desc');
       $this->db->limit(10);
       $q1=$this->db->get();

        $ret=array();
        
     foreach($q1->result() as $row)
    {
     //$this->db->distinct();  
      $this->db->select('responses.Timestamp as DateR, responses.Text as TextR');
      $this->db->from('responses');
      
    //  $this->db->join('responses','responses.QuestionID=$row->ID','left');
       $this->db->where('responses.QuestionID',$row->ID);
       $this->db->order_by('responses.Timestamp','desc');
       $this->db->limit(10);
       $q2=$this->db->get();
       
       $answers=array();
        
        foreach($q2->result() as $row2)
       {
           array_push($answers,array(
                   'ID'=> $row->ID,
                   'TextR'=> $row2->TextR,
                   'DateR'=> $row2->DateR ));
                   
                   
        }
         array_push($ret,array(
             'ID'=>$row->ID,
             'Username1'=>$row->Username1,
             'Username2'=>$row->Username2,
             'User1ID'=>$row->User1ID,
             'User1PhotoId'=>$row->U1PhotoID,
             'User2PhotoId'=>$row->U2PhotoID,
             'User2ID'=>$row->User2ID,
             'DateQ' =>$row->DateQ,
             'TextQ'=>$row->TextQ,
             'Answers'=>$answers,
             'NumCuddles' => $row->NumCuddles,
             'NumSlaps'=>$row->NumSlaps,
              'PhotoID' =>$photoid,
             'type' => 2
             
         ));
      }
        
        return $ret;
       }
       
     
     
			 
        
     
     
     
     function getStatuses($id,$photoid)
    {
      $this->db->distinct();  
      $this->db->select('statuses.Timestamp as Date, statuses.UserID, statuses.Text as TextS,u.Username as Username, u.PhotoID as UPhotoID, 1 as type');
      $this->db->from('statuses','users as u');
      
      $this->db->join('friendships','statuses.UserID = friendships.User2ID OR statuses.UserID = friendships.User1ID');
      $this->db->join('users as u','statuses.UserID = u.ID');
    
     $this->db->where('friendships.User1ID =',$id);
      $this->db->or_where('friendships.User2ID =',$id);
     
       $this->db->order_by('Date','desc');
      $this->db->limit(10);
       $q=$this->db->get();
       
       $result=array();
       
          foreach($q->result() as $row)
           {
                  array_push($result,array(
                        'Username'=>$row->Username,
                         'TextS' =>$row->TextS,
                         'Date' =>$row->Date,
                         'UserID'=>$row->UserID,
                         'PhotoID' =>$photoid,
                         'UserPhotoId'=>$row->UPhotoID,

                         'type' =>1
                      
                      ));
     
           }
   
            
       return $result; 
    }


    function cuddle($id)
    {
        $this->db->trans_start();
        $this->db->set('questions.NumCuddles', 'NumCuddles+1', FALSE);
        $this->db->where('questions.ID', $id);
        $this->db->update('questions');

        $this->db->select('NumCuddles')->from('Questions');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        $cud=$query->row('NumCuddles');

        $this->db->trans_complete();
        return $cud;
    }

    function slap($id)
    {
        $this->db->trans_start();
        $this->db->set('NumSlaps', 'NumSlaps+1', FALSE);
        $this->db->where('ID', $id);
        $this->db->update('questions');

        $this->db->select('NumSlaps')->from('Questions');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        $cud=$query->row('NumSlaps');

        $this->db->trans_complete();
        return $cud;

    }
      

      
      
    }
 
    





    


