import java.io.*;
import java.net.*;

class client1
{
	public static void main(String args[])
	{
		try
		{

			Socket s=new Socket("localhost",1001);

			BufferedReader in = new BufferedReader(new InputStreamReader(s.getInputStream()));

			PrintWriter out = new PrintWriter(s.getOutputStream(),true);
		
			BufferedReader scanf = new BufferedReader(new InputStreamReader(System.in));

			while(true)
			{
				System.out.println("Client : ");
				if(s.isConnected())
					out.println(scanf.readLine());
				else
					break;
				System.out.println("Server : " +	in.readLine());
			}


		}catch(Exception e)
		{
		}
	}
}



