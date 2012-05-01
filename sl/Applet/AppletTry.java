import java.applet.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

/*
<applet code="AppletTry" height=350 width=350>
</applet>
*/

public class AppletTry extends Applet implements ActionListener
{
	TextField t1,t2,t3;
	CheckboxGroup cbg;
	Checkbox cp,ci,cb;
	Label l1,l2,l3,lrad,lcomb;
	Button set;
	JComboBox jcc;

	String str="";				// string to be displayed
	
	Font f;
	int size,style;
	String name,color;
	int rc,gc,bc;			// store RGB values
	Color c;
	
	public void start()
	{
		setLayout(null);

	// text-boxes n their labels
		l1= new Label("ENTER TEXT: ");
		t1= new TextField(15);
		l2= new Label("FONT SIZE: ");
		t2= new TextField(15);	
		l3= new Label("COLOR (R-G-B): ");
		t3= new TextField(15);

		add(l1);
		add(t1);
		add(l2);
		add(t2);
		add(l3);
		add(t3);

		l1.setBounds(10,50,110,20);
		t1.setBounds(120,50,120,20);
		l2.setBounds(10,80,110,20);
		t2.setBounds(120,80,50,20);		
		l3.setBounds(10,110,110,20);
		t3.setBounds(120,110,120,20);

	// Radio Buttons
		lrad= new Label("CHOOSE STYLE: ");
		cbg= new CheckboxGroup();
		cp= new Checkbox("Plain",cbg,false);
		ci= new Checkbox("Italics",cbg,false);
		cb= new Checkbox("Bold",cbg,false);	

		add(lrad);
		add(cp);
		add(ci);
		add(cb);

		lrad.setBounds(10,140,70,20);
		cp.setBounds(10,160,50,30);
		ci.setBounds(80,160,50,30);
		cb.setBounds(150,160,50,30);

	// Combo Box

		lcomb= new Label("Select Font Type: ");
		lcomb.setBounds(10,200,120,20);
		jcc= new JComboBox();
		jcc.addItem("Times New Roman");
		jcc.addItem("Arial");
		jcc.addItem("Comic Sans MS");
		jcc.addItem("Calibri");
		jcc.addItem("Courier New");
		jcc.addItem("Lucida Calligraphy");
		jcc.addItem("Monotype Corsiva");
		jcc.addItem("Verdana");
		add(jcc);
		add(lcomb);
		jcc.setBounds(10,230,120,30);

	//Button
		set= new Button("SET");
		add(set);
		set.setBounds(250,250,40,30);
		set.addActionListener(this);
	}

	public void actionPerformed(ActionEvent ae)
	{

		try								// try-catch block is written if string goes empty
		{
					
		// string to be displayed
			str=t1.getText();			
		
		// string size
			size=Integer.parseInt(t2.getText());			
		
		// string color
			color=t3.getText();						
			String s1="",s2="",s3="";
			char ch;
			int cnt=0;
	
			for(int i=0;i<color.length();i++)
			{
				ch=color.charAt(i);
				if(ch=='-')
				{
					cnt++;
					i++;
				}

				if(cnt==0)
				{
					s1= s1 + color.charAt(i);
				}
				
				if(cnt==1)
				{
					s2= s2 + color.charAt(i);
				}

				if(cnt==2)
				{
					s3= s3 + color.charAt(i);
				}						
			}

			rc=Integer.parseInt(s1);
			gc=Integer.parseInt(s2);
			bc=Integer.parseInt(s3);		

		// string style
			Checkbox c=cbg.getSelectedCheckbox();
			String s= c.getLabel();

			if(s.equals("Plain"))
			{
				style=Font.PLAIN;
			}
		
			if(s.equals("Italics"))
			{
				style=Font.ITALIC;
			}

			if(s.equals("Bold"))
			{
				style=Font.BOLD;	
			}

		// string font type
			name= (String) jcc.getSelectedItem();
				
			repaint();		
		}

		catch (Exception e)
		{
			System.err.println(e);
		}

	}

	public void paint(Graphics g)
	{
		g.drawLine(0,40,300,40);
		
		f=new Font(name,style,size);
		c=new Color(rc,gc,bc);
		g.setColor(c);
		g.setFont(f);

		g.drawString(str,10,20);		
	}
}
