<?php
if (! function_exists('stringValidator'))
{
	function stringValidator($str)
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		return $str;
	}
}

?>