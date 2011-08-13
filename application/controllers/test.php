<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->library('rb');

		$this->rb->debug(TRUE);
		
		$post = $this->rb->dispense('post');
		
		$post->title = 'Lorem ipsum dolor sit amet';
		$post->content = 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		
		$this->rb->store($post);
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */