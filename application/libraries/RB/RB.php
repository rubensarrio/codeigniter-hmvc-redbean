<?php  if (! defined('BASEPATH')) exit('No direct script access');

require_once(APPPATH.'third_party/RedBean/redbean.inc.php');

require_once(APPPATH.'libraries/RB/drivers/BeanFormatter.php');
require_once(APPPATH.'libraries/RB/drivers/ModelFormatter.php');
require_once(APPPATH.'libraries/RB/drivers/Field.php');
require_once(APPPATH.'libraries/RB/drivers/Model.php');

/**
 * RedBean library for CodeIgniter
 *
 * @package RB
 * @author Rubén Sarrió <rubensarrio@gmail.com>
 */
class RB extends R	{
	
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	private $db_prefix;
	
	/**
	 * Load & config RedBean
	 *
	 * @author Rubén Sarrió <rubensarrio@gmail.com>
	 */
	public function __construct()
	{
		// Include database configuration
		include(APPPATH.'config/database.php');
		
		// Database config
		$this->db_host	 = $db[$active_group]['hostname'];
		$this->db_user	 = $db[$active_group]['username'];
		$this->db_pass	 = $db[$active_group]['password'];
		$this->db_name	 = $db[$active_group]['database'];
		$this->db_prefix = $db[$active_group]['dbprefix'];

		// Setup RedBean
		self::setup('mysql:host='.$this->db_host.';dbname='.$this->db_name, 
			$this->db_user, $this->db_pass);
		
		// Bean Formatter
		self::$writer->setBeanFormatter(new RB_BeanFormatter());
		
		// Model Formatter
		RedBean_ModelHelper::setModelFormatter(new RB_ModelFormatter);
	}
	
	/**
	 * Returns table name
	 *
	 * @param string $type 
	 * @return string
	 * @author Rubén Sarrió <rubensarrio@gmail.com>
	 */
	public function table($type)
	{
		$ci =& get_instance();
		$ci->load->helper('inflector');
		
		return $this->db_prefix.plural($type);
	}
	
	/**
	 * Load model
	 *
	 * @param string $model 
	 * @return void
	 * @author Rubén Sarrió <rubensarrio@gmail.com>
	 */
	public function model($model)
	{
		$ci =& get_instance();
		
		$module = $ci->router->fetch_module();
		
		if (strpos($model, $module.'_') === FALSE) {
			$m = explode('_', $model);
			$model = $m[0].'/'.$m[0].'_'.$m[1];
		}
		
		$ci->load->model($model);
	}
	
	/**
	 * Pagination helper
	 *
	 * @param string $model 
	 * @param string $config 
	 * @return array
	 * @author Rubén Sarrió <rubensarrio@gmail.com>
	 */
	public function pagination($model, $config = array())
	{
		$ci =& get_instance();
		$ci->load->helper('url');
		
		$default = array(
			'beans' => 'beans',
			'sql' => '',
			'offset' => 0,
			'base_url' => site_url(),
			'per_page' => 20,
			'num_links' => 9,
			'uri_segment' => 3,
			'first_link' => '&laquo;',
			'last_link' => '&raquo;',
			'next_link' => 'Siguientes &rsaquo;',
			'prev_link' => '&lsaquo; Anteriores'
		);
		$config = array_merge($default, $config);
		
		if (isset($config['sql']))
			$beans = $this->find($model, '');
		else
			$beans = $this->find($model, $config['sql']);
		
		$config['total_rows'] = count($beans);
		
		$pagination = '';
		if ($config['total_rows'] > $config['per_page']) {
			if (isset($config['sql']))
				$beans = $this->find($model,
					' 1 LIMIT '.$config['offset'].','.$config['per_page']);
			else
				$beans = $this->find($model, $config['sql']
					.' LIMIT '.$config['offset'].','.$config['per_page']);
			
			$ci->load->library('pagination');
			$ci->pagination->initialize($config);
			$pagination = $ci->pagination->create_links();
		}
		
		return array(
			$config['beans'] => $beans,
			'total'			 		 => $config['total_rows'],
			'pagination'		 => $pagination
		);
	}

}

/* End of file RB.php */
/* Location: ./application/libraries/RB/RB.php */