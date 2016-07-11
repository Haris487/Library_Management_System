<?php
 class Book_Issue extends CI_Controller{
     public function __construct()
     {
         parent:: __construct();
         $this -> load -> model('book_issue_model');
         $this -> load -> model('student_model');
         $this -> load -> model('books_model');
         $this-> load ->helper('url_helper');
     }

     public function index(){
         $data['title'] = 'Book_Issue';
         $data['records'] = $this -> book_issue_model -> get();

         $this -> load -> view('templates/header',$data);
         $this -> load -> view('Book_issue/index',$data);
         $this -> load -> view('templates/footer');

     }

     public function list_book_return(){
         $data['title'] = 'Book_Return';
         $data['records'] = $this -> book_issue_model -> get(TRUE);
         
         
         $this -> load -> view('templates/header',$data);
         $this -> load -> view('Book_issue/index',$data);
         $this -> load -> view('templates/footer');

     }

     public function issue(){
         $this->load->helper('form');
         $this->load->library('form_validation');
         /*
          *
          *
          *    Form Configuration
          *       $data['title']  TITLE AND SUBMIT BUTTON VALUE
          *       $data['fields']  BASSICALLY AN ARRAY OF FIELDS TO BE INPUT
          *       $data['action']  ACTION ON PAGE BASSICALLY CURRENT CONTROLLER_CLASS / FUNCTION
          *       $data['authenticate'] ARRAY OF ALLOWED TYPE
          *
          *
          */
         $data['authenticate'] = array(
             'admin',
             'librarian'

         );
         $data['title'] = 'Book Issue';
         $fields = array(
             'student_id',
             'book_id'
         );
         $data['fields'] = $fields;
         $data['action'] = 'Book_Issue/issue';
         $data['values'] = null;
         foreach($fields as $rule) {
             $this->form_validation->set_rules($rule, $rule, 'required');
         }



         if($this->form_validation->run()=== FALSE){
             $this->load->view('templates/header',$data);
             $this->load->view('Form/index.php');
             $this->load->view('templates/footer');


         }
         else{
             $this->book_issue_model->create();
             $this->load->view('news/success');

         }


     }

     public function delete($id){
         $this -> book_issue_model -> delete($id);
         redirect('Book_Issue');

     }

     public function book_return($id){
         $data['bill'] = $this -> book_issue_model -> book_return($id);
         $this -> load -> view('book_issue/bill',$data);
         
     }
 }

?>