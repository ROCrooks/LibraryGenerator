<?php
//---FunctionBreak---
/*Converts numbers on a cycle array to a number based on the maximum values of each element

$cycle is the array of cycle elements
$maxs is the maximum value at each element

Output is a number that the value equals. Error will be returned if there there are a different number of elements in the cycle than in maxs, or if any numbers exceed the maximum for that element*/
//---DocumentationBreak---
function cyclearraytonumber($cycle,$maxs,$singlevalue=1)
	{
	//Count the number of elements to cycle
	$cyclecount = count($cycle);

	//Max array is the same length as cycle array
	//Front padding is defaulted to 1
	$maxfrontpad = array_fill(0,$cyclecount,1);
	$maxs = array_merge($maxfrontpad,$maxs);
	$maxs = array_slice($maxs,0-$cyclecount,$cyclecount);

	//Get the values for each element of the cycle loop
	$values = cyclevalues($maxs,$singlevalue);

	//Loop through elements in the cycle
	$outputnumber = 0;
	$cyclekey = 0;
	while ($cyclekey < $cyclecount)
		{
		//Add element value to output number
		$elementvalue = $cycle[$cyclekey]*$values[$cyclekey];
		$outputnumber = $outputnumber+$elementvalue;

		$cyclekey++;
		}

	Return $outputnumber;
	}
//---FunctionBreak---
/*Converts a number to values in a cycle array based on the maximum values at each

$number is the number to convert into cycle array values
$maxs is the array of maximum numbers

Output is a cycle array with values in each array element*/
//---DocumentationBreak---
function numbertocyclearray($number,$maxs,$singlevalue=1)
	{
	$number = floor($number);

	//Element values
	$elementvalues = cyclevalues($maxs,$singlevalue);

	//Array to store the values
	$output = array();
	foreach ($elementvalues as $value)
		{
		//Number to add to this element and number to migrate to next element
		$fill = $number/$value;
		$fill = floor($fill);
		$number = $number%$value;

		//Add to this column
		array_push($output,$fill);
		}

	Return $output;
	}
//---FunctionBreak---
/*Create an array of what the value of each element in the cycleloop array means

$maxs is an array of the maximum values allowed at each element of the cycle loop

Output is an array that corresponds with what 1 equals in each element of the cycle loop
*/
//---DocumentationBreak---
function cyclevalues($maxs,$singlevalue=1)
	{
	//Reverse array
	$maxs = array_reverse($maxs);

	//Loop through the maxs array
	$addvalue = $singlevalue;
	$cyclevalues = array();
	$cyclearraycount = count($maxs);
	$cyclearraykey = 0;
	while ($cyclearraykey < $cyclearraycount)
		{
		//Add the value to the array
		array_push($cyclevalues,$addvalue);

		//Calculate new value to add based
		$addvalue = ($maxs[$cyclearraykey]*$addvalue)+$addvalue;

		//Cycle onto next value
		$cyclearraykey++;
		}

	$cyclevalues = array_reverse($cyclevalues);

	//Return array of values for each element in the cycle loop
	Return $cyclevalues;
	}
//---FunctionBreak---
/*Calculates the maximum value that can be fitted in the cycle array

$maxs is the array of maximum values

Output is the maximum value allowed*/
//---DocumentationBreak---
function maxcycle($maxs,$singlevalue=1)
	{
	//Get each cycle value and multiple it by cycle maximum
	foreach ($maxs as $cyclevalue)
		{
		$cyclevalue = $cyclevalue+1;

		if (isset($maximumvalue) == true)
			$maximumvalue = $maximumvalue*$cyclevalue;
		else
			$maximumvalue = $cyclevalue;
		}

	$maximumvalue = $maximumvalue-1;
	Return $maximumvalue;
	}
//---FunctionBreak---
?>
