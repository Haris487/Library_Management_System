<?php
class Student extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load ->model('student_model');
        $this ->load->model('login_model');
        $this-> load ->helper('url_helper');
        $this-> load->helper('cookie');
        $this->load->library('encrypt');
    }

    public function index(){
        if(get_cookie('type') === NULL){
            redirect(base_url().'index.php/Home');
        }
        if(get_cookie('type') != 'admin' && get_cookie('type') != 'student' && get_cookie('type') != 'librarian'){
            redirect(base_url().'index.php/Home');
        }


        $student = $this->student_model->get_student();

        // staff[ index ][ title ]   **get Title admin,hr,librarian**
        //staff[ index ][ staff_record ]  **get staff record array**

        $data["student"] = $student;




        //$data['books'] = $this->books_model->get_book();
        $data['Staff'] = 'Books';

        $data['values'] = null;

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Student';

        $this->load->view('templates/header',$data);
        $this->load->view('student/index',$data);
        $this->load->view('templates/footer');


    }

    public function delete_student($id){
        $this -> student_model -> delete_student($id);
        redirect('Student');

    }
    /*
     *
     * Create to Create New Book
     *
     */

    public function create(){

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
        $data['title'] = 'Create New Student';
        $fields = array(
            'name',
            'username',
            'password'
        );
        $data['fields'] = $fields;
        $data['action'] = 'student/create';
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
            $this->student_model->create();
            $this->load->view('news/success');

        }


    }

    public function update($id){
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
            'hr'

        );
        $data['title'] = 'UPDATE STUDENT '.$id;
        $fields = array(
            'name',
            'username',
            'password'
        );
        $data['fields'] = $fields;
        $data['action'] = 'student/update/'.$id;
        $data['values'] = $this->student_model->get_by_id($id);

        $user = $this->login_model -> get_by('student',$id);
        $data['values']['username'] = $user['username'];
        $data['values']['password'] = '*'.$this -> encrypt -> encode($user['password']);
        foreach($fields as $rule) {
            $this->form_validation->set_rules($rule, $rule, 'required');
        }
        if($this->form_validation->run()=== FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('Form/index.php');
            $this->load->view('templates/footer');


        }
        else{
            $this->student_model->update($id);
            $this->load->view('news/success');

        }


    }
}
?>


