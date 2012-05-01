#include<stdio.h>
#include<conio.h>
#include<iostream.h>
#include<fstream.h>
#include<stdlib.h>
#include<string.h>
#include<ctype.h>
char filename[30];
struct segtable
{
	char name[30],cls[30];
	int len;
}sg;
struct symtable
{
	char name[30],type[30],attr[30],val[30];
	int addr;
}sym;
struct mot
{
	char mne[30],op1[10],op2[10],cls[10];
	long hex;
	int len;
}m;
struct intfile
{
	char cls[30],op[30];
	int lc,hex;
}t;
void stack()
{
	fstream f;
	fstream fout;
	f.open(filename,ios::in||ios::out);
	char c,temp[10];
	while(1)
	{
		f.get(c);
		if(c=='.')
		{
			f.get(c);
			if(c=='s' || c=='S')
			{
				while(c!=' ')
					f.get(c);
				while(c==' ')
					f.get(c);
				int t=0;
				do
				{
					temp[t++]=c;
					f.get(c);
				}while(c!=' ' && c!='\n');
				temp[t]='\0';
				sg.len=atoi(temp);
				fout.open("segment.txt",ios::out|ios::binary);
				fout.seekp(0,ios::end);
				strcpy(sg.name,"STACK");
				strcpy(sg.cls,"'stack'");
				fout.write((char*)&sg,sizeof(sg));
				fout.close();
				f.close();
				break;
			}
		}
	}
}
void symbol()
{
	fstream f,ft;
	f.open(filename,ios::in||ios::out);
	ft.open("symbol.txt",ios::out|ios::binary);
	char c,temp[20];
	int t=0,inc=0;
	while(1)
	{
		f.get(c);
		if(c=='.')
		{
			f.get(c);
			if(c=='d' || c=='D')
			{
				sym.addr=0;
				while(c!=' ' && c!='\n')
					f.get(c);
				t=0;
				while(c=='\n')
					f.get(c);
			    up:
				while(c==' ')
					f.get(c);
				while(c!=' ')
				{
					sym.name[t++]=c;
					f.get(c);
				}
				sym.name[t]='\0';
				t=0;
				while(c==' ')
					f.get(c);
				while(c!=' ')
				{
					sym.type[t++]=c;
					f.get(c);
				}
				sym.type[t]='\0';
				t=0;
				while(c==' ')
					f.get(c);
				while(c!='\0' && c!='\n')
				{
					sym.val[t++]=c;
					f.get(c);
				}
				sym.val[t]='\0';
				while(c!='\n')
					f.get(c);
				sym.addr=sym.addr+inc;
				if(strcmp(sym.type,"dw")==0 || strcmp(sym.type,"DW")==0)
				{
					strcpy(sym.type,"WORD");
					inc=2;
				}
				if(strcmp(sym.type,"db")==0 || strcmp(sym.type,"DB")==0)
				{
					strcpy(sym.type,"BYTE");
					inc=1;
				}
				strcpy(sym.attr,"DATA");
				ft.write((char*)&sym,sizeof(sym));
				ft.seekp(0,ios::end);
				f.get(c);
				t=0;
				while(c=='\n')
					f.get(c);
				if(c!='.')
					goto up;
				else
					goto end;

			}
		}
	}
	end:ft.close();
	ft.open("segment.txt",ios::out|ios::app);
	ft.seekp(0,ios::end);
	strcpy(sg.name,"DATA");
	strcpy(sg.cls,"'data'");
	sg.len=sym.addr+inc;
	ft.write((char*)&sg,sizeof(sg));
	ft.close();
}
void seperate()
{
	fstream f;
	ofstream fout;
	fout.open("intfile.txt",ios::out|ios::binary);
	f.open(filename,ios::in||ios::out);
	if(!f)
	{
		cout<<"File could not b opend!!";
		getch();
		exit(0);
	}
	char c,str[30];
	char labl[10],mne[10],op1[10],op2[10];
	int i=0,j,lable=0;
	cout<<"LABLE	MNE	OP1	OP2"<<endl;
	cout<<"----------------------------------------------------------"<<endl;
	while(1)
	{
		f.get(c);
		if(c=='.')
		{
			f.get(c);
			if(c=='c')
			{  break; }
		}
	}
	do
	{	f.get(c); }while(c!='\n');   //skip '.code'
	t.lc=0;
	int tem;
	while(1)
	{
		f.get(c);
		if(c=='\n' || c==EOF)
		{
			strcpy(labl,"");
			strcpy(mne,"");
			strcpy(op1,"");
			strcpy(op2,"");
			str[i]='\0';
			j=lable=0;
			tem=i;
			for(i=0;str[i]!='\0';i++)
				if(str[i]==':')
					lable=1;
			i=0;
			if(lable==0)
				strcpy(labl,"   ");
			else
			{
				while(str[i]!=':')
				{
					labl[j]=str[i];
					i++;
					j++;
				}
				i++;
				labl[j]='\0';
				strcpy(sym.name,labl);
				strcpy(sym.attr,"Code");
				strcpy(sym.type,"LABLE");
				strcpy(sym.val,"   ");
				sym.addr=t.lc;
				ofstream ft;
				ft.open("symbol.txt",ios::app|ios::binary);
				ft.write((char*)&sym,sizeof(sym));
				ft.close();

			}
			if(str[i]=='\0')
			{
				i=0;
				goto prin;
			}
			while(str[i]==' ')
				i++;
			j=0;
			while(str[i]!=' ' && str[i]!='\0')
				mne[j++]=str[i++];
			mne[j]='\0';
			j=0;
			if(str[i]=='\0')
			{
				i=0;
				goto prin;
			}
			while(str[i]==' ')
				i++;
			while(str[i]!=',' && str[i]!='\0')
				op1[j++]=str[i++];
			op1[j]='\0';
			j=0;
			if(str[i]=='\0')
			{
				i=0;
				goto prin;
			}
			i++;		//to skip comma(,)
			while(str[i]==' ')
				i++;
			while(str[i]!='\0')
				op2[j++]=str[i++];
			op2[j]='\0';
			prin:
			cout<<endl<<labl<<"\t"<<mne<<"\t"<<op1<<"\t"<<op2;
			i=0;


			fstream fin;
			fin.open("mot.txt",ios::in);
			fin.seekg(0,ios::end);
			int n=fin.tellg()/sizeof(m);
			int flag=0;
			while(i<n)
			{
				fin.seekg(i*sizeof(m),ios::beg);
				fin.read((char*)&m,sizeof(m));
				if(strcmpi(m.mne,mne)==0)
				{
			 //make entry in intermediate file....
					if(strcmpi(m.op1,op1)==0 && strcmpi(m.op2,op2)==0)
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,"");
						t.hex=m.hex;
						fout.write((char*)&t,sizeof(t));
						flag=1;
						goto down;
					}
					if(strcmpi(m.op1,op1)==0 && strcmpi(m.op2,"-")==0 )
					{
					    if((strcmp(op2,"@data")==0 || op2[strlen(op2)-1]=='h'|| op2[strlen(op2)-1]=='H'))
					    {
						    strcpy(t.cls,m.cls);
						    strcpy(t.op,op2);
						    t.hex=m.hex;
						    fout.write((char*)&t,sizeof(t));
						    flag=1;
						    goto down;
					    }
					}
					if(strcmpi(m.op1,op1)==0 && strcmpi(m.op2,"*")==0)
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,op2);
						t.hex=m.hex;
						fout.write((char*)&t,sizeof(t));
						flag=1;
						goto down;
					}
					if(strcmpi(m.op1,"*")==0 && strcmpi(m.op2,op2)==0)
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,op1);
						t.hex=m.hex;
						fout.write((char*)&t,sizeof(t));
						flag=1;
						goto down;
					}
					if(strcmpi(m.op1,op1)==0&&strcmpi(m.op2,"-")==0&&strlen(op2)<1)
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,"");
						t.hex=m.hex;
						fout.write((char*)&t,sizeof(t));
						flag=1;
						goto down;
					}
					if(strcmpi(m.op1,"-")==0&&strcmpi(m.op2,"-")==0 && strlen(op1)<1 && strlen(op2)<1)
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,"");
						t.hex=m.hex;
						fout.write((char*)&t,sizeof(t));
						flag=1;
						goto down;
					}
					if(strlen(op2)<1 && (op1[1]!='x'||op1[1]!='h'||op1[1]!='l'))
					{
						strcpy(t.cls,m.cls);
						strcpy(t.op,op1);
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
			{	flag=0;
				t.lc+=m.len;   }
			else
			{
				cout<<"\nERROR : Unknown Instruction...\n";
				flag=0;
			}
			fin.close();
			i=0;
			if(c==EOF)
				break;
		}
		else
			str[i++]=c;
	}
	f.close();
	fout.close();
	fout.open("segment.txt",ios::app|ios::binary);
	fout.seekp(0,ios::end);
	strcpy(sg.name,"CODE");
	sg.len=t.lc;
	strcpy(sg.cls,"'Code'");
	fout.write((char*)&sg,sizeof(sg));
	fout.close();
}
void dispsyb()
{
	int n,i;
	fstream fin;
	fin.open("symbol.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(sym);
	cout<<"\n\t\tSYMBOL TABLE\n";
	cout<<"--------------------------------------------------------\n";
	cout<<"NAME\tTYPE\tADDR\tATTR\tVAL\n";
	cout<<"--------------------------------------------------------\n";
	for(i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(sym),ios::beg);
		fin.read((char*)&sym,sizeof(sym));
		cout<<sym.name<<"\t"<<sym.type<<"\t";
		printf("%#04d",sym.addr);
		cout<<"\t"<<sym.attr<<"\t"<<sym.val<<"\n";
	}
	fin.close();
	cout<<"--------------------------------------------------------\n";
}
void dispseg()
{
	int n,i;
	fstream fin;
	fin.open("segment.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(sg);
	cout<<"\n\t\tSEGMENT TABLE\n";
	cout<<"--------------------------------------------------------\n";
	cout<<"NAME\tCLASS\tLENGTH\n";
	cout<<"--------------------------------------------------------\n";
	for(i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(sg),ios::beg);
		fin.read((char*)&sg,sizeof(sg));
		cout<<sg.name<<"\t"<<sg.cls<<"\t";
		printf("%#04d\n",sg.len);
	}
	fin.close();
	cout<<"--------------------------------------------------------\n";
}

