<?php

header('Content-type: text/xml');

//---------- USER SETTINGS
$user = $_POST['username']; // "Glavin";//getipAddress(); // TEMP
$topDir = '/home/student/g_wiechert/public_html/'; // Top directory path, before $uDir
$uDir = "$topDir/HYPC/uploadedCode/".$user.'/'; // User Directory

//---------- SET VARIABLES TO _POST VARIABLES
$code = $_POST['code'];
$input = $_POST['input'];
$language = $_POST['language'];
$pname = $_POST['fname'];

//----------- WORKING VARIABLES
$filename = ''; // Name of file || Name of Problem
$uOutput = 'test'; // User's program output
//$LOG = "logger?"; // *** FOR DEBUGGING ***

//-------- Functions ----------
function runProb()
{
    global $pname, $uOutput, $filename, $uDir, $pDir, $language, $inputFile, $input;

    $filename = 'code';
    if (isset($pname)) {
        $filename = $pname;
    }

    // Write *input* file
    $userInputFile = $uDir.$filename.'.in';
    write2File($uDir, $userInputFile, $input);
    $tag = 'pre';
    $uOutput = '';
    // User's test case
    list($output, $runTime) = runCode($language, $filename, $userInputFile);
    $uOutput = $uOutput.'<tr>';
    $uOutput = $uOutput.'<td align="center" valign="top" ><'.$tag.'>';
    $uOutput = $uOutput.$input;
    $uOutput = $uOutput.'</'.$tag.'></td>';
    $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.'Whatever you wanted it to output.'.'</'.$tag.'></td>';
    $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.$output.'</'.$tag.'></td>';
    $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.'Run time (in seconds):'.$runTime.'</'.$tag.'></td>';
    $uOutput = $uOutput.'</tr>';

    // Go through all test cases
    $allTestCases = getDirectoryList($pDir.'testCases/in/', false);
    foreach ($allTestCases as $t) {
        // Read *input* file
        $allTestCases = getDirectoryList($pDir.'testCases/in/', false);
        $inputFile = $pDir.'/testCases/in/'.($t);
        $probInput = readCode($pDir, $inputFile);
        // Read *output* file
        $outputFile = $pDir.'/testCases/out/'.($t);
        $probOutput = readCode($pDir, $outputFile);
        // Run code
        list($output, $runTime) = runCode($language, $filename, $inputFile);
        // Check if $output is equal to correct $probOutput
        if ($output == $probOutput) {
            $s = 'color:green;font-weight:bold;';
        } else {
            $s = 'color:red;font-style:italic;';
        }
        // Display data
        $uOutput = $uOutput."<tr style='".$s."' >";
        $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>';
        $uOutput = $uOutput.$probInput;
        $uOutput = $uOutput.'</'.$tag.'></td>';
        $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.$probOutput.'</'.$tag.'></td>';
        $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.$output.'</'.$tag.'></td>';
        $uOutput = $uOutput.'<td align="left" valign="top" ><'.$tag.'>'.'Run time (in seconds):'.$runTime.'</'.$tag.'></td>';
        $uOutput = $uOutput.'</tr>';
    }
}

function runCode($language, $filename, $inputFile)
{
    global $uDir, $code;
    $output = $language;
    $startRun = 0;
    $endRun = 0;
    $runTime = 0;

    // Save, compile, run via selected language
    if ($language == 'Python') {
        // Save $code to file
        $ext1 = '.py';
        $fullFile = $uDir.$filename.$ext1;

        write2File($uDir, $fullFile, $code);

        // Run code
        $command1 = 'python '.$fullFile.' -i '.$inputFile.' 2>&1';
        $startRun = microtime(true);
        $run = shell_exec($command1);
        $endRun = microtime(true);

        $output = $run;
    } elseif ($language == 'Java') {
        // Save $code to file
        $ext1 = '.java';
        $fullFile = $uDir.$filename.$ext1;
        //echo $fullFile;

        write2File($uDir, $fullFile, $code);

        // Compile code
        $command1 = 'javac '.$fullFile.' 2>&1';
        $console = shell_exec($command1);
        $output = $console;
        if ($output == '') { // Check for errors
            // no errors
            // Run compiled code
            $command2 = 'cd '.$uDir.'; java '.$filename.' < '.$inputFile.' 2>&1';
            $startRun = microtime(true);
            $run = shell_exec($command2);
            $endRun = microtime(true);

            $output = $run;
        }
    } elseif ($language == 'C++') {

        // Save $code to file
        $ext1 = '.cpp';
        $ext2 = '.out';
        //echo $fullFile;

        write2File($uDir, $uDir.$filename.$ext1, $code);

        // Run code
        //$console = shell_exec("python -c '".$code."'");
        $command1 = 'cd '.$uDir.'; g++ '.$filename.$ext1.' -o '.$filename.$ext2.' 2>&1';
        //echo $command1;
        $console = shell_exec($command1);
        //echo $console;
        $output = $console;
        if ($output == '') {
            $command2 = 'cd '.$uDir.'; ./'.$filename.$ext2.' < '.$inputFile.' 2>&1';
            //echo $command2;
            $startRun = microtime(true);
            $run = shell_exec($command2);
            $endRun = microtime(true);

            $output = $run;
        }
    }

    $runTime = $endRun - $startRun;

    return [$output, $runTime];
}

function loadProb()
{
    global $pname, $filename, $uDir, $pDir, $inputFile, $probInput, $outputFile, $probOutput, $infoFile, $probInfo, $code, $language, $topDir;

    $filename = 'code';
    if (isset($pname)) {
        $filename = $pname;
    }

    // Read *input* file
    $pDir = "$topDir/HYPC/ProblemZone/Problems/".$pname.'/';
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

function xmlOut($con, $tag)
{
    return '<'.$tag.'>'.$con.'</'.$tag.'>';
}

function cdat($dat)
{
    return '<![CDATA['.$dat.']]>';
}

//---------- MAIN -------------
loadProb();
runProb();
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<result>';
echo xmlOut('compiler', 'TYPE');
echo xmlOut(cdat($code), 'CODE');
echo xmlOut(cdat($input), 'INPUT');
echo xmlOut(cdat($uOutput), 'uOutput');
//echo xmlOut($LOG,"LOG");
echo '</result>';
