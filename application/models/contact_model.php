<?php
class Contact_model extends CI_model{

    public function add_user($user, $fields){
        
        $newInfo = array();
        $existingfields = $this->db->list_fields('contacts');
        foreach($existingfields as $field){
            if(!in_array($field, $fields)){
                $pos = array_search($field, $existingfields, true);
                $val =  $existingfields[$pos] = "";
                $newInfo = array_push($user, $val);
            }
        }

        $this->db->select("*");
        $this->db->from("contacts");
        $this->db->where("email_address",$user[1]);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        { 
            $this->db->update('contacts', $user);
        }else{
            $this->db->insert('contacts', $user);
        }
    }

    public function modify_table($newFields){

        foreach($newFields as $field){

            $existingfields = $this->db->list_fields('contacts');
            if(in_array($field, $existingfields)){
                continue;
            }
            
            $fields = array(
                $field => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => FALSE)
            );

            $this->dbforge->add_column('contacts', $fields);
        }
    }

    public function get_data(){

        return $this->db->query('SELECT * from contacts');

    }

    public function get_table_columns(){

        return $existingfields = $this->db->list_fields('contacts');
    }

}


?>
