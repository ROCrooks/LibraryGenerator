<?php
//Get input from form
$input = $_POST['Input'];
$sequence = $sequence = strtoupper($_POST['Sequence']);
$randoms = $_POST['Randoms'];

if ($input == "DNA")
  {
  //Make input sequence legal
  $legals = "NBDHVWSMKRYACGT";
  $sequence = legalcharactersonly($sequence,$legals);

  //Split into codons
  $sequence = str_split($sequence,3);

  $singles = "ACGT";

  //Library data containers
  $template = "";
  $options = array();
  $maxs = array();

  foreach($sequence as $codon)
    {
    //Read each codon
    if (strlen($codon) == 3)
      {
      //Translate degenerate codons
      $codons = degeneratecodontocodons($codon);

      //Options at position
      $positionoptions = array();

      //Translate each codon option
      foreach ($codons as $individualcodon)
        {
        $aminoacid = translatecodon($individualcodon);

        //Add amino acid to options if not already present
        if (in_array($aminoacid,$positionoptions) === false)
          array_push($positionoptions,$aminoacid);
        }

      if (count($positionoptions) > 1)
        {
        //Add residue options if specified
        $max = count($positionoptions)-1;
        array_push($maxs,$max);
        array_push($options,$positionoptions);
        $template = $template . "?";
        }
      else
        //Add single residue
        $template = $template . $positionoptions[0];
      }
    }
  }
if ($input == "Protein")
  {
  //Make input sequence legal
  $legalstemplate = "ACDEFGHIKLMNPQRSTVWY?";
  $template = legalcharactersonly($sequence,$legalstemplate);

  $legalsoptions = "ACDEFGHIKLMNPQRSTVWY";

  //Get options from each line
  $inputoptions = str_replace("\r","\n",$randoms);
  $inputoptions = str_replace("\n\n","\n",$randoms);
  $inputoptions = explode("\n",$randoms);

  //Output array
  $options = array();
  $maxs = array();

  //Push options to options array
  foreach ($inputoptions as $optionskey=>$positionoptions)
    {
    //Flag to add options
    $addoptions = false;

    //Specify all legal options
    if ($positionoptions == "*")
      {
      $positionoptions = $legalsoptions;

      $addoptions = true;
      }
    //Specify all but certain options
    elseif (substr($positionoptions,0,2) == "*-")
      {
      //Find residues to remove
      $removeaas = substr($positionoptions,2);
      //Remove undesired residues
      $positionoptions = str_replace($removeaas,"",$positionoptions);
      $positionoptions = str_split($positionoptions);

      $addoptions = true;
      }
    //If element is not empty add it
    elseif ($positionoptions != "")
      $addoptions = true;

    //If flag to add set then add to options array
    if ($addoptions == true)
      {
      //Check legality and push options
      $positionoptions = legalcharactersonly($positionoptions,$legalsoptions);
      $positionoptions = str_split($positionoptions);
      array_push($options,$positionoptions);

      //Calculate and push max value
      $maxvalue = count($positionoptions)-1;
      array_push($maxs,$maxvalue);
      }
    }

  //Fill remaining positions if no amino acids are specified at positions
  //Get start and finish values for filling loop
  $endpositionkey = substr_count("?",$template);
  $positionkey = count($options);

  //Fill in blanks in library with all residues
  $positionoptions = str_split("ACDEFGHIKLMNPQRSTVWY");
  while ($positionkey < $endpositionkey)
    {
    array_push($options,$positionoptions);
    array_push($maxs,$maxvalue);

    $positionkey++;
    }
  }

$library = array("Template"=>$template,"Options"=>$options,"Maxs"=>$maxs);
?>
