// Long Term Memory (local storage)
localStorage.visitCount;

// Short Term Memory (session storage)


// Working Memory (Global variables)
var c=0;
var t;
var welcomeMsg = 
	"I would like to tell you about the <a href='https://www.facebook.com/groups/155246931207146/'>Halifax Youth Programming Club</a>. "+
	"If you click the link, you will see our Facebook page."+"<br/>"+
	"You may be wondering who I am. I am <font size=50px>The-<i>Cooler</i>-Dawson</font>, your very own personal assistant, while you are on this site."+"<br/>"+
	"Presently, I am just learning how to communicate. Eventually, I will be able to help you with your programming problems by giving you hints, keep track of your progress, and even show you where you are ranked against other prgorammers! "+
	"Over time I will learn to do even more for you, <i>please be patient with me :)</i>.";
var welcomeBack = "Welcome back!";
	
// Functions
function onload(pageName)
{
 // window.localStorage.clear(); // For refreshing/clearing localStorage data
	if (localStorage.visitCount)
	{
		localStorage.visitCount=Number(localStorage.visitCount)+1;
	}
	else
	{
		localStorage.visitCount=1;
	}
	
	// TEST
	if (pageName == "Home") {welcomeHome();}
	if (pageName == "cloudIDE") {progAssist();}
			
}

function welcomeHome()
{
	var msg = "";
	if (localStorage.visitCount == 1)
	{
		msg = "<b>Hi! </b>"+"It's nice to meet you :)."+"<br/>"+ welcomeMsg;
	}
	else
	{
		msg = welcomeBack+" "+localStorage.visitCount+" times so far... you must love it here!"+"<br/>"+welcomeMsg;
	}
	
	document.getElementById('code').innerHTML=msg.substring(0,c);
	c=c+1;
	var interval = 50;
	var callFunction = "welcomeHome()";
	t=setTimeout(callFunction,interval);
}

