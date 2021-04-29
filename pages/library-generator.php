<?php
$maximumsequences = 500000;

//Get the engines directory
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Include required functions for everything
include $enginesdirectory . 'library-required-files.php';

if (isset($_POST['Submit']) == true)
	{
	//Process the input of the HTML form
	include $enginesdirectory . 'library-process-input.php';

	//Generate the library sequences
	include $enginesdirectory . 'library-generator.php';

	//Display the engine output
	include $enginesdirectory . 'library-outputpage.php';
	}

include $enginesdirectory . 'library-inputpage.php';
echo $inputformhtml;
?>
