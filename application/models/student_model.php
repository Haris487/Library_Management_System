<?php
class Student_model extends CI_Model {
    public function __construct()
    {
        $this -> load -> database();
        $this -> load -> library('encrypt');
    }

    public function get_by_id($id){
        $query = $this -> db -> get_where('student', array('id' => $id));
        return $query -> row_array();

    }

    public function get_student($username = FALSE){
        if ($username === FALSE){
            $query =  $this->db->get('student');
            return $query->result_array();

        }

        $query = $this->db->get_where('login',array('username' => $username));
        $login = $query->row_array();
        $query = $this->db->get_where('student',array('id' => $login['student_id']));
        return $query -> row_array();

    }

    public function delete_student($id){
        $this->db->delete('student', array('id' => $id));
    }

    public function create(){
        $this -> load -> helper('url');
        $data = array();
        $data['name'] = $this->input->post('name');

        $this->db->insert('student',$data);
        $id = $this->db->insert_id();


        $login_data = array();

        $login_data['student_id'] = $id;
        $login_data['username'] = $this->input->post('username');
        $login_data['password'] = $this->input->post('password');

        $this->db->insert('login',$login_data);


    }

    public function update($id){
        $this -> load -> helper('url');

        $data = array();
        $data['name'] = $this->input->post('name');


        $login_data = array();

        $login_data['student_id'] = $id;
        $login_data['username'] = $this->input->post('username');

        /*
         *
         * The Following code determines Whether the Password is in Encoded Form Or not
         *
         * By checking its first char
         *
         * If first char is '*' staric means it is Encoded  and need to be decode
         *
         * If Not Means it is Plain Password
         *
         *
         */
        $password = $this->input->post('password');
        $fc = substr($password,0,1);
        $encoded_password = substr($password,1);
        if($fc === '*'){
            $password = $this -> encrypt -> decode($encoded_password);
        }


        $login_data['password'] = $password;


        ////////////////////////////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($password != '0') {

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('student');


            $this->db->set($login_data);
            $this->db->where('student_id', $id);
            $this->db->update('login');
        }
        else {
            echo '<p class = "danger">Dont Use * As First Char Of Password
                    go back And Do again</p>';
        }
    }



}
?>