
#include<iostream.h>
#include<stdio.h>
#include<conio.h>
#include<fstream.h>
#include<string.h>
#include<stdlib.h>
#include<ctype.h>

 //structure for SYMBOL table
struct sym
{
char name[30],type[20],attr[30],val[10];
int addr;
}s;
 //structure for MOT table
struct mot
{
char mne[30],op1[10],op2[10],cls[10];
long hex;
int len;
}m;

 //structure for SEGMENT table
struct segtab
{
char name[30],cls[30];
int len;
}sg;

 //structure for Intermediate file
struct intfile
{
long hex;
char cls[10],op[20];
int lc;
}t;

class assemble
{
public:
char fname[30],ch;
ifstream f;
void read()
{
	cout<<"\t\t\tASSEMBLER\n";
	cout<<"--------------------------------------------------------\n";
	cout<<"ENTER FILE NAME : ";
	cin>>fname;
	cout<<"--------------------------------\n";
	cout<<"\nCONTENTS OF FILE :\n";
	cout<<"--------------------------------\n";
	f.open(fname,ios::in);
	ch=f.get();
	while(ch!=EOF)
	{
		cout<<ch;
		ch=f.get();
	}
	cout<<"\n-------------------------------\n\n";
	f.close();
}

void sep()
{
    int i=0,j,flag=0,k=0;
    char temp[30],mn[30]={'\0'},o1[10]={'\0'},o2[10]={'\0'},lab[30]={'\0'};
    ifstream f;
    ofstream fout;
    fout.open("intfile.txt",ios::out|ios::binary);
    t.lc=0;
	cout<<"\n-----------------------------------\n";
	cout<<"LABEL\tMNE\tOPERAND:1\tOPERAND:2\n";
	cout<<"-------------------------------------\n";
    f.open(fname,ios::in);
    ch=f.get();
    while(ch!=EOF)
    {
	if(ch=='.')
	   flag=1;
	ch=f.get();
	if(ch=='c'&&flag==1)  ///to check whether code seg is present or not
	    break;
	else
	    flag=0;
    }
    while(ch!='\n')
    {
	ch=f.get();	//skip the line ".code"
    }

    ch=f.get();
    while(ch!=EOF)
    {
	flag=0;
	i=0;
	while(ch!='\n')
	{
		temp[i]=ch;
		i++;
		if(ch==':')	 ///to check whether label is present or not
		    flag=1;
		if(ch==EOF)
		    break;
		ch=f.get();
	}
	j=0;
	if(flag==1)
	{
		for(j=0;temp[j]!=':'&&j<i;j++)
		{
			cout<<temp[j];
			lab[j]=temp[j];
		}
		lab[j+1]='\0';
		//inserting label into SYMBOL table
		ofstream f1;
		f1.open("symtab.txt",ios::app|ios::binary);
		strcpy(s.name,lab);
		strcpy(s.type,"LABEL");
		strcpy(s.attr,"Code");
		strcpy(s.val,"-");
		s.addr=t.lc;
		f1.write((char*)&s,sizeof(s));
		f1.close();
		j+=1;
	}
	if(j>=i)
	    goto aa;
	cout<<"\t";
	k=0;
	for(;temp[j]!=' '&&j<i;j++)
	{
	    cout<<temp[j];  	// getting mnemonic
	    mn[k++]=temp[j];
	}
	mn[k++]='\0';
	k=0;
	j++;
	cout<<"\t";
	for(;temp[j]!=','&&j<i;j++)
	{
	    cout<<temp[j];     ///getting operand1
	    o1[k++]=temp[j];
	}
	o1[k++]='\0';
	j++;
	cout<<"\t\t";
	k=0;
	for(;j<i;j++)
	{
	    cout<<temp[j];     ///getting operand2
	    o2[k++]=temp[j];
	}
	o2[k]='\0';
	//cout<<lab<<mn<<o2<<o1<<endl;
aa:
	cout<<"\n";
	fstream fin;
	fin.open("mot.txt",ios::in);
	fin.seekg(0,ios::end);
	int n=fin.tellg()/sizeof(m);
	int i=0,flag=0;
	while(i<n)
	{
	    fin.seekg(i*sizeof(m),ios::beg);
	    fin.read((char*)&m,sizeof(m));
	    if(strcmpi(m.mne,mn)==0)
	    {
		 //make entry in intermediate file....
		 //1
		 if(strcmpi(m.op1,o1)==0 && strcmpi(m.op2,o2)==0)
		 {
			strcpy(t.cls,m.cls);
			strcpy(t.op,"");
			t.hex=m.hex;
			fout.write((char*)&t,sizeof(t));
			flag=1;
			goto down;
		 }
		 //2
		 if(strcmpi(m.op1,o1)==0 && strcmpi(m.op2,"-")==0 )
		 {
		    if((strcmp(o2,"@data")==0 || o2[strlen(o2)-1]=='h'|| o2[strlen(o2)-1]=='H'))
		    {
		    strcpy(t.cls,m.cls);
		    strcpy(t.op,o2);
		    t.hex=m.hex;
		    fout.write((char*)&t,sizeof(t));
		    flag=1;
		    goto down;
		    }
		 }
		 //3
		 if(strcmpi(m.op1,o1)==0 && strcmpi(m.op2,"*")==0)
		 {
			strcpy(t.cls,m.cls);
			strcpy(t.op,o2);
			t.hex=m.hex;
			fout.write((char*)&t,sizeof(t));
			flag=1;
			goto down;
		 }

		 //4
		 if(strcmpi(m.op1,"*")==0 && strcmpi(m.op2,o2)==0)
		 {
			strcpy(t.cls,m.cls);
			strcpy(t.op,o1);
			t.hex=m.hex;
			fout.write((char*)&t,sizeof(t));
			flag=1;
			goto down;
		 }

		 //5
		 if(strcmpi(m.op1,o1)==0&&strcmpi(m.op2,"-")==0&&strlen(o2)<1)
		 {
		 strcpy(t.cls,m.cls);
		 strcpy(t.op,"");
		 t.hex=m.hex;
		 fout.write((char*)&t,sizeof(t));
		 flag=1;
		 goto down;
		 }

		 //6
		 if(strcmpi(m.op1,"-")==0&&strcmpi(m.op2,"-")==0 && strlen(o1)<1 && strlen(o2)<1)
		 {
		 strcpy(t.cls,m.cls);
		 strcpy(t.op,"");
		 t.hex=m.hex;
		 fout.write((char*)&t,sizeof(t));
		 flag=1;
		 goto down;
		 }

		 if(strlen(o2)<1 && (o1[1]!='x'||o1[1]!='h'||o1[1]!='l'))
		 {
		 strcpy(t.cls,m.cls);
		 strcpy(t.op,o1);
		 t.hex=m.hex;
		 fout.write((char*)&t,sizeof(t));
		 flag=1;
		 goto down;
		 }
		 }
		 i++;
	 }
	down:
	 if(flag==1)
		 t.lc+=m.len;
	 else
	 {
		cout<<"\nERROR : Unknown Instruction...\n";
		flag=0;
	 }
	 fin.close();

	ch=f.get();
}
	cout<<"--------------------------------------\n";
	f.close();
	fout.close();
	//inserting into SEGMENT table
	fout.open("segtab.txt",ios::app|ios::binary);
	fout.seekp(0,ios::end);
	strcpy(sg.name,"CODE");
	sg.len=t.lc;
	strcpy(sg.cls,"'Code'");       //adding CODE seg to SEGMENT table
	fout.write((char*)&sg,sizeof(sg));
	fout.close();

}

void createsyb()
{
	int i,flag=0,temp;
	s.addr=0;
	fstream fout;
	fout.open("symtab.txt",ios::out|ios::binary);
	f.open(fname,ios::in);
	ch=f.get();
	while(ch!=EOF)
	{
	    if(ch=='.')
		flag=1;
	    ch=f.get();             ///checking for DATA segment
	    if(ch=='d'&&flag==1)
		  break;
	    else
		  flag=0;
	}
	while(ch!='\n')      ////skip line ".data"
	    ch=f.get();

	ch=f.get();
	while(ch!='.')
	{
	    i=0;
	    while(ch!=' ')
	    {                  //getting name of variable
		s.name[i]=ch;
		i++;
		ch=f.get();
	   }
	   s.name[i++]='\0';
	   i=0;
	   ch=f.get();
	   while(ch!=' ')
	   {
		s.type[i]=ch;
		i++;            //getting data type of variable
		ch=f.get();
	   }
	   s.type[i++]='\0';
	   i=0;
	   ch=f.get();
	   while(ch!='\n')
	   {
		s.val[i]=ch; 	//getting value type of variable
		i++;
		ch=f.get();
	   }
	   s.val[i++]='\0';
	if(!strcmp(s.type,"db") || !strcmp(s.type,"DB"))
	{
		strcpy(s.type,"BYTE");
		temp=1;
	}
	if(!strcmp(s.type,"dw") || !strcmp(s.type,"DW"))
	{
		strcpy(s.type,"WORD");
		temp=2;
	}
	strcpy(s.attr,"Data");

	//cout<<s.name<<s.type<<s.addr<<s.attr<<endl;
	fout.write((char*)&s,sizeof(s));
	s.addr+=temp;
	ch=f.get();
	if(ch=='.')
	    goto aa; ///checking end of data segment...
	}
aa:
	f.close();
	fout.close();
	fout.open("segtab.txt",ios::app|ios::binary);    //adding seg to seg table
	fout.seekp(0,ios::end);
	strcpy(sg.name,"DATA");
	sg.len=s.addr+1;
	strcpy(sg.cls,"'Data'");
	fout.write((char*)&sg,sizeof(sg));
	fout.close();
}

void dispsyb()
{
int n,i;
fstream fin;
fin.open("symtab.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellp()/sizeof(s);
cout<<"\n\t\tSYMBOL TABLE\n";
cout<<"--------------------------------\n";
cout<<"NAME\tTYPE\tADDR\tATTR\tVAL\n";
cout<<"--------------------------------\n";
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(s),ios::beg);
fin.read((char*)&s,sizeof(s));
cout<<s.name<<"\t"<<s.type<<"\t";
printf("%#04d",s.addr);
cout<<"\t"<<s.attr<<"\t"<<s.val<<"\n";
}
fin.close();
cout<<"--------------------------------------------------------\n";
}

