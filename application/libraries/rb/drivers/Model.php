<?php  if (! defined('BASEPATH')) exit('No direct script access');

/**
 * RedBean SimpleModel extension (WIP)
 *
 * @package RB
 * @author Rubén Sarrió <rubensarrio@gmail.com>
 */
class RB_Model extends RedBean_SimpleModel {	
	
	public function __construct() {}
	
	public function table()
	{
		$ci =& get_instance();
		
		return $ci->rb->table($this->bean->getMeta('type'));
	}
		
	public function setup()
	{
		$ci =& get_instance();
		
		$ci->load->database();
		
		$fields = array();
		foreach ($ci->db->field_data($this->table()) as $field)
				$fields[$field->name] = $this->field($field);
		
		if (isset($fields['created']) AND isset($fields['updated']))
			$this->timestampable(TRUE);
		
		$this->fields($fields);
	}
	
	public function fields($fields = NULL)
	{
		if (! empty($fields))
			$this->bean->setMeta('fields', $fields);
		
		return $this->bean->getMeta('fields');
	}
	
	public function field($name, $type = 'string', $config = array())
	{
		$fields = $this->fields();
		
		if (! isset($fields[$name])) {
			$fields[$name] = new RB_Field($name, $type, $config);
			
			$this->fields($fields);
		}		
		
		return $fields[$name];
	}
	
	public function timestampable($value = NULL)
	{
		if (! empty($value)) {
			$this->bean->setMeta('timestampable', $value);

			if ($value) {
				$fields = $this->fields();
			
				$fields['created'] = $this->field('created', 'integer');
				$fields['updated'] = $this->field('updated', 'integer');
			
				$this->fields($fields);
			}
		}
		
		$timestampable = $this->bean->getMeta('timestampable');
				
		if (empty($timestampable))
			return isset($this->bean->created) AND isset($this->bean->updated);
		
		return $timestampable;
	}
	
	public function password($value = NULL)
	{
		if (! empty($value)) {
			$this->bean->setMeta('password', $value);

			if ($value) {
				$fields = $this->fields();
			
				$fields['hash'] = $this->field('hash');
				$fields['key']	= $this->field('key');
			
				$this->fields($fields);
			}
		}
		
		$password = $this->bean->getMeta('password');
				
		if (empty($password))
			return isset($this->bean->hash) AND isset($this->bean->key);
		
		return $password;
	}
	
	public function link($model, $field = NULL)
	{	
		if (empty($field))
			$field = $model.'_id';
		
		$fields = $this->fields();
		
		$fields[$field] = $this->field($field, 'link', array('link'	=> $model));
		
		$this->fields($fields);
	}
	
	public function title()
	{
		$fields = $this->bean->export();
		
		return next($fields);
	}
	
	public function save()
	{
		if ($this->timestampable()) {
			$time = time();

			if (empty($this->bean->created))
				$this->created = $time;

			$this->bean->updated = $time;
		}

		R::store($this->bean);
	}
	
	public function hash($password)
	{	
		$ci =& get_instance();
		
		$ci->load->library('password');
		
		$this->bean->hash = $ci->password->hash($password);
		$this->bean->key	= $ci->password->key();
	}
	
}

/* End of file RB_Model.php */
/* Location: ./application/libraries/RB/RB_Model.php */