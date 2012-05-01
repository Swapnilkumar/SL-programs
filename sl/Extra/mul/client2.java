import java.io.*;
import java.net.*;

class client2
{
	public static void main(String args[])
	{
		try
		{

			Socket s=new Socket("localhost",1002);

			DataInputStream dis=new DataInputStream(s.getInputStream());
			DataOutputStream dos=new DataOutputStream(s.getOutputStream());
			BufferedReader br=new BufferedReader(new InputStreamReader(System.in));

			System.out.println("Enter First No.=");
			String str=br.readLine();
			int num1=Integer.parseInt(str);
			dos.writeInt(num1);

			System.out.println("Enter Second  No.=");
			str=br.readLine();
			int num2=Integer.parseInt(str);
			dos.writeInt(num2);

			int ans=dis.readInt();
			System.out.println("Multiplication is="+ans);
		}catch(Exception e)
		{
		}


	}
}



