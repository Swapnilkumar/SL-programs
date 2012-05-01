import java.sql.*;
import java.net.*;
import java.io.*;

class Greetclient
{
	public static void main(String args[])
	{
		try
		{
			Socket con=new Socket("127.0.0.1",82);
			BufferedReader br= new BufferedReader (new InputStreamReader(con.getInputStream()));
			PrintWriter out= new PrintWriter (con.getOutputStream(),true);
			BufferedReader in = new BufferedReader (new InputStreamReader(System.in));
			
			boolean done=true;
			boolean result;
			
			while(done)
			{
			
					System.out.println("Enter the msg	");
					String msg=in.readLine();
					out.println(msg);
					String reply=br.readLine();
						System.out.println("Server reply		"+reply);
			}	
		}
		catch(Exception e){   }
	}
}