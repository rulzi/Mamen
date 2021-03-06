<?php

class Sms_templates_model extends CI_Model
{
	function get_data($param = array())
	{
		if(!empty($param))
		{
			if(!empty($param['limit']))
			{
				if(!empty($param['offset']))
				{
					$this->db->limit($param['limit'], $param['offset']);
				}
				else
				{
					$this->db->limit($param['limit']);
				}
			}

			if(!empty($param['keyword']))
			{
				$this->db->like('a.nama', $param['keyword']);
			}
		}

		$this->db->order_by('a.aktif');
		$this->db->order_by('a.nama');
		$this->db->from('sms_templates a');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('templates_id', $id);
		$get = $this->db->get('sms_templates');
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('sms_templates', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update($data, $id)
	{
		$this->db->where('templates_id', $id);
		$this->db->update('sms_templates', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete($id)
	{
		$this->db->where('templates_id', $id);
		$this->db->delete('sms_templates');
		return true;
	}
}