function progAssist()
{

	var codearea = document.getElementById("code");
	if ((codearea.innerHTML != "") && (c==0)) { return 0; }

/*
try
{
	// document.getElementById("questionBox").innerHTML = document.getElementById("questionBox").innerHTML + ".";
	var questions = window.reviewXML.getElementsByTagName("QUESTION");
	//var Q = questions[i].getElementsByTagName("Q")[0].childNodes[0].nodeValue;
   // var A = questions[i].getElementsByTagName("ANSWER")[0].getElementsByTagName("FULL")[0].childNodes[0].nodeValue;
    //var N = questions[i].getElementsByTagName("ID")[0].childNodes[0].nodeValue;
    var num=parseInt(ns[window.n]);
var keys = questions[num].getElementsByTagName("ANSWER")[0].getElementsByTagName("KEY");
} catch (err) 
		{ logC("Error: "+err); }
 */
 
  /*
  // KEYS TEST
  try
  {
  questions = x;
  var a0 = x[i].getElementsByTagName("ANSWER")[0];
  logC("a0:"+a0+"<br/>"+a0.length);
  var keysA = a0.getElementsByTagName("KEY");
  logC("keysA:"+keysA+"<br/>"+keysA.length);
  var k0 = keysA[0];
  logC("k0:"+k0+"<br/>"+k0.length);
  var wordsA = k0.getElementsByTagName("WORD");
  logC("wordsA:"+wordsA+"<br/>"+wordsA.length);
  var w0 = wordsA[0];
  logC("w0:"+w0+"<br/>"+w0.length);
  var v0 = parseFloat(k0.getElementsByTagName("VALUE")[0].childNodes[0].nodeValue);
  logC("v0:"+v0+"<br/>"+v0.length);
  } catch (err) { logC("Error: "+err); }
  */
  
	var caretPos = doGetCaretPosition(codearea);
	
	/*
	//logC("keys.length:"+keys.length);
	var score = 0; // 0=0%, 1=100%
	
	try
	{
		
	for (var k = 0; k<keys.length;k++)
	{
		  
		//var a0 = x[i].getElementsByTagName("ANSWER")[0];
		//var kA = a0.getElementsByTagName("KEY");
		var key = keys[k];
		var words = key.getElementsByTagName("WORD");
		var val = parseFloat(key.getElementsByTagName("VALUE")[0].childNodes[0].nodeValue);
							
		var hasWord = false;
		try
		{
			for (var w = 0; w<words.length; w++)
			{
				var word = String(words[w].childNodes[0].nodeValue).toLowerCase();
				//logC("word["+w+"]:"+word);
				var count = occurrences(String(""+answerInput.value+"").toLowerCase(),String(""+word+""));
				//logC("occurs:"+count);
				if (count > 0)
				{
					hasWord = true;
					//logC("hasWord:"+hasWord);
				}
				
				
			}
		}
		catch (err) 
		{ logC("Error: "+err); }
					
		//logC("score:"+score);
		//logC("val:"+val);
		//logC("hasWord:"+hasWord);
		if (hasWord == true)
		{
			score = score + val;
			//logC("score:"+score);
		}
		//logC("new score:"+score);
		
	}
	
	} catch (err) 
		{ logC("Error: "+err); }
	*/
	
	/*
			var input = answerInput.value;
			var initWord = "*Glavin*";
			var finalWord = "*Glavin is Awesome*";
			var count = (occurrences(input,initWord));
			while (occurrences(input,initWord) > 0)
			{
				//input = input.replace(new RegExp(initWord, 'g'), finalWord);
				input = input.replace(initWord,finalWord);
			}
			var delta = count*(finalWord.length-initWord.length);
			document.getElementById("answerInput").value = input;//input;
			var caretPos = (caretPos+delta);
			
	 setCaretPosition(answerInput,caretPos);
	*/
	/*
	var corrections = ("You're score is " + (score*100) + "%.");
	document.getElementById("questionBox").innerHTML = "Question:<br/>"+window.q + "<br/><br/>" + corrections;//input;
	*/
	
	// get file name
	var fileName = document.getElementById("fname").value;
	
	// Get language
	var select_list_field = document.getElementById('language');
	var select_list_selected_index = select_list_field.selectedIndex;	
	var text = select_list_field.options[select_list_selected_index].text;
	var language = select_list_field.value;
	
	// Set programming language grammar and parts
	var slc = ""; // Single Line Comment
	var mlcS = ""; // Multi-Line Comment, Start
	var mlcE = ""; // Multi-Line Comment, End
	var sT = ""; // Statement terminator
	var concat = ""; // Concatenation 
	var printS = ""; // Printing to console, Start
	var printE = ""; // Printing to console, End
	
	// EXAMPLE CODE
	var helloWorld = ""; // Hello World example code
	var input = ""; // Example code for taking input
	
	
	if (language == "Python")
	{
		var slc = "#"; // Single Line Comment
		var mlcS = "'''"; // Multi-Line Comment, Start
		var mlcE = "'''"; // Multi-Line Comment, End
		var sT = ""; // Statement terminator
		var concat = "+"; // Concatenation 
		var printS = "print ("; // Printing to console, Start
		var printE = ")"; // Printing to console, End
		
		// EXAMPLE CODE
		var helloWorld = (printS+'"Hello World"'+printE); // Hello World example code
		var input = ""; // Example code for taking input
		
	}
	else if (language == "Java")
	{
		var slc = "//"; // Single Line Comment
		var mlcS = "/*"; // Multi-Line Comment, Start
		var mlcE = "*/"; // Multi-Line Comment, End
		var sT = ";"; // Statement terminator
		var concat = "+"; // Concatenation 
		var printS = "System.out.print("; // Printing to console, Start
		var printE = ")"; // Printing to console, End
		
		// EXAMPLE CODE
		var helloWorld = ("public class "+fileName+"\n"+"{"+"\n\t"+"public static void main(String[] args)"+"\n"+"\t{"+"\n\t\t"+printS+'"Hello World"'+printE+sT+"\n"+"\t}"+"\n"+"}"); // Hello World example code
		var input = ""; // Example code for taking input
		
	}
	else if (language == "C++")
	{
		var slc = "//"; // Single Line Comment
		var mlcS = "/*"; // Multi-Line Comment, Start
		var mlcE = "*/"; // Multi-Line Comment, End
		var sT = ";"; // Statement terminator
		var concat = "+"; // Concatenation 
		var printS = "cout << "; // Printing to console, Start
		var printE = ""; // Printing to console, End
		
		// EXAMPLE CODE
		var helloWorld = ("#include <iosteam>"+"\n"+"using namespace std;"+"\n"+"int main()"+"\n"+"{"+"\n"+"\t"+printS+'"Hello World"'+printE+sT+"\n"+"\t"+"return 0;"+"\n"+"}"); // Hello World example code
		var input = (slc+" Input/output example"+"\n"+"#include <iosteam>"+"\n"+"using namespace std;"+"\n"+"int main()"+"\n"+"{"+"\n"+"\t"+printS+'"Hello World"'+printE+sT+"\n"+"\t"+"return 0;"+"\n"+"}"); // Example code for taking input
		
	}
	
	var msg = (slc + " This is a single line comment."+"\n"+mlcS+" This is a multi-line comment. "+mlcE+"\n"+helloWorld);
	
	codearea.innerHTML=msg.substring(0,c);
	c=c+1;
	var interval = 10;
	var callFunction = "progAssist()";
	t=setTimeout(callFunction,interval);
	
}

function occurrences(string, substring){

    var n=0;
    var pos=0;

    while(true){
        pos=string.indexOf(substring,pos);
        if(pos!=-1){ n++; pos+=substring.length;}
        else{break;}
    }
    return(n);
}

function doGetCaretPosition (ctrl) {
	var CaretPos = 0;	// IE Support
	if (document.selection) {
	ctrl.focus ();
		var Sel = document.selection.createRange ();
		Sel.moveStart ('character', -ctrl.value.length);
		CaretPos = Sel.text.length;
	}
	// Firefox support
	else if (ctrl.selectionStart || ctrl.selectionStart == '0')
		CaretPos = ctrl.selectionStart;
	return (CaretPos);
}
function setCaretPosition(ctrl, pos){
	if(ctrl.setSelectionRange)
	{
		ctrl.focus();
		ctrl.setSelectionRange(pos,pos);
	}
	else if (ctrl.createTextRange) {
		var range = ctrl.createTextRange();
		range.collapse(true);
		range.moveEnd('character', pos);
		range.moveStart('character', pos);
		range.select();
	}
}
