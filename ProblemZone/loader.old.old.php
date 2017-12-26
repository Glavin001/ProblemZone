<?php

header('Content-type: text/xml');

//---------- USER SETTINGS
$user = 'Glavin'; //getipAddress(); // TEMP
$uDir = '/var/www/HYPC/uploadedCode/'.$user.'/'; // User Directory

//---------- SET VARIABLES TO _POST VARIABLES
$code = $_POST['code'];
$input = $_POST['input'];
$language = $_POST['language'];
$pname = $_POST['fname'];

//----------- WORKING VARIABLES
$filename = ''; // Name of file || Name of Problem
$uOutput = ''; // User's program output

function getDirectoryList($d, $h)
{

    // create an array to hold directory list
    $results = [];

    // create a handler for the directory
    $handler = opendir($d);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {

      // if file isn't this directory or its parent, add it to the results
        if ($file != '.' && $file != '..') {
            $results[] = $file;
        }
    }

    // tidy up: close the handler
    closedir($handler);

    // Check if should include hidden files, $h parameter
    if ($h == false) {
        $results = array_filter($results, create_function('$a', 'return ($a[0]!=".");'));
    }

    // done!
    return $results;
}

function readCode($uDir, $fullFile)
{
    $contents = '';

    // Let's make sure the file exists and is readable first.
    if ((file_exists($fullFile)) == false) {
        //echo "File does not exist";
        // Create blank file
        write2File($uDir, $fullFile, '');
        if (!is_dir($uDir)) {
            // directory does not exist
            mkdir($uDir);
        }

        $handle = fopen($fullFile, 'r') or die('Cannot open file:  '.$fullFile); //implicitly creates file
    //echo "File has been created";
    } else {
        //echo "File exists";
    }

    if (is_readable($fullFile)) {
        if (!$handle = fopen($fullFile, 'r')) {
            //echo "Cannot open file ($fullFile)";
            exit;
        }
        $contents = fread($handle, filesize($fullFile));

        fclose($handle);
    } else {
        //echo "The file $fullFile is not writable";
    }

    return $contents;
}

function write2File($uDir, $fullFile, $code)
{

// Let's make sure the file exists and is writable first.
    if ((file_exists($fullFile)) == false) {
        //echo "File does not exist";
        if (!is_dir($uDir)) {
            // directory does not exist
            mkdir($uDir);
        }

        $handle = fopen($fullFile, 'w') or die('Cannot open file:  '.$fullFile); //implicitly creates file
//echo "File has been created";
    } else {
        //echo "File exists";
    }

    if (is_writable($fullFile)) {
        // In our example we're opening $filename in append mode.
        // The file pointer is at the bottom of the file hence
        // that's where $somecontent will go when we fwrite() it.
        if (!$handle = fopen($fullFile, 'w')) {
            //echo "Cannot open file ($fullFile)";
            exit;
        }
        // Write $somecontent to our opened file.
        if (fwrite($handle, $code) === false) {
            //echo "Cannot write to file ($fullFile)";
            exit;
        }
        //echo "Success, wrote ($code) to file ($fullFile)";
        fclose($handle);
    } else {
        //echo "The file $fullFile is not writable";
    }
}

function loadProb()
{
    global $pname, $filename, $uDir, $pDir, $inputFile, $probInput, $outputFile, $probOutput, $infoFile, $probInfo, $code, $language;

    $filename = 'code';
    if (isset($pname)) {
        $filename = $pname;
    }

    // Read *input* file
    $pDir = '/var/www/HYPC/ProblemZone/Problems/'.$pname.'/';
    $allTestCases = getDirectoryList($pDir.'testCases/'.'in/', false);
    $inputFile = $pDir.'/testCases/in/'.($allTestCases[0]);
    $probInput = readCode($pDir, $inputFile);
    // Read *output* file
    $outputFile = $pDir.'/testCases/out/'.($allTestCases[0]);
    $probOutput = readCode($pDir, $outputFile);
    // Read *info* file
    $infoFile = $pDir.'info.txt';
    $probInfo = readCode($pDir, $infoFile);
}

function loadCode()
{
    global $filename, $uDir, $code, $language, $input;

    // Write *input* file
    $userInputFile = $uDir.$filename.'.in';
    $input = readCode($uDir, $userInputFile);

    // Save, compile, run via selected language
    if ($language == 'Python') {
        //echo "PYTHON!!!";

        // Save $code to file
        $ext1 = '.py';
        $fullFile = $uDir.$filename.$ext1;

        $code = readCode($uDir, $fullFile);
    } elseif ($language == 'Java') {
        // Save $code to file
        $ext1 = '.java';
        $fullFile = $uDir.$filename.$ext1;
        //echo $fullFile;

        $code = readCode($uDir, $fullFile);
    } elseif ($language == 'C++') {

    // Save $code to file
        $ext1 = '.cpp';
        $fullFile = $uDir.$filename.$ext1;
        //echo $fullFile;

        $code = readCode($uDir, $fullFile);
    }
}

function optionsFromArray($arr)
{
    global $pname;
    echo '<select id="fname" name="fname" >';
    foreach ($arr as $o) {
        echo '<option value="'.$o.'" ';
        //isSelected($pname,$o);
        echo ' >'.$o.'</option>';
    }
    echo '</select>';
}

function isSelected($sOption, $option)
{
    if ($sOption == $option) {
        echo 'selected="selected"';
    } else {
        echo '';
    }
}

function xmlOut($con, $tag)
{
    return '<'.$tag.'>'.$con.'</'.$tag.'>';
}

function cdat($dat)
{
    return '<![CDATA['.$dat.']]>';
}

// ---------- MAIN --------
// $allProblems = getDirectoryList("/var/www/HYPC/ProblemZone/Problems/",false);

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<result>';
echo xmlOut('loader', 'TYPE');
/*
echo "<pSelect><![CDATA[";
echo optionsFromArray($allProblems)); // Problems to select
echo "]]></pSelect>";
*/
echo xmlOut(cdat('test'), 'probInfo'); // Problem info
echo '</result>';
