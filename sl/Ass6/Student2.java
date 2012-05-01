import java.io.*;
import java.util.*;
import java.sql.*;

class bubble
{
    int n;
    bubble()
    {
        n=0;
    }
    void sort(Vector v)
    {
        n=v.size()-1;
        String tempname="\0",tempadd="\0",tempsubst="\0";
	int tempmarks=0,tempid=0,tempch=0;


	//n=v2.size()-1;

		
		for(int i=0;i<n;i++)
		{
			for(int j=0;j<n;j++)
			{
				
				Input obj1=(Input) v.elementAt(j);
				Input obj2=(Input) v.elementAt(j+1);
				
				if(obj1.mark<obj2.mark)
				{
					tempname=obj1.name;
					tempadd=obj1.address;
					tempch=obj1.choice;
					tempsubst=obj1.substream;
					tempmarks=obj1.mark;
                                        tempid=obj1.id;
                                        
					obj1.name=obj2.name;
					obj1.address=obj2.address;
					obj1.choice=obj2.choice;
					obj1.substream=obj2.substream;
					obj1.mark=obj2.mark;
                                        obj1.id=obj2.id;
					
					obj2.name=tempname;
					obj2.address=tempadd;
					obj2.choice=tempch;
					obj2.substream=tempsubst;
					obj2.mark=tempmarks;							
				}
	   		}
		}	
    }
    void show(Vector v,int m)
    {
        n=v.size();
        System.out.print("\nIndex\tSeat No\tName\tUniversity\tMarks\t stream\tSubstream ");
	System.out.print("\n======================================================================");
	String str=new String("");
        for(int i=0;i<n;i++)
	{			
		Input obj=(Input) v.elementAt(i);
                if(obj.choice==1)
                    str=new String("Engg");
                if(obj.choice==2)
                    str=new String("Medical");
		System.out.println("\n" + (i+1) + "\t" + obj.id + "\t" + obj.name + "\t" + obj.address + "\t\t" + obj.mark + "\t" + str + "\t" + obj.substream);			
                m--;
                if (m==0)
                    break;
        }
    }
}
class MyException extends Exception 
{
    private int marks;
    public MyException(int marks)
    {
        System.out.println("hello, You typed marks more than 200... Refill Entry!!");
    }
 /*   public String toString()
    {
       return "Marks cannot be more than 200 !!!" ;
    }*/
}

interface Info
{
    final int TOTAL=200;
    final int MAXMEDICAL=130;
    final int MAXENGG=100;
}
class Input implements Info
{
    int mark,id,choice,valid;
    String name,address,substream;
    DataInputStream in=new DataInputStream(System.in);
    Input()
    {
        mark=0;
        id=0;
        name=null;
        address=null;
        choice=0;
        substream=null;  
        valid=0;
    }
    void getInfo() throws Exception
    {
        try
        {
            System.out.println("Name:");
            name=in.readLine();
            System.out.println("Seat No:");
            id=Integer.parseInt(in.readLine());
            System.out.println("University:");
            address=in.readLine();
            System.out.println("CET mark");
            mark=Integer.parseInt(in.readLine());
            
        }
        catch(Exception e){}
        if(mark>200)
                throw new MyException(mark);
    }
    void getCh()
    {
         try
         {
             System.out.println("Choice (1.Engg / 2.Medical)");
             choice=Integer.parseInt(in.readLine());
         }
         catch(Exception e){}
         if(choice==1)
         {
             if(mark<MAXENGG)
                 System.out.println("Student is not Eligible For Engg");
             else
             {
                Engg obj1;
                obj1=new Engg();
                substream=obj1.getSub();
                valid=1;
                
             }
         }
         
         if(choice==2)
         {
             if(mark<MAXMEDICAL)
                 System.out.println("Student is not Eligible For medical");
             else
             {
                Medical obj2;
                obj2=new Medical();
                substream=obj2.getSub();
                valid=1;
             }
         }
    }
}

