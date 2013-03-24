<?php  if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Field class (WIP)
 *
 * @package RB
 * @author Rubén Sarrió <rubensarrio@gmail.com>
 */
class RB_Field {
	
	public $name;
	public $type;
	public $length;
	public $unique;
	public $nullable;
	public $default;
	public $values;
	public $validation;
	public $link;
	
	public function __construct($name, $type = 'string', $config = array())
	{
		$default = array(
			'base' => array(
				'length'		 => NULL,
				'unique'		 => FALSE,
				'nullable' 	 => TRUE,
				'default'	 	 => NULL,
				'values'		 => NULL,
				'validation' => NULL,
				'model'			 => NULL,
				'link'			 => NULL
			),
			'string' => array(
				'length' 		 => 255
			),
			'integer' => array(
				'length' 		 => 4,
				'validation' => array('integer')
			),
			'boolean' => array(),
			'enum' => array(),
			'date' => array(
				'length' 		 => 11
			),
			'link' => array()
		);

		if (is_string($config))
			$config = array('validation' => $config);
		
		elseif (is_integer($config))
			$config = array('length' => $config);
		
		$config = array_merge($default['base'], $default[$type], $config);
		
		$this->name 			= $name;
		$this->type				= $type;
		$this->length			= $config['length'];
		$this->unique			= $config['unique'];
		$this->nullable		= $config['nullable'];
		$this->default		= $config['default'];
		$this->values			= $config['values'];
		$this->validation	= $config['validation'];
		$this->link				= $config['link'];
	}
	
}

/* End of file Field.htm */
/* Location: ./application/libraries/RB/drivers/Field.htm */