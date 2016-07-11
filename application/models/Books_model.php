<?php

class Books_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    

    public function get_book($class = FALSE){
        if ($class === FALSE){
           $query =  $this->db->get('books');
            return $query->result_array();

        }

        $query = $this->db->get_where('books',array('name' => $class));
        return $query->row_array();

    }
    public function delete_books($id){
        $this->db->delete('books', array('id' => $id));
    }

    public function create(){
        $this -> load -> helper('url');
        $data = array
        (
            'name' => $this->input->post('name'),
            'class' => $this->input->post('class'),
            'author' => $this->input->post('author'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'rent' => $this->input->post('rent'),
            'amount' => $this->input->post('amount')

        );
        $this->db->insert('books',$data);
    }

    /*
     * Counting Of All Books
     *
     */
    public function book_count(){
       return  $this -> db -> count_all('books');
    }

    /*
     *
     * For Pagination REcord Per Page
     *
     */

    public function fetch_array($limit , $start , $class = NULL){
        $this -> db -> limit($limit, $start);
        if($class != NULL && $class != 'All-Books'){
            $this -> db -> where('class',$class);
        }
        $query = $this -> db -> get('books');
         if($query -> num_rows() > 0){
             foreach($query -> result() as $row){
                 $data[] = $row;
             }
             return $data;
         }
        return false;

    }
    public function update($id){
        $this -> load -> helper('url');
        $data = array
        (
            'name' => $this->input->post('name'),
            'class' => $this->input->post('class'),
            'author' => $this->input->post('author'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'rent' => $this->input->post('rent'),
            'amount' => $this->input->post('amount')

        );

        $this->db->set($data);
        $this -> db -> where('id',$id);
        $this->db->update('books');
    }

    public function get_book_where($id){
        $query = $this->db->get_where('books',array('id' => $id));
        return $query->row_array();
    }



}

?>