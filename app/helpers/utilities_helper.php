<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ticket Status Function
 * 
 * Get Ticket Status
 *
 * @access	public
 * @param 	string 	$approved
 * @param 	string 	$solved
 * @return	string	
 * 
*/
function getStatus($approve, $solved)
{
	return (is_null($approve) && is_null($solved)) ? 'unapprove' :
		((!is_null($approve) && is_null($solved)) ? 'approved' : 'solved');
}

/**
 * Multiple Selected Function
 * 
 *
 * @access	public
 * @param 	string 	$cat
 * @param 	string 	$catList
 * @return	string	
 * 
*/
function multiple_selected($cat, $catList)
{
  $explodeCat = explode(", ", $catList);
  
  return in_array($cat, $explodeCat) ?: "selected";
}