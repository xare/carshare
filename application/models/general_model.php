<?php

if(!defined('BASEPATH')) exit ('No direct Script Allowed');

class General_model extends CI_Model {
    
    function send_email($from_email, $from = '', $to ='', $subject, $messages ){
        $this->email->from($from_email,$from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if($this->email->send()){
            return true;
        } else {
            return false;
        }
    }
    
    function get_table($table){
        if ($this->db->field_exists('order', $table)){
             $this->db->order_by('order','asc');
        } 
        $result = $this->db->get($table);
        $data = $result->result_array();
        return $data;
    }
    
    function get_row($id,$table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$id);
        $result = $this->db->get();
        return $data = $result->row_array();
    }
    
    function get_row_field($id,$table,$field){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->$field;
        } else {
            return false;
        }
    }
    
    function get_relationship($table,$id){
        $table_array=explode('_',$table);
        $data = array(
            'id_'.$table_array[1] => $id,
        );
        $this->db->where($data);
        $query = $this->db->get($table);
        
        if($numrows = $query->num_rows>0){
            $result=$query->result_array();
            $i=0;
            foreach($result as $row){
                $data1[$i]['id'] = $row['id_'.$table_array[0]];
                $data1[$i]['name'] = $this->general_model->get_row_field($row['id_'.$table_array[0]],'categories','name');
                $i++;
            }
            return $data1;
        }else{
            return false;            
        }
    }
    
    function add_item($name,$table){
        $data = array(
            'name' => $name
        );
        $this->db->insert($table,$data);
        return $this->db->insert_id();
        $items = $this->get_table($table);
        $i = 0;
        foreach($items as $item){
            $this->set_order($table,$item['id'],$i);
            $i++;
        }
        
    }
    
    function delete_row($id,$table){
        $this->db->delete($table, array('id' => $id)); 
        if ($this->db->field_exists('order', $table)){
            $items = $this->get_table($table);
            $i = 0;
            foreach($items as $item){
                $this->general_model->set_order($table,$item['id'],$i);
                $i++;
            }
        }
    }
    
    function update_item($field,$value, $id,$table){
        $data = array(
            $field=>$value
        );
        $this->db->where('id',$id);
        $this->db->update($table,$data);
    }
    
    function check_exists_item($key,$itemname,$table){
        /* Select 'users' table on database */
        $this->db->select($key);
        $this->db->from($table);
        $this->db->where($key, $itemname);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            /*Username Exists*/
            return TRUE;
        } else {
            /*Username does not exist*/
            return FALSE;
        }
    }
    
    function create_image($upload_data,$type,$width,$height){
        $this->load->helper('directory');
        $config_img['image_library'] = 'gd2';
        $config_img['source_image'] = $upload_data['full_path'];
        $config_img['new_image'] = './uploads/'.$type.'/'.$upload_data['raw_name']."_mini.png";
        $config_img['width'] = $width;
        $config_img['height'] = $height;
        $this->image_lib->initialize($config_img);
        if(!$this->image_lib->resize()){
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }
    
    function serialize($order,$table){
        $order_array = explode('_',$order);
        foreach ($order_array as $key => $value){
            $data = array(
               'order' => $key
            );
            $this->db->where('id', $value);
            $this->db->update($table, $data);
        }
    }
}