class Medical extends Input
{
    String sub;
    DataInputStream in2=new DataInputStream(System.in);
    Medical()
    {
        sub=null;
    }
    String getSub()
    {
        try
        {
            System.out.println("Enter Choice of Substream:");
            System.out.println("1.BFarm 2.MBBS 3.Dental");
            int ch;
            ch=Integer.parseInt(in2.readLine());
            if(ch==1)
                sub=new String("BFarm");
            if(ch==2)
                sub=new String("MBBS");
            if(ch==3)
                sub=new String("Dental");
        }
        catch(Exception e){}
        return sub;
    }
    
}

class Engg extends Input
{
    String sub;
    DataInputStream in1=new DataInputStream(System.in);
    Engg()
    {
        sub=null;
    }
    String getSub()
    {
        try
        {
            System.out.println("Enter Choice of Substream:");
            System.out.println("1.Comp 2.IT 3.EnTC");
            int ch;
            ch=Integer.parseInt(in1.readLine());
            if(ch==1)
                sub=new String("Comp");
            if(ch==2)
                sub=new String("IT");
            if(ch==3)
                sub=new String("EnTC");
        }
        catch(Exception e){}
        return sub;
    }
}
public class Student
{
    public static void main(int x)
	{
		 System.out.println("More? (1.Yes / 2.No)");
		}
	public static void main(String[] args)
    {
        Input obj;
        String str;
        str=null;
        int ch = 0,n = 0;
        DataInputStream in3=new DataInputStream(System.in);
        Vector vAll=new Vector();
        Vector vMedical=new Vector();
        Vector vEngg=new Vector();
        Vector vEntc=new Vector();
        Vector vIT=new Vector();
        Vector vComp=new Vector();
        do
        {
            try
            {
            obj=new Input();
            obj.getInfo();
            obj.getCh();
            if(obj.valid==1)
            {
                vAll.add(obj);
                if(obj.choice==1)
                    vEngg.add(obj);
                if(obj.choice==2)
                    vMedical.add(obj);
            }
            System.out.println("More? (1.Yes / 2.No)");
            ch=Integer.parseInt(in3.readLine());
            }
            catch(Exception e){}
        }while(ch!=2);
        n=vAll.size();
	System.out.print("\n\nLIST OF ALL ELIGIBLE STUDENTS (Medical & Engg.) ");
	System.out.print("\nIndex\tSeat No\tName\tUniversity\tMarks\t stream\tSubstream ");
	System.out.print("\n======================================================================");
		
	for(int i=0;i<n;i++)
	{			
		obj=(Input) vAll.elementAt(i);
                if(obj.choice==1)
                    str=new String("Engg");
                if(obj.choice==2)
                    str=new String("Medical");                
		System.out.println("\n" + (i+1) + "\t" + obj.id + "\t" + obj.name + "\t" + obj.address + "\t\t" + obj.mark + "\t" + str + "\t" + obj.substream);			
	}
        int cutComp=0,cutIT=0,cutEntc=0;
        
        try 
        {
        System.out.println("Enter Number of students for Engg:");
        System.out.println("Comp:");
        cutComp=Integer.parseInt(in3.readLine());
        System.out.println("IT:");
        cutIT=Integer.parseInt(in3.readLine());
        System.out.println("EnTC:");
        cutEntc=Integer.parseInt(in3.readLine());
        }
        catch(Exception e){}
        
        n=vEngg.size();
        for(int i=0;i<n;i++)
        {
            obj=(Input)vEngg.elementAt(i);
            if(obj.substream.equals("Comp"))
                    vComp.add(obj);
            if(obj.substream.equals("IT"))
                    vIT.add(obj);
            if(obj.substream.equals("EnTC"))
                    vEntc.add(obj);
        }
        bubble b;
        b=new bubble();
        b.sort(vComp);
        b.sort(vIT);
        b.sort(vEntc);
        System.out.println("Allotment at Comp Dept");
        b.show(vComp,cutComp);
        System.out.println("Allotment at IT Dept");
        b.show(vIT,cutIT);
        System.out.println("Allotment at Entc Dept");
        b.show(vEntc,cutEntc);
    }
}