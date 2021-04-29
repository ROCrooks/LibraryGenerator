<?php
//---FunctionBreak---
/*Makes a library member from the template and the selected residues

$template is the template sequence with randomised positions as ?
$choices is the residues to put into the sequence. Will be cut or filled with random residues to equal the number of residues

Output is a string with the sequence*/
//---DocumentationBreak---
function constructsequence($template,$choices="")
	{
	//Standardise to array if plain text
	if (is_array($choices) == false)
		$choices = str_split($choices);

	//Find the number of randomised positions
	$places = substr_count($template,"?");

	//Trim choices if too long
	if ($places < count($choices))
		{
		$choices = array_slice($choices,0,$places);
		}
	//If too short pad with random residues
	elseif ($places > count($choices))
		{
		//Pad until the choices are the right length
		$residues = "ACDEFGHIKLMNPQRSTVWY";
		while ($places > count($choices))
			{
			//Shuffle the residue list and pick one
			shuffle($residues);
			$residue = $resiudes[0];

			//Add residue to $choices
			array_push($choices,$residue);
			}
		}

	//Construct the sequence
	$positionscount = count($choices);
	$positionkey = 0;
	$sequence = "";
	//Explode template into fragments
	$template = explode("?",$template);

	//Add the options to each segment
	while ($positionkey < $positionscount)
		{
		$sequence = $sequence . $template[$positionkey] . $choices[$positionkey];
		$positionkey++;
		}
	//Add last fragment
	$sequence = $sequence . $template[$positionkey];

	Return $sequence;
	}
//---FunctionBreak---
?>
