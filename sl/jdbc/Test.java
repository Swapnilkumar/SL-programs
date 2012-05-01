import java.sql.*;
import java.io.*;
public class Test
{
    public static void main(String[] args) 
    {
    	String str,name,addr,phone;
    	int ch,id,amt,lid,ch1;
    	ResultSet rs;
       do
       {
        System.out.println ("\n\nEnter your choice\n 1: create a bank database");  
        System.out.println (" 2: retrive\n 3: insert\n 4: delete \n 5:update");
        System.out.println (" 6: search\n 7: exit");
        try
        {
        	BufferedReader br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	ch=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid choice");
        	ch=0;
       	}
         
         try 
         { 
         
        Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
        //System.out.println ("Done!!");
		String dbURL="jdbc:odbc:dhiraj";
        Connection con=DriverManager.getConnection(dbURL);
        Statement s=con.createStatement();
        
        switch(ch)
        {
        //MAIN CASE 1
        	case 1:
        	s.execute("drop table Customerc");
        	s.execute("drop table Employeec");
        	s.execute("drop table Accountc");
        	s.execute("drop table Loanc");
       	 	s.executeUpdate("create table Customerc(id int(3), name char(50), phone_no char(15), address char(50))"); 
        	s.executeUpdate("create table Employeec(id int(3), name char(50), phone_no char(15), address char(50))"); 	
        	s.executeUpdate("create table Loanc(id int(3), loan char(50),amount int(6))"); 
        	s.executeUpdate("create table Accountc( id int(3),account int(6),amount int(6))"); 	
        	System.out.println ("Following Tables Created..");
			System.out.println("1. Customer");
			System.out.println("2. Employee");
			System.out.println("3. Loan ");
			System.out.println("4. Account");
        	s.close(); 
       		con.close(); 
        	break;
        	//MAIN CASE 2
        	case 2:
        	System.out.println ("Retrive from table??\n 1:Customer\n 2: Employee\n 3:Loan\n 4: Account");
    		BufferedReader br=new BufferedReader(new InputStreamReader(System.in));
    		try{
    		ch1=Integer.parseInt(br.readLine());
    		}
    		catch(Exception e)
    		{	ch1=0;}
    		switch (ch1)
    		{
    			case 1:
      		s.executeQuery("select * from Customerc"); 
        	rs = s.getResultSet(); 
        	if (rs != null) 
        	while ( rs.next() )
        {
        		System.out.println ("\n\nData form customer");
                System.out.print("Customer id: " + rs.getString(1) );
                System.out.print(" Customer name: " + rs.getString(2) );
                System.out.print(" Customer phone number: " + rs.getString(3) );
                System.out.print(" Customer Address: " + rs.getString(4) );
        }
        break;
        case 2:
        //s.execute("drop table TEST12345");
        s.executeQuery("select * from Employeec"); 
       rs = s.getResultSet(); 
        if (rs != null) 
        while ( rs.next() )
        {
        		System.out.println ("\n\nData from Employee");
                System.out.print("Employee ID: " + rs.getString(1) );
                System.out.print(" Employee name: " + rs.getString(2) );
                System.out.print(" Employee Phone number: " + rs.getString(3) );
                System.out.print(" Employee Address: " + rs.getString(4) );
        }
        break;
        case 3:
        s.executeQuery("select * from Loanc"); 
        rs = s.getResultSet(); 
        if (rs != null) 
        while ( rs.next() )
        {		System.out.println ("\n\nData from Loan");
                System.out.print("Custimer ID: " + rs.getString(1) );
                System.out.print(" Loan ID: " + rs.getString(2) );
                System.out.print(" Loan Amount: " + rs.getString(3) );
        }
        break;
        case 4:
          s.executeQuery("select * from Accountc"); 
        rs = s.getResultSet(); 
        if (rs != null) 
        while ( rs.next() )
        {
        		System.out.println ("\n\nData form Account");
                System.out.print("Customer ID: " + rs.getString(1) );
                System.out.print(" Account ID: " + rs.getString(2) );
                System.out.print(" Account Amount: " + rs.getString(3) );
        }     
        break;
        default:
        	System.out.println ("Enter a valid Choice");
        	break;
    }
        s.close(); 
        con.close(); 
        break;
    //MAIN CASE 3    
        case 3:
        System.out.println ("Insert into table??\n 1:Customer\n 2: Employee\n 3:Loan\n 4: Account");
    	 br=new BufferedReader(new InputStreamReader(System.in));
    		try{
    		ch1=Integer.parseInt(br.readLine());
    		}
    		catch(Exception e)
    		{	ch1=0;}
    		switch (ch1)
    		{
    			case 1:
       		 System.out.println ("Enter customer details::\n Customer id");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
      	}
        System.out.println ("Customer name:");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	name=br.readLine();
    	}
        catch(Exception e)
        {
        	name=" ";
    	}
    	System.out.println ("Phone Number:");
    	try	
    	{
         br=new BufferedReader(new InputStreamReader(System.in));
        	phone=br.readLine();
        }
        catch(Exception e)
        {
          	phone=""; 
        }
        System.out.println ("Address:");
        try
        {
        	 br=new BufferedReader(new InputStreamReader(System.in));
        	addr=br.readLine();
    	}
        catch(Exception e)
        {
        	addr=" ";
    	}	
    	s.executeUpdate("insert into Customerc values("+id+",'"+name+"','"+phone+"','"+addr+"')");
    	break;
    	
    	case 2:
    	
    	System.out.println ("Enter Employee details::\n Customer id");
        try
        {
        	 br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
      	}
        System.out.println ("Employee name:");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	name=br.readLine();
    	}
        catch(Exception e)
        {
        	name=" ";
    	}
    	System.out.println ("Phone number:");
    	try	
    	{
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	phone=str;
        }
        catch(Exception e)
        {
          	phone ="";
        }
        System.out.println ("Address:");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	addr=br.readLine();
    	}
        catch(Exception e)
        {
        	addr=" ";
    	}	
    	s.executeUpdate("insert into Employeec values("+id+",'"+name+"','"+phone+"','"+addr+"')");
    	break;
    	case 4:
    	System.out.println ("Enter Account Details:\n Customer Id");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
      	}
      	