void dispint()
{
	cout<<"\n\t\tPASS-I  INT FILE\n";
	cout<<"--------------------------------------------------------\n";
	cout<<"LC\t(CLASS , HEX CODE)\tOP\n";
	cout<<"--------------------------------------------------------\n";
	int n,i;
	fstream fin;
	fin.open("symbol.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(sym);
	for(i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(sym),ios::beg);
		fin.read((char*)&sym,sizeof(sym));
		if(strcmp(sym.type,"LABEL")!=0)
		{
			printf("%#04d",sym.addr);
			cout<<"\t"<<sym.val<<"\n";
		}
	}
	fin.close();
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
void pass2()
{
	ifstream f2;
	int n1,flag=0;
	cout<<"\n\t\tPASS-II  \n";
	cout<<"--------------------------------------------------------\n";
	cout<<"LC\tHEX CODE\n";
	cout<<"--------------------------------------------------------\n";
	int n,i;
	fstream fin;
	fin.open("symbol.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(sym);
	for(i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(sym),ios::beg);
		fin.read((char*)&sym,sizeof(sym));
		if(strcmp(sym.type,"LABEL")!=0)
		{
			printf("%#04d",sym.addr);
			cout<<"\t"<<sym.val<<"\n";
		}
	}
	fin.close();
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
			f2.open("symbol.txt",ios::in|ios::binary);
			 f2.seekg(0,ios::end);
			 n1=f2.tellg()/sizeof(sym);
			for(int j=0;j<n1;j++)
			{
				f2.seekg(j*sizeof(sym),ios::beg);
				f2.read((char*)&sym,sizeof(sym));
				if(strcmpi(t.op,sym.name)==0)
				{
					itoa(sym.addr,t.op,10);
					printf("%#04d r\n",sym.addr);
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


int main()
{
	clrscr();
	cout<<"\nEnter Filename:";
	cin>>filename;
	stack();
	symbol();
	seperate();
	dispsyb();
	dispseg();
	getch();
	dispint();
	getch();
	pass2();
	getch();
	return 0;
}