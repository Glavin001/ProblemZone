
// Using Scanner ?
import java.util.Scanner;

public class TwoNumberCalculator
{

public static void main(String args[])
{

// Create Scanner
Scanner input = new Scanner(System.in);

// Take in two numbers
System.out.print("Please input two numbers:"); // Ask user for numbers
int num1 = input.nextInt(); // Assuming integers
int num2 = input.nextInt(); // Assuming integers
System.out.print("Please input the operation. Valid choices are: plus/add/sum, subtract/minus/difference, ratio/divide, product/multiply"); // Ask user for desired operation
String op = input.next(); // Get next word, text item delimiter being space character, ‘ ‘.

// Choose operation given numbers
// Using *if* statement
double answer = 0.0;
if (op.equals("plus") || op.equals("add") || op.equals("sum") )
{
// Add num1 + num2
answer = (int) num1 + num2;
}
else if (op.equals("subtract") || op.equals("minus") || op.equals("difference") )
{
// Subtract 
answer = Math.abs(num1-num2);
}
else if (op.equals("ratio") || op.equals("divide") )
{
// Divide
answer = (double) Math.max(num1,num2)/Math.min(num1,num2);
}

else if (op.equals("product") || op.equals("multiply") )
{
// Multiply
answer = num1 * num2;
}
else
{
// default action, if none of the above are true.
System.out.println("Dude, input a valid operator!");
}

// Output answer
System.out.println("The answer is: "+answer);

}

}

