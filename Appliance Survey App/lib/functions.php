<?php
    function getBackgroundColor($resultText, $searchText)
    {
		if(!empty($searchText))
		{
			$regex =  "/$searchText/i";

			if(preg_match($regex, $resultText))
			{
				return 'background-color:yellow;';
			}
			else
			{
				return 'background-color:white;';
			}
		}
	} 

	function debug_to_console($data) 
	{
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);
		
		if(is_bool($data))
		{
			if($data==true)
			{
				$output = "true";
			}
			else
			{
				$output = "false";
			}
		}
			
		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}
?>