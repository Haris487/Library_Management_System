<?php
class Books extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load ->model('books_model');
        $this-> load ->helper('url_helper');
        $this->load->library("pagination");
    }

    public function index($class = 'All-Books',$p = null){
        $config = array();

        // Open tag for CURRENT link.
        $config['cur_tag_open'] = '<li class = "active" ><a>';

// Close tag for CURRENT link.
        $config['cur_tag_close'] = '</a></li>';

// By clicking on performing NEXT pagination.
        $config['next_link'] = 'Next';

// By clicking on performing PREVIOUS pagination.
        $config['prev_link'] = 'Previous';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';

        $config["base_url"] = ''.base_url().'index.php/'."Books/index/".$class;
        $config["total_rows"] = $this->books_model->book_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = 0;
        if($p === NULL){
            $page = 0 ;
        }
        else{
            $page = $p;
        }



        $data["books"] = $this->books_model->fetch_array($config["per_page"], $page , $class);
        $data["links"] = $this->pagination->create_links();

        $data['page'] = $page;


        //$data['books'] = $this->books_model->get_book();
        $data['title'] = 'Books';
        $data['title_inner'] = $class;

        $data['values'] = null;

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('templates/header',$data);
        $this->load->view('books/nav_bar',$data);
        $this->load->view('books/index',$data);
        $this->load->view('templates/footer');


    }

    public function delete_books($id){
        $this -> books_model -> delete_books($id);
        redirect('Books');

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
        $data['title'] = 'Create New Book';
        $fields = array(
            'name',
            'class',
            'author',
            'description',
            'price',
            'rent',
            'amount'
        );
        $data['fields'] = $fields;
        $data['action'] = 'books/create';
        $data['values'] = null;
        foreach($fields as $rule) {
            $this->form_validation->set_rules($rule, $rule, 'required');
        }
       /* $this->form_validation->set_rules('class','Class','required');
        $this->form_validation->set_rules('author','Author','required');
        $this->form_validation->set_rules('description','Description','required');
        $this->form_validation->set_rules('price','Price','required');
        $this->form_validation->set_rules('rent','Rent','required');
        $this->form_validation->set_rules('amount','Amount','required');*/


        if($this->form_validation->run()=== FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('Form/index.php');
            $this->load->view('templates/footer');


        }
        else{
            $this->books_model->create();
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
            'librarian'

        );
        $data['title'] = 'UPDATE BOOK '.$id;
        $fields = array(
            'name',
            'class',
            'author',
            'description',
            'price',
            'rent',
            'amount'
        );
        $data['fields'] = $fields;
        $data['action'] = 'books/update/'.$id;
        $data['values'] = $this->books_model->get_book_where($id);
        foreach($fields as $rule) {
            $this->form_validation->set_rules($rule, $rule, 'required');
        }
        if($this->form_validation->run()=== FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('Form/index.php');
            $this->load->view('templates/footer');


        }
        else{
            $this->books_model->update($id);
            $this->load->view('news/success');

        }


    }
}
?>


