# CodeIgniter 2 + HMVC + RedBean

Setup ready to use CodeIgniter framework with:

-	[CodeIgniter 2.0](http://codeigniter.com)
- [Modular Extensions - HMVC](http://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/overview)
- [RedBean](http//redbeanphp.com)

## How to use?

### Configuration

Set up *application/config/config.php* and *application/config/database.php* for your needs.

Load RedBean library adding it on autoload.php, example:

	$autoload['libraries'] = array('rb');
	
Or load RedBean library in any controller, example:

	$this->load->library('rb');
	
### Using RedBean

You can use RedBean API in your controller:

	$this->rb->debug(TRUE);
	
Or anywhere

	RB::debug(TRUE);
	
Examples:

	// New bean
	$post = $this->rb->dispense('post');
	
	// Load bean by id
	$post = $this->rb->load('post', 1);
	
	// Find all beans
	$posts = $this->rb->find('post');
	
	// Find beans
	$posts = $this->rb->find('post', 'published = 1');
	
	// Save bean
	$this->rb->store($post);
	
## More information

- [CodeIgniter user guide](http://codeigniter.com/user_guide)
- [HMVC Wiki](http://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki)
- [RedBean reference](http://redbeanphp.com)
- [RedBean API](http://www.redbeanphp.com/docs/html/)
- [RedBean forum](http://groups.google.com/group/redbeanorm)