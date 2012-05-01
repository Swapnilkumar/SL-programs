import java.awt.*;
import java.applet.*;
import java.awt.event.*;

/* <applet code="Applets.class" height=500 width=500>
 </applet>*/

public class Applets extends Applet implements ActionListener
{
	//Declare text fields
    TextField text1,text2;
	String str="add";
	String str1="check";
	String name="";
	//Declare Command Button
	Button addition;
	
	//Declare for check box
	CheckboxGroup gr;
	Checkbox a,b,c;
	
	//Declare for combo box
	Choice ft;
	
	
	Font f;
	Color c1;
    
	public void init()
    {
        //TEXT box and BUTTON
		text1=new TextField(8);
		text2=new TextField(8);
		addition=new Button("ADD");
		add(text2);
        add(text1);
		add(addition);
		text2.setText("0");
		text1.setText("0");

		//Check box
		gr=new CheckboxGroup();
		a=new Checkbox("1st",gr,true);
		b=new Checkbox("2nd",gr,false);
		c=new Checkbox("3rd",gr,false);
		
		add(a);
		add(b);
		add(c);
		
		//Combo box
		ft=new Choice();
		ft.add("dhiraj");
		ft.add("vishal");
		ft.add("mohan");
		ft.add("Rahul");
		
		add(ft);
		
		addition.addActionListener(this);
    }
	public void actionPerformed(ActionEvent ae)
	{
		int no;
		try
		{
		
		//Get text from text box
		no=Integer.parseInt(text1.getText())+Integer.parseInt(text2.getText());
		str="Addition is "+ no;
		
		//get selected radio button
		Checkbox d=gr.getSelectedCheckbox();
		str1=d.getLabel();
		
		//get select option from combo box
		name=ft.getSelectedItem();
		}
		catch(Exception e)
		{
			str="Enter Valid number";
		}
		repaint();
	}
    public void paint(Graphics g)
    {
        c1=new Color(255,0,0);
		f=new Font("comic sans ms",Font.BOLD,30);
		g.setFont(f);
		g.setColor(c1);
		g.drawString(str,20,100);    
		g.drawString(str1,20,200);
		g.drawString(name,20,400);
    }
}