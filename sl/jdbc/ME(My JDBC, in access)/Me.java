//ACCESS

import java.sql.*;
import java.io.DataInputStream;

class Me
{
	public static void main(String args[])
	{
        int ch=0,eno,salary;
        String sql,name,cname,addr;
        boolean result;
        DataInputStream in=new DataInputStream(System.in);
	try
	{
	Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
	System.out.println("Driver loaded");
	String url="jdbc:odbc:dhiraj1";
        Connection con=DriverManager.getConnection(url);
        System.out.println("Connection to database created");
        Statement state=con.createStatement();
        while (ch!=8)
        {
        System.out.println("MENU : \n1.Create\n2.Insert\n3.Modify\n4.Display\n5.Drop\n6.Delete\n7.Search\n8.Exit\n: ");
        ch=Integer.parseInt(in.readLine());
        switch(ch)
        {
            case 1:
				sql="drop table employee";
				result=state.execute(sql);
                sql="create table employee(eno integer,name text,cname text,salary integer,addr text)";
                result=state.execute(sql);
                if(result==true)
                    System.out.println("Table not created");
                else
                    System.out.println("Table created");
                break;
            case 2:
                System.out.println("\n	ENTER REQUIRED INFORMATION :\n");
                System.out.println("EMPLOYEE NUMBER : ");
                eno=Integer.parseInt(in.readLine());
                System.out.println("NAME : ");
                name=in.readLine();
				System.out.println("COMPANY NAME : ");
				cname=in.readLine();
				System.out.println("SALARY :");
				salary=Integer.parseInt(in.readLine());
				System.out.println("ADDRESS :");
				addr=in.readLine();
                sql="insert into employee values("+ eno +",'"+ name +"','"+ cname +"',"+ salary +",'"+ addr +"')";
                result=state.execute(sql);
                if(result==true)
                    System.out.println("Record not inserted");
                else
                    System.out.println("1 record inserted");
                break;
            case 3:
                System.out.println("\n	UPDATE EMPLOYEE COMPANY AND SALARY :\n");
                System.out.println("EMPLOYEE NUMBER : ");
                eno=Integer.parseInt(in.readLine());
                System.out.println("NEW COMPANY NAME : ");
                cname=in.readLine();
				System.out.println("NEW SALARY : ");
				salary=Integer.parseInt(in.readLine());
                sql="update employee set cname='"+cname +"' where eno="+eno;
				
                result=state.execute(sql);
				sql="update employee set salary='"+salary +"' where eno="+eno;
				result=state.execute(sql);
                if(result==true)
                    System.out.println("Record not updated");
                else
                    System.out.println("Record updated");
                break;

            case 4:
                sql="select * from employee";
                ResultSet results=state.executeQuery(sql);
                String text="";
                System.out.println("EMP NO\tNAME\tCOMPANY\tSALARY\tADDRESSn");
                while(results.next())
                {
                    text+=results.getString(1)+"\t"+results.getString(2)+"\t"+results.getString(3)+"\t"+results.getString(4)+"\t"+results.getString(5)+"\n";
                }
                System.out.println(text);
                break;
            case 5:
                sql="drop table employee";
                result=state.execute(sql);
                if(result==true)
                    System.out.println("Table not droped");
                else
                    System.out.println("Table droped");
                break;
            case 6:
                System.out.println("EMPLOYEE NUMBER : ");
                eno=Integer.parseInt(in.readLine());
                sql="delete from employee where eno="+ eno;
                result=state.execute(sql);
                if(result==true)
                    System.out.println("Record not deleted");
                else
                    System.out.println("Record deleted");
                break;
			case 7:
				System.out.println("EMPLOYEE NUMBER : ");
				eno=Integer.parseInt(in.readLine());
				sql="select * from employee where eno=" + eno;
                ResultSet results1=state.executeQuery(sql);
                String text1="";
                System.out.println("EMP NO\tNAME\tCOMPANY\tSALARY\tADDRESSn");
                while(results1.next())
                {
                    text1+=results1.getString(1)+"\t"+results1.getString(2)+"\t"+results1.getString(3)+"\t"+results1.getString(4)+"\t"+results1.getString(5)+"\n";
                }
                System.out.println(text1);
                break;
			}
        }
        }
        catch(SQLException e)
        {
            System.out.println("SQL Error");
        }
        catch(Exception e)
        {
            System.out.println("Error");
        }	
		
	
	}
}
