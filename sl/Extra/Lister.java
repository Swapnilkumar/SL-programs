import java.awt.*;
import java.applet.*;
import java.awt.event.*;

/* <applet code="Lister.class" height=400 width=300>
 </applet>*/

public class Lister extends Applet implements ActionListener
{
	
	
	List list1,list2; 
	Button ok;
	CheckboxGroup gr;
	Checkbox a,b,c,d,e;
    String pr;
	public void init()
    {
    	list1=new List(15);
		list2=new List(15);
		
		list1.addItem("hello");
		list1.addItem("bye");
		list1.addItem("Laptop");
		list1.addItem("Monkey");
		list1.addItem("sure");
		list1.addItem("Pune");
		list1.addItem("Train");
		list1.addItem("Killer");
		add(list1);
		list2.addItem("rahul");
		list2.addItem("Null");
		add(list2);
		gr=new CheckboxGroup();
		a=new Checkbox("move",gr,true);
		b=new Checkbox("move All",gr,false);
		c=new Checkbox("display Selected",gr,false);
		d=new Checkbox("delete",gr,false);
		e=new Checkbox("clear List2",gr,false);
		add(a);
		add(b);
		add(c);
		add(d);
		add(e);
		ok=new Button("OK");
		add(ok);

		ok.addActionListener(this);
    }
	public void actionPerformed(ActionEvent ae)
	{
		int no;
		try
		{
			String str;
			Checkbox f=gr.getSelectedCheckbox();
			str=f.getLabel();
			if(str.equals("move"))
				list2.addItem(list1.getSelectedItem());
			if(str.equals("move All"))
			{
				int n=list1.getItemCount();
				int i=0;
				while(i<n)
				{
					list2.addItem(list1.getItem(i));
					i++;
				}
			}
			if(str.equals("display Selected"))
				pr=list1.getSelectedItem();
			if(str.equals("delete"))
				list1.delItem(list1.getSelectedIndex());
			if(str.equals("clear List2"))
				list2.clear();
		}
		catch(Exception e)
		{
		}
		repaint();
	}
    public void paint(Graphics g)
    {
		g.drawString(pr,100,380);
    }
}