      	System.out.println ("Account Id");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	lid=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	lid=Integer.parseInt(str);
      	}
    	     	
    	System.out.println ("Amount");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	amt=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	amt=Integer.parseInt(str);
      	}     	
      	s.executeUpdate("insert into Accountc values("+id+","+lid+","+amt+")");
      	break;
      	case 3:
      	System.out.println ("Enter Loan Details:\n Customer Id");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
      	}
      	
      	System.out.println ("Account Id");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	lid=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	System.out.println ("Enter a valid id");
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	lid=Integer.parseInt(str);
      	}
    	     	
    	System.out.println ("Amount");
    	try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	amt=Integer.parseInt(str);
        }
        catch(Exception e)
        {
        	amt=Integer.parseInt(str);
      	}     	
      	
      		s.executeUpdate("insert into Loanc values("+id+","+lid+","+amt+")");
      		break;
      		default:
      		System.out.println ("Enter a valid Choice");
      		break;
      }
      	s.close(); 
        con.close();
        break;        
 //MAIN CASE 4       
        case 4:
        System.out.println ("Delete from table??\n 1:Customer\n 2: Employee\n 3:Loan\n 4: Account");
    		br=new BufferedReader(new InputStreamReader(System.in));
    		try{
    		ch1=Integer.parseInt(br.readLine());
    		}
    		catch(Exception e)
    		{	ch1=0;}
    		switch (ch1)
    		{
    			case 1:
        //delete from customer
        System.out.println ("Delete from customer table");
        System.out.println ("enter the customer id:\n Enter 0 for not deleting");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
    	}
    	catch (Exception e)
    	{	id=0;}
    	if(id!=0)
    		s.executeUpdate("Delete from Customerc where id="+id);
    		break;
    		case 2:
    		System.out.println ("Delete from Employee table");
        System.out.println ("enter the Employee id:\n Enter 0 for not deleting");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
    	}
    	catch (Exception e)
    	{	id=0;}
    	if(id!=0)
    		s.executeUpdate("Delete from Employeec where id="+id);
    		break;
    		case 4:
    	             
        	System.out.println ("Delete from Account table");
        System.out.println ("enter the Account id:\n Enter 0 for not deleting");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
    	}
    	catch (Exception e)
    	{	id=0;}
    	if(id!=0)
    		s.executeUpdate("Delete from Accountc where account="+id);
    		break;
    		case 3:
    		System.out.println ("Delete from Loan table");
        System.out.println ("enter the Loan id:\n Enter 0 for not deleting");
        try
        {
        	br=new BufferedReader(new InputStreamReader(System.in));
        	str=br.readLine();
        	id=Integer.parseInt(str);
    	}
    	catch (Exception e)
    	{	id=0;}
    	if(id!=0)
    		s.executeQuery("Delete from Loanc where loan="+id);
    		break;
    		default:
    		System.out.println ("Enter a valid Choice");
    		break;
    }
    		s.close(); 
        con.close();
    	break;
    	
 //MAIN CASE 5   	
    	case 5:
    	System.out.println ("Update from table??\n 1:Customer\n 2: Employee\n 3:Loan\n 4: Account");
    	br=new BufferedReader(new InputStreamReader(System.in));
    	try{
    	ch1=Integer.parseInt(br.readLine());
    	}
    	catch(Exception e)
    	{	ch1=0;}
    		switch (ch1)
    		{
    			case 1:
    				System.out.println ("Enter Customer ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				{
    					System.out.println ("Enter the name");
    					name=br.readLine();
    					System.out.println ("Phone number");
    					try{phone=br.readLine();}	
    					catch(Exception e){phone="";}	
    					System.out.println ("Address");
    					addr=br.readLine();
    					s.executeUpdate("update Customerc set name='"+name+"'where id="+id);
    					s.executeUpdate("update Customerc set phone_no= '"+phone+"' where id= "+id);
    					s.executeUpdate("update Customerc set address='"+addr+"'where id="+id);	
    			}
    			break;
    			
    			case 2:
    			System.out.println ("Enter Employee ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				{
    					System.out.println ("Enter the name");
    					name=br.readLine();
    					System.out.println ("Phone number");
    					try{phone=br.readLine();}	
    					catch(Exception e){phone="";}	
    					System.out.println ("Address");
    					addr=br.readLine();
    					s.executeUpdate("update Employeec set name='"+name+"'where id="+id);
    					s.executeUpdate("update Employeec set phone_no='"+phone+" 'where id= "+id);
    					s.executeUpdate("update Employeec set address='"+addr+"'where id="+id);	
    			}
    			break;
    			case 3:
    				System.out.println ("Enter Loan ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				{
    					System.out.println ("amount");
    					try{amt=Integer.parseInt(str=br.readLine());}	
    					catch(Exception e){amt=0;}
    					s.executeUpdate("update Loanc set amount="+amt+" where loan= "+id);
    				}	
    				break;
    				
    			case 4:
    			System.out.println ("Enter Account ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				{
    					System.out.println ("amount");
    					try{amt=Integer.parseInt(str=br.readLine());}	
    					catch(Exception e){amt=0;}
    					s.executeUpdate("update Accountc set amount="+amt+" where account= "+id);
    				}	
    				break;
    				default:
    				System.out.println ("Enter a valid choice");
    				break;
    			
    		}
    
    	break;
    	
  //MAIN CASE 6
    	case 6:
    		System.out.println ("Seach from \n 1: Customer \n 2: Employee \n 3: Loan \n 4: Account");
    		br=new BufferedReader(new InputStreamReader(System.in));
    		try{ch1=Integer.parseInt(br.readLine());}
    		catch (Exception e)
    		{ ch1=0;}
    		switch(ch1)
    		{
    			case 1:
    			System.out.println ("Enter Customer ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				s.executeQuery("Select * from Customerc where id= "+id);
    				rs=s.getResultSet();
    				if(rs!=null)
    			{while(rs.next())
    				{System.out.println ("\nData form customer");
                	System.out.print("Customer id: " + rs.getString(1) );
                	System.out.print(" Customer name: " + rs.getString(2) );
                	System.out.print(" Customer phone number: " + rs.getString(3) );
                	System.out.print(" Customer Address: " + rs.getString(4) );
            	}}
            break;
            case 2:
            System.out.println ("Enter Employee ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				s.executeQuery("Select * from Employeec where id= "+id);
    				rs=s.getResultSet();
    				if(rs!=null)
    			{
    				while(rs.next())
    			{	System.out.println ("\nData form Employee");
                System.out.print("Employee id: " + rs.getString(1) );
                System.out.print(" Employee name: " + rs.getString(2) );
                System.out.print(" Employee phone number: " + rs.getString(3) );
                System.out.print(" Employee Address: " + rs.getString(4) );
            }}
    			break;
    			
    		case 3:
    		System.out.println ("Enter Loan ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				s.executeQuery("Select * from Loanc where loan= "+id);
    				rs=s.getResultSet();
    				if(rs!=null)
    			{	while(rs.next())
    				{System.out.println ("\nData form Loan");
               		System.out.print("Customer id: " + rs.getInt(1) );
                	System.out.print(" Loan ID: " + rs.getInt(2) );
                	System.out.print(" Loan Amount: " + rs.getString(3) );
            }}
                break;
                case 4:
               		 System.out.println ("Enter Account ID");
    				try{id=Integer.parseInt(str=br.readLine());}
    				catch(Exception e){id=0;}
    				if(id!=0)
    				s.executeQuery("Select * from Accountc where account= "+id);
    			 rs=s.getResultSet();
    				if(rs!=null)
    				{while(rs.next())
    				{System.out.println ("\nData form Account");
                	System.out.print("Customer id: " + rs.getString(1) );
                	System.out.print(" Account ID: " + rs.getString(2) );
                	System.out.print(" Account Amount: " + rs.getString(3) );
            		}}
                break;
    }
    	break;
   	 	    	   	   		
        }
    }
     catch (Exception err) {
        System.out.println( "Error: " + err );
    }
    }while(ch!=7);
}
}
