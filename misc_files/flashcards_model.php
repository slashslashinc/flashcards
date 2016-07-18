<?php
defined( 'BASEPATH' ) or die( 'No direct script access allowed' );


class Flashcards_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    private $_tablename = 'flashcards';
    
    public function getTablename()
    {
        return $this->_tablename;
    }

    
    public function add($data)
    {
        $this->db->set('date_created','now()',false);
        $insert = $this->db->insert($this->getTablename(),$data);
        if ($insert) {
            $info = $this->get($this->db->insert_id());
        } else {
            $info = false;
        }
        return $info;
    }
    
    public function edit($id,$data)
    {
        $this->db->set('date_last_modified','now()',false);
        $this->db->where('id',$id);
        $update = $this->db->update($this->getTablename(),$data);
        if ($update) {
            $info = $this->get($id);
        } else {
            $info = false;
        }
        return $info;
    }
    
    public function delete($id)
    {
        $data['status'] = 'deleted';
        $deleted = $this->edit($id, $data);
        if ($deleted) {
            $info = $this->get($id);
        } else {
            $info = false;
        }
        return $info;
    }
    
    public function get($id = 0)
    {
        if ($id == 0) {
            $r = $this->getFields();
            foreach ($r as $f) {
                $result->{$f->Field} = '';
            }
        } else {
            $this->db->where('id',$id);
            $query = $this->db->get($this->getTablename());
            $result = $query->row();
        }
        return $result;
    }
    
    
    public function getAll()
    {
        $query = $this->db->get($this->getTablename());
        $result = $query->result();
        return $result;
    }
    
    public function getAllByStatus($status='active')
    {
        $this->db->where('status',$status);
        $this->db->order_by('title');
        $query = $this->db->get($this->getTablename());
        $result = $query->result();
        return $result;
    }
    
    public function getAllNotDeleted()
    {
        $this->db->where('status !=','deleted');
        $this->db->order_by('title');
        $query = $this->db->get($this->getTablename());
        $result = $query->result();
        return $result;
    }
    
   
    
    public function getFields()
    {
        $query = $this->db->query('show columns from ' . $this->getTablename());
        $result = $query->result();
        return $result;
    }    
    
}