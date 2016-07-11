<?php
class Book_Issue_model extends CI_Model{
    public function __construct()
    {
        $this -> load -> database();
        $this->load->library('unit_test');
        $this -> load -> helper('date');
        $this -> load -> helper('url');
    }

    public function create(){

        $this -> load -> helper('url');
        $data = array();
        $data['student_id'] = $this->input->post('student_id');
        $data['book_id'] =  $this->input->post('book_id');
        $datestring = '%d/%m/%Y %h:%i %a';
        $time = now();

        $data['issue_date'] = mdate($datestring, $time);
        $data['time'] = now();









        $query = $this -> db -> get_where('student',array('id' => $data['student_id'] ));
        $user = $query -> row_array();
        if($user === null){
            redirect(base_url().'index.php/home');
        }



        $query = $this -> db -> get_where('books', array('id' => $data['book_id']));
        $book = $query -> row_array();
        $amount = $book['amount'];

        if($book != null && $book['amount'] > 0){
            $this -> db -> insert('book_issue',$data);
            $amount--;
            $this -> db ->set('amount',$amount);
            $this -> db -> where('id',$book['id']);
            $this ->db-> update('books');

        }

        else{
            echo "No Book To Issue";
        }




    }
     public function get($bool = FALSE){

         $this->db->select('*');
         $this->db->from('book_issue');
         $this->db->join('books', 'book_issue.book_id=books.id', 'inner');
         if($bool){
             $this -> db -> where('time','0');
         }
         else{
             $this -> db -> where('return_date','');
         }
         $query = $this->db->get();
         $result = $query -> result_array();

         for($i=0 ; $i< count($result) ; $i++) {

             $query = $this->db->get_where('student', array('id' => $result[$i]['student_id']));
             $student = $query->row_array();


             $result[$i]['student_name'] = $student['name'];
         }

         return $result;





     }
    public function delete($id){
        $this->db->delete('book_issue', array('BI_id' => $id));
    }

    public function book_return($id){


        $q=$this -> db -> get_where('book_issue',array('BI_id' => $id));
        $record = $q -> row_array();


        $issue_time = (int)$record['time'];
        $now = now();


        $datestring = '%d/%m/%Y %h:%i %a';
        $time = now();

        $return_date = mdate($datestring, $time);
        $this->db->set('return_date', $return_date);
        $this->db->set('time', '0');
        $this -> db -> where('BI_id',$id);
        $this->db->update('book_issue');

        $delta = $now - $issue_time;
        $delta = $delta/3600;
        $q = $this -> db -> get_where('books',array('id' => $record['book_id']));
        $book = $q -> row_array();
        $rent = $book['rent'];
        $amount  = $book['amount'];
        $amount++;
        $this -> db ->set('amount',$amount);
        $this -> db -> where('id',$book['id']);
        $this ->db-> update('books');
        $balence = $rent * $delta;
        $bill = $balence. ' at ' . $rent . ' for ' . $delta . ' hours<br>'.$issue_time.' to '. $now ;
        return $bill;


    }

    public function get_by_id($id){
        $q=$this -> db -> get_where('book_issue',array('BI_id' => $id));
        return $q -> row_array();
    }


}

?>