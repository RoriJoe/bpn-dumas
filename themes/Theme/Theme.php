<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Theme Class
 *
 * This class is for create theme / template simply 
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		 Ribhararnus Pracutiar a.ka Raitucarp
 * @link		http://raitzine.com/
 */

class Theme {
    
    var $title;
    var $meta;
    var $display_js;
    var $display_css;
  // --------------------------------------------------------------------

	/**
	 * Set a default media type on css
	 *
	 */
    var $media_type = array(
        'all', 'braille', 'embossed', 
        'handheld', 'print', 'projection', 
        'screen', 'speech', 'tty', 'tv'
    );
    var $CI;
   /**
	 * Theme constructor
	 *
	 */
    function Theme()
    {
        $this->CI         =& get_instance();
        $this->CI->load->helper('string');
    }
	/**
	 * .
	 *
	 * Set config is for set config array
	 *
	 * @access	private
	 * @param	array	 list array of page
	 * @return	array
	 */
    function _set_config($config_array)
    {    
        $config['header']         = (!isset($config_array['header'])) ? 'header' : $config_array['header'];
        $config['sidebar_left']   = (!isset($config_array['sidebar_left'])) ? 'sidebar_left' 
                                    : $config_array['sidebar_left'];
        $config['main']      = (!isset($config_array['main'])) ? 'index' : $config_array['main'];
        $config['sidebar']   = (!isset($config_array['sidebar'])) ? 'sidebar' : $config_array['sidebar'];
        $config['footer']    = (!isset($config_array['footer'])) ? 'footer' : $config_array['footer'];
        
        return $config;
    }  
	/**
	 * .
	 *
	 * Load theme
	 *
	 * @access	public
	 * @param	string	 the directory of theme name
	 * @param	array	   data to passed in theme
	 * @return	mixed
	 */ 
    public function load($theme_name, $variable = '', $config = '')
    {
        $conf                 = $this->_set_config($config);
        $data                 = ($variable == '') ? '' : $variable;
        $data['title']        = (!isset($this->title) == true) ? '' : $this->title;        
        $data['meta']         = (!isset($this->meta) == true) ? '' : $this->meta;        
        $data['javascript']   = $this->display_js;
        $data['stylesheet']   = $this->display_css;
        
                
        foreach($conf as $key=>$item)
        {
            $this->CI->load->view($theme_name.'/'.$item, $data);
        }
    }
	/**
	 * .
	 *
	 * Set Title of Page
	 *
	 * @access	public
	 * @param	string	 content
	 * @return	mixed
	 */ 
 
    
    public function title($string)
    {
        $this->title = $string;
    }
    
	/**
	 * .
	 *
	 * Set Meta of page 
	 *
	 * @access	public
	 * @param	mixed	 Meta name
	 * @param	mixed	 content
	 * @return	mixed
	 */ 

    public function meta($name, $content = '')
    {
        $this->CI->load->helper('html');
        if(is_array($name)){
            
            foreach($name as $key=>$value)
            {
                $this->meta .= meta($key, $value)."\n";
            }
            
        }else{
            $this->meta .= meta($name, $content)."\n";
        }
    }
	/**
	 * .
	 *
	 * Set javascript 
	 *
	 * @access	public
	 * @return	mixed
	 */ 
    public function js()
    {
        $src       = '';
        $count     = func_num_args();
        $folder    = func_get_arg(0);
        $folder    = (!preg_match('/\.js$/', $folder)) ? $folder.'/' : 'assets/js/';
        $folder    = (!preg_match('/^http/', $folder)) ? base_url().$folder : $folder;
        
        foreach(func_get_args() as $js)
        {
              if(preg_match('/\.js$/', $js))
              {
                $source = (preg_match('/^http/', $js) == 1) ? $js : 
                          reduce_double_slashes($folder.$js);
                $this->display_js   .= '<script type="text/javascript" src="'.$source.'"></script>'."\n"; 
              }
        }
    }
	/**
	 * .
	 *
	 * Set CSS 
	 *
	 * @access	public
	 * @return	mixed
	 */ 
    public function css()
    {
        $src       = '';
        $count     = func_num_args();
        $media_type= (in_array(func_get_arg(0), $this->media_type)) ? func_get_arg(0) : 'all';
        
        $folder    = (in_array(func_get_arg(0), $this->media_type)) ? func_get_arg(1) : func_get_arg(0);
        $folder    = (!preg_match('/\.css/', $folder)) ? $folder.'/' : 'assets/css/';
        $folder    = (!preg_match('/^http/', $folder)) ? base_url().$folder : $folder;
        
        foreach(func_get_args() as $css)
        {
              if(preg_match('/\.css/', $css))
              {
                $source               = (preg_match('/^http/', $css) == 1) ? $css : 
                                        reduce_double_slashes($folder.$css);
                $link = array(
                          'href' => $source,
                          'rel' => 'stylesheet',
                          'type' => 'text/css',
                          'media' => $media_type
                );
                $this->display_css   .= link_tag($link, $link)."\n";
              }        
        }
        // <link href="http://site.com/css/printer.css" rel="stylesheet" type="text/css" media="print" />
    }
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */