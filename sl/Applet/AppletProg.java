import java.awt.*;
import java.awt.event.*;
import java.applet.*;

/*<applet code=AppletProg height=400 width=300>
</applet>
*/

public class AppletProg extends Applet implements ItemListener,ActionListener
{
String font_style,font_type,font_color;
int font_size,f_t;
Checkbox bold,italics,plain;
CheckboxGroup fs;
Choice ft,fc;
TextField fsize,t;
Font f;

//------------------------------------------------------------------

public void init()
{
font_size=12;
f_t=Font.PLAIN;
font_color="Red";

fs=new CheckboxGroup();
bold=new Checkbox("Bold",fs,true);
italics=new Checkbox("Italics",fs,false);
plain=new Checkbox("Plain",fs,false);
ft=new Choice();
fc=new Choice();
fsize=new TextField(2);
t=new TextField(10);
f=new Font("Dialog",Font.PLAIN,12);

Label Style=new Label("Style : ");
Label size=new Label("Size : ");
Label type=new Label("Font Type : ");
Label fcolor=new Label("Color : ");


add(Style);
add(bold);
add(italics);
add(plain);
add(size);
add(fsize);
setFont(f);

add(type);
ft.add("Dialog");
ft.add("SansSerif");
ft.add("Serif");
ft.add("Monospaced");

ft.select("Dialog");
add(ft);

add(fcolor);
fc.add("Red");
fc.add("Blue");
fc.add("Cyan");

ft.select("Blue");
add(fc);

add(t);

bold.addItemListener(this);
italics.addItemListener(this);
plain.addItemListener(this);
ft.addItemListener(this);
fc.addItemListener(this);
fsize.addActionListener(this);
t.addActionListener(this);
}

//------------------------------------------------------------------

public void itemStateChanged(ItemEvent ie)
{
font_type=ft.getSelectedItem();
font_color=fc.getSelectedItem();
font_style=fs.getSelectedCheckbox().getLabel();
if(font_style=="Bold")
{
f_t=Font.BOLD;
}
else if(font_style=="Italics")
{
f_t=Font.ITALIC;
}
else
{
f_t=Font.PLAIN;
}
repaint();
}

public void actionPerformed(ActionEvent ae)
{
font_size=Integer.parseInt(fsize.getText());
repaint();
}

//------------------------------------------------------------------

public void paint(Graphics g)
{
if(font_color=="Red")
t.setForeground(Color.red);
if(font_color=="Blue")
t.setForeground(Color.blue);
if(font_color=="Cyan")
t.setForeground(Color.cyan);

f=new Font(font_type,f_t,font_size);
t.setFont(f);

}

//------------------------------------------------------------------
}
