import java.sql.*;
import java.net.*;
import java.io.*;

public class Greetserver
{
	public static void main(String args[])
	{
		try
		{
			ServerSocket s=new ServerSocket(82);
			Socket con=s.accept();
			BufferedReader br= new BufferedReader (new InputStreamReader(con.getInputStream()));
			PrintWriter out= new PrintWriter(con.getOutputStream(),true);
			
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
			System.out.println("Driver loaded");
			String url="jdbc:odbc:dsn";
			Connection conn=DriverManager.getConnection(url);
			Statement sts=conn.createStatement();
			System.out.println("Connection established");
			
			boolean done=true;
			String reply="";			
			while(done)
			{
					String msg=br.readLine();
					String sql="select ansr from greetings where ques= '"+ msg+ "'";
					ResultSet results=sts.executeQuery(sql);
					
					while(results.next())
					{
						reply=results.getString(1);
					}
					out.println(reply);
					if(msg.equals("bye"))
						done=false;
			}	
		}
		catch(Exception e) { }
	}
}
