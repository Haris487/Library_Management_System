<?php
class Staff_model extends CI_Model {
    public function __construct()
    {
        $this -> load -> database();
        $this -> load -> library('encrypt');
    }

    public function get_by_id($id){
        $query = $this -> db -> get_where('staff', array('id' => $id));
        return $query -> row_array();

    }

    public function get_staff_by_class($class = FALSE){
        if ($class === FALSE){
            $query =  $this->db->get('staff');
            return $query->result_array();

        }

        $query = $this->db->get_where('staff',array('destination' => $class));
        return $query->result_array();

    }




    public function delete_staff($id){
        $this->db->delete('staff', array('id' => $id));
    }



    public function create($fields){
        $this -> load -> helper('url');
        $data = array();
        $data['name'] = $this->input->post('name');
        $data['destination'] = $this->input->post('destination');

        $this->db->insert('staff',$data);
        $id = $this->db->insert_id();


        $login_data = array();

        $login_data['staff_id'] = $id;
        $login_data['username'] = $this->input->post('username');
        $login_data['password'] = $this->input->post('password');

        $this->db->insert('login',$login_data);


    }

    public function update($id){
        $this -> load -> helper('url');

        $data = array();
        $data['name'] = $this->input->post('name');
        $data['destination'] = $this->input->post('destination');


        $login_data = array();

        $login_data['staff_id'] = $id;
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
            $this->db->update('staff');


            $this->db->set($login_data);
            $this->db->where('staff_id', $id);
            $this->db->update('login');
        }
        else {
            echo '<p class = "danger">Dont Use * As First Char Of Password
                    go back And Do again</p>';
        }
    }


}
?>