void dispseg()
{
int n,i;
fstream fin;
fin.open("segtab.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellg()/sizeof(sg);
cout<<"\n\t\tSEGMENT TABLE\n";
cout<<"--------------------------------------------------------\n";
cout<<"NAME\tLENGTH\tCLASS\n";
cout<<"--------------------------------------------------------\n";
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(sg),ios::beg);
fin.read((char*)&sg,sizeof(sg));
cout<<sg.name<<"\t";
printf("%#04d",sg.len);
cout<<"\t"<<sg.cls<<"\n";
}
fin.close();
cout<<"--------------------------------------------------------\n";
}

void getstack()
{
    fstream fout;
    int flag=0,l,i;
    char temp[10];
    f.open(fname,ios::in);
    ch=f.get();
    while(ch!=EOF)
    {
	if(ch=='.')
	    flag=1;
	ch=f.get();
	if(ch=='s'&&flag==1)
	   break;
	else
	   flag=0;
    }
    ch=f.get();
    while(ch!=' ')
    {
	ch=f.get();
    }
    ch=f.get();
    i=0;
    while(ch!='\n'&&ch!=' ')
    {
	 temp[i]=ch;
	 i++;
	 ch=f.get();
    }
	temp[i++]='\0';
	l=atoi(temp);
	fout.open("segtab.txt",ios::out|ios::binary);    //adding seg to seg table
	fout.seekp(0,ios::end);
	strcpy(sg.name,"STACK");
	sg.len=l;
	strcpy(sg.cls,"'Stack'");
	fout.write((char*)&sg,sizeof(sg));
	fout.close();
	f.close();
}

