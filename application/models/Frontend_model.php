<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Frontend_model extends CI_Model
{
    function get_custom_query($query = '')
    {
        $query = $this->db->query($query);
        
        $result = $query->result();        
		
		$result = $this->action_html_entity_decode($result);
		
        return $result;
    }
	
    function get_records($table = '', $where = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        
        $result = $query->result();  

		$result = $this->action_html_entity_decode($result);
		
        return $result;
    }
	
    function get_record($table = '', $where = '', $column_name = '')
    {
        $this->db->select($column_name . " as column_name");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        
        $result = $query->result();    
		$result = $this->action_html_entity_decode($result);		
        return $result[0]->column_name;
    }
	
    function insert($table = '', $info = '')
    {
		foreach($info as $key => $value)
		{
			$data[$key] = htmlentities($value);
		}
        $this->db->trans_start();
        $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
        $this->db->trans_complete();
		
        return $insert_id;
    }
	
    function update($table = '', $info = '', $where = '')
    {
		foreach($info as $key => $value)
		{
			$data[$key] = htmlentities($value);
		}
        $this->db->where($where);
        $this->db->update($table, $data);
        
        return TRUE;
    }
	
    function delete_data($table = '', $where = '')
    {
        $this->db->where($where);
        $this->db->delete($table);
        
        return TRUE;
    }
	
    function delete_all($table = '')
    {
        $this->db->where('status = 0');
        $this->db->delete($table);
        
        return TRUE;
    }
	
	function action_html_entity_decode($result)
	{
		$count1 = sizeof($result);
		for($i = 0; $i < $count1; $i++)
		{
			foreach($result[$i] as $key => $val)
			{
				$result[$i]->$key = html_entity_decode($val);
			}
		}
		return $result;
	}
}