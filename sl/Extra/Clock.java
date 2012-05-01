import java.awt.*;
import java.util.*;
import java.io.*;
import java.awt.event.*;

class Clock extends Frame implements Runnable
{
    Thread hr,min,sec;
    int h,m,s;
    
    public static void main(String args[])
    {
        Clock cl=new Clock();
        cl.setVisible(true);
        cl.setSize(300,200);
    }

    Clock()
    {
        
        Date d=new Date();
        hr=new Thread(this);
        min=new Thread(this);
        sec=new Thread(this);
        h=d.getHours()-1;
        m=d.getMinutes()-1;
        s=d.getSeconds()-1;
        hr.start();
        min.start();
        sec.start();
    }
    public void run()
    {
        while(true)
        {
            if(Thread.currentThread()==hr)
            {
                h++;
                if(h==24)
                    h=0;
                repaint();
                try
                {
                    hr.sleep(1000*60*60);
                }
                catch(Exception e){}
                
            }
            if(Thread.currentThread()==min)
            {
                m++;
                if(m==60)
                {
                    m=0;
                }
                repaint();
                try
                {
                    min.sleep(1000*60);
                }
                catch(Exception e){}
            }
            if(Thread.currentThread()==sec)
            {
                s++;
                if(s==60)
                {
                    s=0;
                    
                }
                repaint();
                try
                {
                    sec.sleep(1000);
                }
                catch(Exception e){}
            }
        }
    }
    public void paint(Graphics g)
    {
       g.drawString(h + ":" + m + ":" + s, 100, 100);
    }
}