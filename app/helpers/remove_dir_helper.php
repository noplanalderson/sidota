<?php
/**
 * Remove Directory Helper
 *
 *
 * Used for delete user directory recursively
 * 
 * @access	public
 * 
 * @param 	string 	dir
 *  	
 * @return	void
 *  
*/
defined('BASEPATH') OR exit('No direct script access allowed');

function remove_dir($dir)
{
	if(is_dir($dir))
	{
	    foreach(scandir($dir) as $file) {
	        if ('.' === $file || '..' === $file) continue;
	        if (is_dir("$dir/$file")) remove_dir("$dir/$file");
	        else @unlink("$dir/$file");
	    }
	    @rmdir($dir);
	}
}