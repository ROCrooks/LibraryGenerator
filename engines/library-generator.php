<?php
$cycleloopmax = maxcycle($library['Maxs']);
$nosequences = $cycleloopmax+1;

//Only generate the sequences if less than maximum
if ($nosequences < $maximumsequences)
  {
  $outputsequences = array();
  //Cycle each number
  $loopvalue = 0;
  while ($loopvalue <= $cycleloopmax)
    {
    //Get cycle values
    $cyclevalues = numbertocyclearray($loopvalue,$library['Maxs']);

    //Convert cyclevalues into residues by reference to options array
    $residueoptions = array();
    foreach($cyclevalues as $position=>$residue)
      {
      $residue = $library['Options'][$position][$residue];
      array_push($residueoptions,$residue);
      }

    $sequence = constructsequence($library['Template'],$residueoptions);
    array_push($outputsequences,$sequence);

    $loopvalue++;
    }

  }
?>
