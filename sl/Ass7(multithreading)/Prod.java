import java.util.*;

class Queue
{
    int arr[],F,R,flag=0;
    Queue()
    {
        R=-1;
        F=-1;
        arr=new int[10];
    }
    boolean Empty()
    {
        if(F==R)
            return true;
        else
            return false;
    }
    boolean Full()
    {
	if(R==(F-1) || (F==0 && R==9) )   
            return true;
        else
            return false;
    }
    void push(int num)
    {       
        synchronized(this)
        {
            if(Full())
            {
               try
               {
                  System.out.println("Producer Waiting....");
               //   wait();             
               }
               catch(Exception e){  }
            }
            else
            {
               if(flag == 0)
               {
                   F=0;
                   flag=1;
                   R=0;
               }
               arr[R] = num;
               R=(R+1) % 10;
               System.out.println("Producer produces :-  "+num);
            //   notify();
            }
        }
    }
    int pop()
    {
        int num;   
        synchronized(this)
        { 
            num = 0;
            if(Empty())
            {   
                try
                {
                    System.out.println("Consumer waiting ...");
                    //wait();      
                }
                catch(Exception e){ }                           
            }
            else
            {
                num = arr[F];
                F=(F+1) % 10;
                System.out.println("Consumer consumes :-  "+num);
           	//try
            //    {
            //        notify();
            //    }
            //    catch(Exception e){ }        
            }        
            return num;        
        } 
    }
}
class Pro extends Thread        
{
    Queue q; 
    Pro(Queue qu)
    {
        q = qu;
    }
    public void run()
    {
        int i=1;
        while(true)
        {
            q.push(i++);
            if(i==35)
            {
                System.out.println("\nProducer is Closing.....\n");
                System.exit(0);
            }
        }
    }
}
class Cons extends Thread
{
    Queue q;
    Cons(Queue qu)
    {
        q = qu;
    }
    public void run()
    {
        int i,num;
        while(true)
            num = q.pop();
    }
}
public class Prod
{
    public static void main(String args[])
    {
        Queue q=new Queue();
        new Pro(q).start();
        new Cons(q).start();
    }
}