void showintfile()
{
cout<<"\n\t\tPASS-I  INT FILE\n";
cout<<"--------------------------------------------------------\n";
cout<<"LC\t(CLASS , HEX CODE)\tOP\n";
cout<<"--------------------------------------------------------\n";
//--------------------------showing data seg
int n,i;
fstream fin;
fin.open("symtab.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellp()/sizeof(s);
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(s),ios::beg);
fin.read((char*)&s,sizeof(s));
if(strcmp(s.type,"LABEL")!=0)
{
printf("%#04d",s.addr);
cout<<"\t"<<s.val<<"\n";
}
}
fin.close();

//--------------------------showing code seg

fin.open("intfile.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellg()/sizeof(t);
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(t),ios::beg);
fin.read((char*)&t,sizeof(t));
printf("%#04d\t(",t.lc);
cout<<t.cls<<" , ";
printf("%x )",t.hex);

if(isdigit(t.op[0]))
   cout<<"\t\t"<<"\n";
else
   cout<<"\t\t"<<t.op<<"\n";
}
fin.close();
cout<<"--------------------------------------------------------\n";
}
//--------------------------------------------------------------------
void pass2()
{
ifstream f2;
int n1,flag=0;
cout<<"\n\t\tPASS-II  \n";
cout<<"--------------------------------------------------------\n";
cout<<"LC\tHEX CODE\n";
cout<<"--------------------------------------------------------\n";
//--------------------------showing data seg
int n,i;
fstream fin;
fin.open("symtab.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellp()/sizeof(s);
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(s),ios::beg);
fin.read((char*)&s,sizeof(s));
if(strcmp(s.type,"LABEL")!=0)
{
printf("%#04d",s.addr);
cout<<"\t"<<s.val<<"\n";
}
}
fin.close();

//--------------------------showing code seg

fin.open("intfile.txt",ios::in|ios::binary);
fin.seekg(0,ios::end);
n=fin.tellg()/sizeof(t);
for(i=0;i<n;i++)
{
fin.seekg(i*sizeof(t),ios::beg);
fin.read((char*)&t,sizeof(t));
printf("%#04d\t",t.lc);
printf("%x\t",t.hex);

if(strcmp(t.op,"@data")==0)
{
	printf("0000 s\n");
    flag=1;
}
if(strcmp(t.op,"")!=0)
{
 f2.open("symtab.txt",ios::in|ios::binary);
 f2.seekg(0,ios::end);
 n1=f2.tellg()/sizeof(s);
 for(int j=0;j<n1;j++)
 {
   f2.seekg(j*sizeof(s),ios::beg);
   f2.read((char*)&s,sizeof(s));
if(strcmpi(t.op,s.name)==0)
{
itoa(s.addr,t.op,10);
printf("%#04d r\n",s.addr);
flag=1;
}
}
f2.close();
}
if(flag==0)
    cout<<t.op<<endl;
else
flag=0;
}
fin.close();
cout<<"--------------------------------------------------------\n";
}
};

void main()
{
clrscr();
assemble a;
a.read();
a.getstack();
a.createsyb();
getch();
clrscr();
a.sep();
//getch();
clrscr();
a.dispsyb();
getch();
a.dispseg();
getch();
a.showintfile();
getch();
a.pass2();
getch();
}
