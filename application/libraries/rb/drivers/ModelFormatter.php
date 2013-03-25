<?php  if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Model formatter
 *
 * @package RB
 * @author Rubén Sarrió <rubensarrio@gmail.com>
 */
class RB_ModelFormatter implements RedBean_IModelFormatter {
	
	public function formatModel($model)
	{		
		return $model;
	}
	
} 

/* End of file ModelFormatter.php */
/* Location: ./application/libraries/RB/drivers/ModelFormatter.php */