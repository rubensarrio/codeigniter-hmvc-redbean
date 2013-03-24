# CodeIgniter 2.1 + HMVC + RedBean 3

Setup ready to use CodeIgniter framework with:

- [CodeIgniter 2.1.3](http://codeigniter.com)
- [Modular Extensions - HMVC](http://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/overview)
- [RedBean 3.3.7](http//redbeanphp.com)

## How to use?

### Configuration

Set up *application/config/config.php* and *application/config/database.php* for your needs.

Load RedBean library adding it on autoload.php, example:

	$autoload['libraries'] = array('rb');
	
Or load RedBean library in any controller, example:

	$this->load->library('rb');
	
### Using RedBean

You can use RedBean API in your controller:

	R::debug(TRUE);
	
	
Examples:

	// New bean
	$post = R::dispense('post');
	
	// Load bean by id
	$post = R::load('post', 1);
	
	// Find all beans
	$posts = R::find('post');
	
	// Find beans
	$posts = R::find('post', 'published = 1');
	
	// Save bean
	R::store($post);
	
### Using HMVC

With HMVC you can build your application modulair. 

You can find the standard welcome page in:

	/application/modules/welcome/controllers/welcome.php

## More information

- [CodeIgniter user guide](http://codeigniter.com/user_guide)
- [HMVC detail page](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/overview)
- [RedBean manual](http://www.redbeanphp.com/)
- [RedBean forum](http://groups.google.com/group/redbeanorm)
