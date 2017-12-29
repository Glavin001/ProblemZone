<?php

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

//--------- MOBILE DETECT
$mobile = false;
$mobile = (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod'));

// --------- FUNCTIONS
function getIpAddress()
{
    return empty($_SERVER['HTTP_CLIENT_IP']) ? (empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_X_FORWARDED_FOR']) : $_SERVER['HTTP_CLIENT_IP'];
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

function optionsFromArray($arr)
{
    global $pname;
    echo '<select id="fname" name="fname" >';
    foreach ($arr as $o) {
        echo '<option value="'.$o.'" ';
        isSelected($pname, $o);
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
    $output = runCode($language, $filename, $userInputFile);
    $uOutput = $uOutput.'<tr><td><'.$tag.'>';
    $uOutput = $uOutput.$input;
    $uOutput = $uOutput.'</'.$tag.'></td>';
    $uOutput = $uOutput.'<td><'.$tag.'>';
    $uOutput = $uOutput.'Whatever you wanted it to output.';
    $uOutput = $uOutput.'</'.$tag.'></td>';
    $uOutput = $uOutput.'<td><'.$tag.'>';
    $uOutput = $uOutput.$output;
    $uOutput = $uOutput.'</'.$tag.'></td></tr>';
    /*
    // Go through all test cases
    $allTestCases = getDirectoryList($pDir."testCases/in/",false);
    foreach ($allTestCases as $t)
    {

        // Read *input* file
        $allTestCases = getDirectoryList($pDir."testCases/in/",false);
        $inputFile = $pDir."/testCases/in/".($t);
        $probInput = readCode($pDir,$inputFile);
        // Read *output* file
        $outputFile = $pDir."/testCases/out/".($t);
        $probOutput = readCode($pDir,$outputFile);
        // Run code
        $output = runCode($language,$filename,$inputFile);
        // Check if $output is equal to correct $probOutput
        if ($output == $probOutput) { $s = "color:green;font-weight:bold;"; } else { $s = "color:red;font-style:italic;"; }
        // Display data
        $uOutput = $uOutput."<tr style='".$s."' ><td><".$tag.">";
        $uOutput = $uOutput.$probInput;
        $uOutput = $uOutput."</".$tag."></td>";
        $uOutput = $uOutput."<td><".$tag.">";
        $uOutput = $uOutput.$probOutput;
        $uOutput = $uOutput."</".$tag."></td>";
        $uOutput = $uOutput."<td><".$tag.">";
        $uOutput = $uOutput.$output;
        $uOutput = $uOutput."</".$tag."></td></tr>";

    }
    */
}

function runCode($language, $filename, $inputFile)
{
    global $uDir, $code;
    $output = '';

    // Save, compile, run via selected language
    if ($language == 'Python') {
        // Save $code to file
        $ext1 = '.py';
        $fullFile = $uDir.$filename.$ext1;

        write2File($uDir, $fullFile, $code);

        // Run code
        $command1 = 'python '.$fullFile.' -i '.$inputFile.' 2>&1';
        $run = shell_exec($command1);

        /*
        // Display output

        <textarea  id="output" name="output" readonly="readonly"><? echo $run; ?></textarea><br />

        */
        $output = $run."\n".$command1;
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
            $run = shell_exec($command2);

            /*
            // Display output

            <hr> <textarea  name="output" id="output" readonly="readonly"><? echo $run; ?></textarea><br />

            }
            else
            { // Errors
            // Display errors

            <hr /> <pre  id="output" ><? echo $console; ?></pre><br />

            */
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
            $run = shell_exec($command2);

            /*
            // Display output

            <textarea  name="output" id="output" readonly="readonly"><? echo $run; ?></textarea><br />

            */
            $output = $run;
        }
    }

    return $output;
}

/*
//--------- CHECK IF RUNNING
if (isset($_POST['run']))
{ // if page is not submitted to itself echo the form
    // Post-Submitted page
    // Process submission
    */

    loadProb();
    if ($code == '') {
        loadCode();
    } else {
        runProb();
    }
    echo $uOutput;
    /*
}
//--------- CHECK IF LOADING
else if (isset($_POST['load'])) // Check if loading previously saved file
{
    // Is loading file
    loadProb();
    loadCode();
}
//--------- DEFAULT
else
{
    // Fresh page.
    // Process nothing.

}
*/
