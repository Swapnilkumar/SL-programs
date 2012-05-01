import java.sql.*;
import java.io.*;

class Bank 
{
	public static Connection conn;
	public static Statement st;
	public static BufferedInputStream bis;
	public static DataInputStream dis;
	public Bank()
	{
		 bis=new BufferedInputStream(System.in);
		 dis=new DataInputStream(bis);
	}
	public void display()throws Exception
	{
		ResultSet rs = st.executeQuery("select * from bank");
		while(rs.next())
		{
			System.out.println("Account ID:"+ rs.getInt(1));
			System.out.println("Name:"+rs.getString(2));
			System.out.println("City:"+rs.getString(3));
			System.out.println("-------");
		}
		rs.close();
	}
	
	public void add()throws Exception
	{
		int id;
		String name,city;
		System.out.println("Enter Account ID:");
		id=Integer.parseInt(dis.readLine());
		System.out.println("Enter Name:");
		name=dis.readLine();
		System.out.println("Enter city:");
		city=dis.readLine();
		st.executeUpdate("insert into bank values("+id+",'"+name+"','"+city+"')");
		
	}
	
	public void search()throws Exception
	{
		int id,id1;
		System.out.println("Enter Account ID:");
		id=Integer.parseInt(dis.readLine());
		ResultSet rs=st.executeQuery("select * from bank where AccountID="+id);
		rs.next();
		System.out.println("Account ID:"+ rs.getInt(1));
		System.out.println("Name:"+rs.getString(2));
		System.out.println("City:"+rs.getString(3));
		System.out.println("-------");	
		rs.close();
	}
	
	public void delete() throws Exception
	{
		int id;
		System.out.println("Enter Account ID:");
		id=Integer.parseInt(dis.readLine());
		int row=st.executeUpdate("delete from bank where AccountID=" + id );
		
	}
	public static void main(String args[]) throws Exception
	{
	    Bank b=new Bank();
		Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		String url="jdbc:odbc:dhiraj";
        Connection conn=DriverManager.getConnection(url);
       //System.out.println("Connection to database created");
        Statement st=conn.createStatement();
		//conn = DriverManager.getConnection(url);
		//st = conn.createStatement();
		
		int ch=0,opt;
		while(ch==0)
		{
			System.out.println("-----MENU-------");
			System.out.println("1. Add a record:");
			System.out.println("2. Delete a record:");
			System.out.println("3. Search a record:");
			System.out.println("4. Display all the records:");
			System.out.println("Enter your choice:");
			opt=Integer.parseInt(dis.readLine());
		
			switch(opt)
			{
				case 1:
							b.add();
							break;
				case 2:
							b.delete();
							break;
				case 3:
							b.search();
							break;
				case 4:
							b.display();
							break;
							
			}
			System.out.println("Do you want to continue?(0-yes/1-no):");
			ch=Integer.parseInt(dis.readLine());
		}
		st.close();
	}
}
	
	
