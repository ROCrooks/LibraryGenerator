<?php
//---FunctionBreak---
/*Only allows legal characters in a string and returns a string that removes illegal characters.

$input is the input string
$legals is the list of allowed characters

Output is the input minus any characters not included in the legals string*/
//---DocumentationBreak---
function legalcharactersonly($input,$legals)
	{
	//Split legals into array if it is not an array
	if (is_array($legals) == false)
		$legals = str_split($legals);

	//If originally an array
	$originarray = false;

	//Convert string to array if not already
	if (is_array($input) == false)
		{
		$output = "";
		$input = str_split($input);
		$originarray = true;
		}
	else
		$output = array();

	//Loop through each character
	foreach($input as $inputkey=>$character)
		{
		//Unset character if it is not found in the legals array
		if (in_array($character,$legals) == false)
			{
			unset($input[$inputkey]);
			}
		}

	//Convert back to string and return
	$input = implode("",$input);
	Return $input;
	}
//---FunctionBreak---
?>
