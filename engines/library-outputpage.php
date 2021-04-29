<?php
//This generates the HTML for the number for the page output
$outputhtml =
'<div class="item"><p class="blockheading">Library Summary</p><p>This library has a total of ' . $nosequences . ' sequences</p>';

if ($nosequences < $maximumsequences)
  {
  $outputhtml = $outputhtml . '<p class="blockheading">Sequences</p><p>Sequences in this library:<br><textarea cols="60" rows="20">';

	$outputhtml = $outputhtml . implode('&#13;&#10;',$outputsequences);

	$outputhtml = $outputhtml . '</textarea></p></div>';
  }

/*$outputhtml = $outputhtml . '<div class="item"><p class="blockheading">Downstream Processing</p><form action="create-library-bulk.php" method="post"><p>You can import this library onto the server for further analysis, such as bCIPA or Mass Calculation by clicking the button below:</p><input type="hidden" name="Sequence" value="';

$outputhtml = $outputhtml . $library['Template'];
$outputhtml = $outputhtml . '"><input type="hidden" name="Randoms" value="';

//Implode options into HTML form
foreach ($options as $optionskey=>$positionoptions)
	{
	$options[$optionskey] = implode("",$positionoptions);
	}
$htmlformoptions = implode('\n',$options);

$outputhtml = $outputhtml . $htmlformoptions;

$outputhtml = $outputhtml . '"><p><input type="submit" name="submit" value="GO!"></p></form></div>';
$outputhtml = $outputhtml . '<div class="item"><p class="blockheading">Cloning This Library</p>
<p>Find out how many plates you need to clone this library at your typical transformation efficiency</P>
<form action="manyplates.php" METHOD="POST">
<input type="hidden" name="Library" value="';
$outputhtml = $outputhtml . $nosequences;
$outputhtml = $outputhtml . '">
<table>
<tr>
<td>Colonies on 1 Plate:</TD>
<td><input type="text" name="Clones" size="8"></td>
</tr>
<tr>
<td>Fraction Missing Wanted:</TD>
<td><input type="text" name="Missing" size="8" value="0.05"></td>
</tr>
</table>
<p><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Reset" value="Reset"></p>
</form></div>';*/

echo $outputhtml;
?>
