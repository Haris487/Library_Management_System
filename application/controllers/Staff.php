<?php
class Staff extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load ->model('staff_model');
        $this ->load->model('login_model');
        $this-> load ->helper('url_helper');
        $this->load->library('encrypt');
    }

    public function index(){


        $staff = array();

        $types = array('admin' , 'hr' , 'librarian');

        foreach($types as $type) {
            array_push(
                $staff,            // staff Index Array Of Associative Array
                array('title' => $type,
                    'staff_record' => $this->staff_model->get_staff_by_class($type)
                )
            );
        }

        // staff[ index ][ title ]   **get Title admin,hr,librarian**
        //staff[ index ][ staff_record ]  **get staff record array**

        $data["staff"] = $staff;




        //$data['books'] = $this->books_model->get_book();
        $data['Staff'] = 'Books';

        $data['values'] = null;

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Staff';

        $this->load->view('templates/header',$data);
        $this->load->view('staff/index',$data);
        $this->load->view('templates/footer');


    }

    public function delete_staff($id){
        $this -> staff_model -> delete_staff($id);
        redirect('Staff');

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
            'hr'

        );
        $data['title'] = 'Create New Staff';
        $fields = array(
            'name',
            'destination',
            'username',
            'password'
        );
        $data['fields'] = $fields;
        $data['action'] = 'staff/create';
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
            $this->staff_model->create($fields);
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
        $data['title'] = 'UPDATE STAFF '.$id;
        $fields = array(
            'name',
            'destination',
            'username',
            'password'
        );
        $data['fields'] = $fields;
        $data['action'] = 'staff/update/'.$id;
        $data['values'] = $this->staff_model->get_by_id($id);

        $user = $this->login_model -> get_by('staff',$id);
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
            $this->staff_model->update($id);
            $this->load->view('news/success');

        }


    }
}
?>


