<?php
    class Login_model extends CI_Model {
        public function __construct()
        {
            $this -> load -> database();
        }

        public function get_user($u){
            $query = $this -> db -> get_where('login', array('username' => $u));
            return $query -> row_array();

        }
        public function get_by($type,$id){
            $query = $this -> db -> get_where('login', array($type.'_id' => $id));
            return $query -> row_array();

        }

        
    }
?>