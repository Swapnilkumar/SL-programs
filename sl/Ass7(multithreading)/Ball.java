import java.util.*;
import java.awt.*;

public class Ball
{
    public static void main(String args[])
    {
        new MyFrame();
    }
}

class MyFrame extends Frame implements Runnable
{
    Thread r1,r2;
    int x1,y1,x2,y2;
    int f1,f2;
    public MyFrame() 
    {
        super();
        r1=new Thread(this,"one");
        r2=new Thread(this,"two");
        x1=100;
        x2=200;
        y1=y2=400;
        f1=f2=0;
        setVisible(true);
        r1.start();
        r2.start();
    }
    public void run()
    {
        while(true)
        {
        if(Thread.currentThread()==r1)
        {
            if(f1==0)
                y1--;
            else
                y1++;
            if(y1==50)
                f1=1;
            if(y1==400)
                f1=0;
            repaint();
            try
            {
                r1.sleep(10);
            }
            catch(Exception e){}
                    
        }
        if(Thread.currentThread()==r2)
        {
            if(f2==0)
                y2--;
            else
                y2++;
            if(y2==50)
                f2=1;
            if(y2==400)
                f2=0;
            repaint();
            try
            {
                r2.sleep(5);
            }
            catch(Exception e){}
            
        }
        }
    }
    public void paint(Graphics g)
    {
        g.drawArc(x1, y1, 30, 30, 0, 360);
        g.drawArc(x2, y2, 30, 30, 0, 360);
    }
    
}