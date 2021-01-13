<?php

class ProductsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function saveData($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }


    public function getData($table,$condition,$order='asc')
    {
        $this->db->order_by('id',$order);
        $query = $this->db->get_where($table,$condition);

        return $query->result_array();
    }


    public function getAllData($table,$order='asc')
    {
        $this->db->order_by('id',$order);
        $query = $this->db->get($table);

        return $query->result_array();
    }


    public function getField($field,$table,$id)
    {
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where('id',$id);

        return $this->db->get()->row($field);
    }


    public function exists($table,$data)
    {
        $query = $this->db->get_where($table,$data);
        $num_rows = ($query->num_rows());

        if($num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

}

?>