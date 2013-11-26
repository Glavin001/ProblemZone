<?PHP
header("Content-type: text/xml"); 

//---------- USER SETTINGS
$user = $_POST['username']; // "Glavin";//getipAddress(); // TEMP
$uDir = "/var/www/HYPC/uploadedCode/".$user."/"; // User Directory

//---------- SET VARIABLES TO _POST VARIABLES
$code = $_POST["code"];
$input = $_POST["input"];
$language = $_POST["language"];
$pname = $_POST["fname"];

//----------- WORKING VARIABLES
$filename = ""; // Name of file || Name of Problem
$uOutput = "test"; // User's program output

//-------- Functions ----------
function runProb()
{
	global $pname, $uOutput, $filename, $uDir, $pDir, $language, $inputFile, $input;

	$filename = "code";
	if(isset($pname))
	{
		$filename = $pname;
	}
	
	// Write *input* file
	$userInputFile = $uDir.$filename.".in";
	write2File($uDir,$userInputFile,$input);
	$tag = "pre";	
	$uOutput = "";
	// User's test case
	$output = runCode($language,$filename,$userInputFile);
	$uOutput = $uOutput."<tr><td><".$tag.">";
	$uOutput = $uOutput.$input;
	$uOutput = $uOutput."</".$tag."></td>";
	$uOutput = $uOutput."<td><".$tag.">";
	$uOutput = $uOutput."Whatever you wanted it to output.";
	$uOutput = $uOutput."</".$tag."></td>";
	$uOutput = $uOutput."<td><".$tag.">";
	$uOutput = $uOutput.$output;
	$uOutput = $uOutput."</".$tag."></td></tr>";
	// Go through all test cases
	/*
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


function runCode($language,$filename,$inputFile)
{
	global $uDir, $code;
	$output = "";
	
	// Save, compile, run via selected language
	if ($language == "Python")
	{
		// Save $code to file
		$ext1 = ".py";
		$fullFile = $uDir.$filename.$ext1;
		
		write2File($uDir,$fullFile,$code);
		
		// Run code
		$command1 = "python ".$fullFile." -i ".$inputFile." 2>&1";
		$run = shell_exec($command1);
		
		$output = $run."\n".$command1;

		
	}
	else if ($language == "Java")
	{
		// Save $code to file
		$ext1 = ".java";
		$fullFile = $uDir.$filename.$ext1;
		//echo $fullFile;
		
		write2File($uDir,$fullFile,$code);
		
		// Compile code
		$command1="javac ".$fullFile." 2>&1";
		$console = shell_exec($command1);
		$output = $console;
		if ($output=="") // Check for errors
		{ // no errors
			// Run compiled code
			$command2 = "cd ".$uDir."; java ".$filename." < ".$inputFile." 2>&1";
			$run = shell_exec($command2);
			
			$output = $run;
		}
		
	
	}
	else if ($language == "C++")
	{
		
		// Save $code to file
		$ext1 = ".cpp";
		$ext2 = ".out";
		//echo $fullFile;
		
		write2File($uDir,$uDir.$filename.$ext1,$code);
		
		// Run code
		//$console = shell_exec("python -c '".$code."'");
		$command1="cd ".$uDir."; g++ ".$filename.$ext1." -o ".$filename.$ext2." 2>&1";
		//echo $command1;
		$console = shell_exec($command1);
		//echo $console;
		$output = $console;
		if ($output=="")
		{
			$command2 = "cd ".$uDir."; ./".$filename.$ext2." < ".$inputFile." 2>&1";
			//echo $command2;
			$run = shell_exec($command2);
			
			$output = $run;
		}
		
	}
	
	return $output;
	
}



function write2File($uDir,$fullFile,$code)
{

// Let's make sure the file exists and is writable first.
if ((file_exists($fullFile))==false)
{
//echo "File does not exist";
if (!is_dir($uDir))
{
// directory does not exist
mkdir($uDir);
}

$handle = fopen($fullFile, 'w') or die('Cannot open file:  '.$fullFile); //implicitly creates file
//echo "File has been created";
}
else
{
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
    if (fwrite($handle, $code) === FALSE) {
        //echo "Cannot write to file ($fullFile)";
        exit;
    }
    //echo "Success, wrote ($code) to file ($fullFile)";
    fclose($handle);
} else {
    //echo "The file $fullFile is not writable";
}

}

function xmlOut($con,$tag)
{
	return "<".$tag.">".$con."</".$tag.">";
}

//---------- MAIN -------------
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "<result>";
echo xmlOut("compiler","TYPE");
echo xmlOut($code,"CODE");
echo xmlOut($input,"INPUT");
echo xmlOut($uOutput,"uOutput");
echo "</result>";

?>