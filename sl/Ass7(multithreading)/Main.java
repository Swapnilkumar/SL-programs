/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//package prodcost;

class Stack1
{
    int st[]=new int[10];
    int top=0;
    boolean m=false;
    synchronized void push(int n)
    {
        if(m)
            try
            {
             wait();
            }catch(InterruptedException e)
            {
                 System.out.println("THREAD IS INTERUPPTED");
            }
         this.st[top++]=n;
         System.out.println("Pushed Element-"+ n);
            m=true;
         notify();
      


    }
    synchronized int get()
    {
        int n;
        int i=3;
        if(!m)
            try{
                wait();
            }catch(InterruptedException e)
            {
                 System.out.println("THREAD IS INTERUPPTED");
            }
          n=this.st[--top];
          System.out.println("Poped Element-"+ n);
          m=false;
          notify();
        return n;
    }
}
class Consumer implements Runnable
{
   Stack1 q;
   int n;
   Consumer(Stack1 q)
   {
       this.q=q;
       new Thread(this,"consum").start();
   }

    public void run() {
        while(true)
        {
          q.get();
        }
        
    }

}
class Producer implements Runnable
{
   Stack1 q;
   int i=3;
    Producer(Stack1 q)
    {
      this.q=q;
      new Thread(this,"produ").start();
    }
    public void run() {
        while(i<200)
        {
          q.push(i++);
        }
        
    }

}
/**
 *
 * @author PICT
 */
public class Main {


    public static void main(String[] args) {
       Stack1 q=new Stack1();
       new Producer(q);
       new Consumer(q);



        // TODO code application logic here
    }

}
