<?php

/**
 * Extends the template class
 *
 * @author Ralf Stadtaus
 * @copyright Copyright &copy; 2004, Ralf Stadtaus
 * @version 0.2
 */

 
 
 
/**
 * Extends the template class
 * 
 */
class my_template extends template 
{
    var $err_array;
    var $err_var_names;
    var $include_path;
    var $req_array;
    var $req_var_names;
    var $syn_array;
    var $syn_var_names;
    
    
    
    
    /**
	 * Set path where include path starts
	 *
     * @access public
     * @param String path Absolute server path starting from server root
     * @return Void
	 */
    function set_include_path($path) 
	{
		$this->include_path = $path;
	}
    
    
    
    
    /**
     * Register error variables
     *
     */
	function required_register($file_id, $var_name)
    {
		if(is_array($var_name)) {
			$this->req_array($file_id, $var_name);
		} elseif ($var_name != ''){
			if (is_long(strpos($var_name, ',')) == TRUE){
				$var_name = explode(',', $var_name);
				for(reset($var_name); $current = current($var_name); next($var_name)) $this->req_var_names[$file_id][] = trim($current);
			} else {
				$this->req_var_names[$file_id][] = $var_name;
			}
		}
	}
    
    
    
    
    /**
     * Register alternative variables
     *
     */
	function error_register($file_id, $var_name)
    {
		if(is_array($var_name)){
			$this->err_array($file_id, $var_name);
		} elseif ($var_name != '') {
			if(is_long(strpos($var_name, ',')) == TRUE){
				$var_name = explode(',', $var_name);
				for(reset($var_name); $current = current($var_name); next($var_name)) $this->err_var_names[$file_id][] = trim($current);
			}else{
				$this->err_var_names[$file_id][] = $var_name;
			}
		}
	}
    
    
    
    
    /**
     * Register syntax variables
     *
     */
	function syntax_register($file_id, $var_name)
    {
		if(is_array($var_name)){
			$this->syn_array($file_id, $var_name);
		} elseif ($var_name != ''){
			if(is_long(strpos($var_name, ',')) == TRUE){
				$var_name = explode(',', $var_name);
				for(reset($var_name); $current = current($var_name); next($var_name)) $this->syn_var_names[$file_id][] = trim($current);
			}else{
				$this->syn_var_names[$file_id][] = $var_name;
			}
		}
	}
    
    
    
    
    /**
     * Register error variables
     *
     */
	function required_parse($file_id)
    {
		$file_ids = explode(',', $file_id);
		for(reset($file_ids); $file_id = trim(current($file_ids)); next($file_ids))
        {
			if(isset($this->req_var_names[$file_id]) AND count($this->req_var_names[$file_id]) > 0){
				for($i=0; $i<count($this->req_var_names[$file_id]); $i++)
                {
					$temp_var = $this->req_var_names[$file_id][$i];
				    $this->files[$file_id] = preg_replace('#' . $this->start . 'required:' . $temp_var . '=(.*)' . $this->end . '#', '$1', $this->files[$file_id]);
				}
			}
		}
	}
    
    
    
    
    /**
     * Register alternative variables
     *
     */
	function error_parse($file_id)
    {
		$file_ids = explode(',', $file_id);
		for(reset($file_ids); $file_id = trim(current($file_ids)); next($file_ids))
        {
			if(isset($this->err_var_names[$file_id]) AND count($this->err_var_names[$file_id]) > 0) {
				for($i=0; $i<count($this->err_var_names[$file_id]); $i++)
                {
					$temp_var = $this->err_var_names[$file_id][$i];
				    $this->files[$file_id] = preg_replace('#' . $this->start . 'error:' . $temp_var . '=(.*)\|\|=(.*)' . $this->end . '#', '$2', $this->files[$file_id]);
				}
			}
		}
	}
    
    
    
    
    /**
     * Register alternative variables
     *
     */
	function syntax_parse($file_id)
    {
		$file_ids = explode(',', $file_id);
		for(reset($file_ids); $file_id = trim(current($file_ids)); next($file_ids))
        {
			if(isset($this->syn_var_names[$file_id]) AND count($this->syn_var_names[$file_id]) > 0) {
				for($i=0; $i<count($this->syn_var_names[$file_id]); $i++)
                {
					$temp_var = $this->syn_var_names[$file_id][$i];
				    $this->files[$file_id] = preg_replace('#' . $this->start . 'syntax:' . $temp_var . '=(.*)' . $this->end . '#', '$1', $this->files[$file_id]);
				}
			}
		}
	}
    
    
    
    
    /**
     * Clean up unreplaced markers
     *
     */
	function clean_up($file_id) 
    {
		$file_ids = explode(',', $file_id);
		for(reset($file_ids); $file_id = trim(current($file_ids)); next($file_ids))
        {
		    $this->files[$file_id] = preg_replace('#' . $this->start . 'syntax:(.*)=(.*)' . $this->end . '#', '', $this->files[$file_id]);
		    $this->files[$file_id] = preg_replace('#' . $this->start . 'required:(.*)=(.*)' . $this->end . '#', '', $this->files[$file_id]);
	        $this->files[$file_id] = preg_replace('#' . $this->start . 'error:(.*)=(.*)\|\|=(.*)' . $this->end . '#', '$2', $this->files[$file_id]);
		}
    }
    
    
    
    /**
	 * Include filese - PHP code is parsed and executed
	 *
	 */
    function include_file($file_id, $filename)
    {
        if ($filename{0} == '/') {
            $new_filename = $this->include_path . '/' . $filename;
            $new_filename = str_replace('//', '/', str_replace('//', '/', $new_filename));
        } else {
            $new_filename = $filename;
        }
        
        if (is_file($new_filename)) {
          ob_start();
          include $new_filename;
          $content = ob_get_contents();
          ob_end_clean();                  
        } else {
            $content = '[ERROR: "' . $new_filename . '" does not exist.]';
        }
        
        if (isset($content)) {
            $tag = substr($this->files[$file_id], strpos(strtolower($this->files[$file_id]), '<include filename="'.$filename.'">'), strlen('<include filename="'.$filename.'">'));
            $this->files[$file_id] = str_replace($tag, $content, $this->files[$file_id]);
        }            
    }
		
		
		
		
}



?>