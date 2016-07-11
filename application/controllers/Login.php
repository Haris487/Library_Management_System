<?php
    class Login extends CI_Controller{
        public function __construct()
        {
            parent:: __construct();
            $this -> load -> model('login_model');
            $this -> load -> model('staff_model');
            $this -> load -> model('student_model');
            $this -> load -> helper('url_helper');
            $this -> load -> helper('cookie');
        }

        public function index(){
            $u = $_POST['username'];
            $p = $_POST['password'];
            $type = null;

           $login = $this ->  login_model -> get_user($u);

            if( $login['password'] === $p) {
                if($login['student_id'] != null ){
                    $type = 'student';
                    $student = $this -> student_model -> get_by_id($login['student_id']);
                    setcookie('name',$student['name']);
                }
                else if ($login['staff_id'] != null ){

                    $staff = $this ->  staff_model -> get_by_id($login['staff_id']);
                    $type = $staff['destination'];
                    setcookie('name',$staff['name']);
                }
                else{
                    $data['title'] = 'ERROR IN LOGIN';
                    $this -> load -> view('templates/header',$data);
                    $this -> load -> view('login/error',$data);
                    $this -> load -> view('templates/footer');

                }

            }
            else{
                $data['title'] = 'RETRY LOGIN';
                $this -> load -> view('templates/header',$data);
                $this -> load -> view('login/again',$data);
                $this -> load -> view('templates/footer');
            }
            setcookie('type', $type);
            redirect('Home');


        }

        public function sign_out(){
            delete_cookie('name');
            delete_cookie('type','localhost','/lms/index.php','');


            redirect('Home');
        }
    }
?>
