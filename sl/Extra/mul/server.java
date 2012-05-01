import java.io.*;
import java.net.*;

class server implements Runnable
{
	Thread t1,t2;
	server()
	{
		t1=new Thread(this,"serv");
		t2=new Thread(new mult(),"serv1");

		t1.start();
		t2.start();
	}
	public static void main(String args[])
	{
		new server();
	}

	public  void run()
	{
		try
		{
		ServerSocket s=new ServerSocket(1001);
		Socket incoming=s.accept();

		System.out.println("Addition thread started.");

		BufferedReader in = new BufferedReader(new InputStreamReader(incoming.getInputStream()));

		PrintWriter out = new PrintWriter(incoming.getOutputStream(),true);

		BufferedReader scanf = new BufferedReader(new InputStreamReader(System.in));

		boolean done = false;
		while(done!=true)
		{
			String line = in.readLine();
			System.out.println("\nClient : " + line);
			System.out.println("\nServer : ");
			out.println(scanf.readLine());
			if(line.trim().equals("Bye"))
				done=true;
		}			
		}catch(Exception e)
		{
		}
	}
}
 class mult implements Runnable
{
	public void run()
	{
		try
		{
		ServerSocket ss=new ServerSocket(1002);
		Socket s=ss.accept();

		System.out.println("Multiplication thread started.");

		DataInputStream dis=new DataInputStream(s.getInputStream());
		DataOutputStream dos=new DataOutputStream(s.getOutputStream());

		

		
		int num1=dis.readInt();

		int num2=dis.readInt();

		int num3=num1*num2;
		
		dos.writeInt(num3);
		}catch(Exception e)
		{
		}
	}
}
