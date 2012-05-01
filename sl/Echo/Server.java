import java.io.*;
import java.net.*;


public class Server {
    
    /** Creates a new instance of Server */
    public static void main(String args[])
    {
        try{
        ServerSocket s = new ServerSocket(81);
        Socket incoming = s.accept();
        
        BufferedReader in = new BufferedReader(new InputStreamReader(incoming.getInputStream()));
        PrintWriter out = new PrintWriter(incoming.getOutputStream(),true);
                
        BufferedReader scanf = new BufferedReader(new InputStreamReader(System.in));
        boolean done = false;
        while(done != true)
        {
            String line = in.readLine();
            System.out.println("from Client:" + line);
            
            // System.out.println("1 :");
            //if(scanf.available()!=0)
            out.println(line);
            
            if(line.trim().equals("bye"))
                   done = true;
        }
        
        }
        catch (IOException e)
        {
            
        }
                
    }
    
}
