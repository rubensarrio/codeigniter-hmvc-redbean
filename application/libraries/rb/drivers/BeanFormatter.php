<?php  if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Bean formatter
 *
 * @package RB
 * @author Rubén Sarrió <rubensarrio@gmail.com>
 */
class RB_BeanFormatter extends RedBean_DefaultBeanFormatter {
	
	private $prefix;
	
	public function __construct($prefix = NULL)
	{
		$this->prefix = $prefix;
	}
	
	public function formatBeanTable($type)
	{
		$ci =& get_instance();
		
		return $ci->rb->table($type);
	}
	
	public function formatBeanID($type)
	{
		return 'id';
	}
	
}

/* End of file BeanFormatter.php */
/* Location: ./application/libraries/RB/drivers/BeanFormatter.php */