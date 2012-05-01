import java.net.*;
import java.io.*;
public class Client {
    
public static void main( String args[])
{
    
    try{
        Socket s = new Socket("127.0.0.1",81); //creates a stream socket and connects to port no.
        
        
        BufferedReader in = new BufferedReader(new InputStreamReader(s.getInputStream()));//getInputStream-returns input stream for socket
        PrintWriter out = new PrintWriter(s.getOutputStream(),true);
        
        BufferedReader scanf = new BufferedReader(new InputStreamReader(System.in));
        
    boolean done = false;
        while(!done)
        {
        	String line;
            System.out.println("message:- ");
            if(s.isConnected())
                out.println(scanf.readLine()); //it sends printed output to the server
            else
                break;
            line = in.readLine(); //it reads from server
            System.out.println("'" + line + "' this message sent successfully to server.\n"); // line is coming from server
            
             if(line.equals("bye"))
                   done = true;
        }
    }
    catch(IOException e)
    {
       
    }
    
}
    
}
