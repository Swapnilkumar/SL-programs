//	NAME : DHIRAJ NEVE
//	ASSIGNMENT NO. 2
//	ROLL NO 3145
//	DATE : 9TH FEB 2010
//	MACRO ASSEMBLER

#include<stdio.h>
#include<conio.h>
#include<fstream.h>
#include<iostream.h>
#include<string.h>
#include<stdlib.h>
char filename[20];
struct mnttable
{
	char name[15],p1[15],p2[15],p3[15];
	int nop,row;
}mnt;
struct mdttable
{
	int index,row;
	char inst[30];
}mdt;
struct ala1table
{
	char name[15],formal[15],positional[15];
}ala1;
struct ala2table
{
	char name[15],actual[15],positional[15];
}ala2;
struct expansion
{
	char inst[30];
	int index;
}ps2;
void create()
{
	fstream f,fout,f1,f2;
	f1.open("mdt.txt",ios::out|ios::binary);
	fout.open("mnt.txt",ios::out|ios::binary);
	f2.open("ala1.txt",ios::out|ios::binary);
	int j=0,i=0,k=0,mflag=0,row_no=0;
	char c,str[40],temp[30],p1[10],p2[10],p3[10];
	strcpy(p1,"");
	strcpy(p2,"");
	strcpy(p3,"");
	f.open(filename,ios::binary||ios::in);
	if(!f)
	{
		cout<<"File could not b opened!!!";
		getch();
		exit(0);
	}
	cout<<"_____________________________________________________\n\n";
	cout<<"  \tSOURCE CODE:\n\n";
	while(1)
	{
		c=f.get();
		if(c==EOF)
			break;
		cout<<c;
	}
	cout<<"_____________________________________________________";
	f.close();
	f.open(filename,ios::binary||ios::in);
	mnt.nop=0;
	mdt.index=0;
	while(1)
	{
		c=f.get();
		if(c==EOF)
			break;
		if(c=='\n')
		{
			c=f.get();
			str[i]='\0';
			row_no++;             //Increment row number.
			if(str[0]=='m' && str[1]=='a' && str[2]=='c')
				mflag=1;		  //Indicate that the macro has started
			if(mflag==2)
			{

				mdt.index++;
				j=0,k=0;
				int t;
				int pt=0,p1flag=0,p2flag=0,p3flag=0;
				while(str[j]!='\0')
				{
					mdt.inst[k++]=str[j++];
					t=j;
					while(str[t]==p1[pt] && str[t]!='\0')
					{
						pt++;
						t++;
						p1flag=1;
					}
					if(p1flag==1 && pt==strlen(p1))
					{
						mdt.inst[k++]='#';
						mdt.inst[k++]='1';
						j=t;
					}
					pt=0;
					t=j;
					while(str[t]==p2[pt] && str[t]!='\0')
					{
						pt++;
						t++;
						p2flag=1;
					}
					if(p2flag==1 && pt==strlen(p2))
					{
						mdt.inst[k++]='#';
						mdt.inst[k++]='2';
						j=t;
					}
					pt=0;
					t=j;
					while(str[t]==p3[pt] && str[t]!='\0')
					{
						pt++;
						t++;
						p2flag=1;
					}
					if(p3flag==1 && pt==strlen(p3))
					{
						mdt.inst[k++]='#';
						mdt.inst[k++]='3';
						j=t;
					}
					p1flag=p2flag=p3flag=0;
				}
				mdt.inst[k]='\0';
				mdt.row=row_no;
				f1.seekp(0,ios::end);
				f1.write((char*)&mdt,sizeof(mdt));

			}
			if(str[0]=='m' && str[1]=='e' && str[2]=='n')
			{
				mflag=0;         //Indicate that we are out of macro
				strcpy(p1,"");
				strcpy(p2,"");
				strcpy(p3,"");
			}
			if(mflag==1)
			{
				mflag=2;				//Indicate that we are in macro
				mnt.row=row_no;
				j=0;
				while(str[j]!=' ')
					j++;
				while(str[j]==' ')
					j++;
					k=0;
				do
					temp[k++]=str[j++];
				while(str[j]!=' ' && str[j]!='\0');
				temp[k]='\0';
				strcpy(mnt.name,temp);
				strcpy(ala1.name,temp);
				while(str[j]==' ')
					j++;
				if(str[j]=='\0')
				{
					mnt.nop=0;
					goto end;
				}
				k=0;
				do
					p1[k++]=str[j++];
				while(str[j]!=' ' && str[j]!=',' && str[j]!='\0');
				p1[k]='\0';
				if(str[j]==',')
					j++;
				while(str[j]==' ')
					j++;
				if(str[j]=='\0')
				{
					mnt.nop=1;
					goto end;
				}
				k=0;
				do
					p2[k++]=str[j++];
				while(str[j]!=' ' && str[j]!=',' && str[j]!='\0');
				p2[k]='\0';
				if(str[j]==',')
					j++;
				while(str[j]==' ')
					j++;
				if(str[j]=='\0')
				{
					mnt.nop=2;
					goto end;
				}
				k=0;
				mnt.nop=3;
				do
					p3[k++]=str[j++];
				while(str[j]!=' ' && str[j]!='\0');
				p3[k]='\0';
			  end:
				strcpy(ala1.formal,p1);
				strcpy(ala1.positional,"#1");
				if(strlen(p1)!=0)
				{
					f2.seekp(0,ios::end);
					f2.write((char*)&ala1,sizeof(ala1));
				}
				strcpy(ala1.formal,p2);
				strcpy(ala1.positional,"#2");
				if(strlen(p2)!=0)
				{
					f2.seekp(0,ios::end);
					f2.write((char*)&ala1,sizeof(ala1));
				}
				strcpy(ala1.formal,p3);
				strcpy(ala1.positional,"#3");
				if(strlen(p3)!=0)
				{
					f2.seekp(0,ios::end);
					f2.write((char*)&ala1,sizeof(ala1));
				}
				strcpy(mnt.p1,p1);
				strcpy(mnt.p2,p2);
				strcpy(mnt.p3,p3);
				fout.seekp(0,ios::end);
				fout.write((char*)&mnt,sizeof(mnt));
			}
			i=0;
		}
		str[i++]=c;
	}
	f2.close();
	f1.close();
	fout.close();
	f.close();
}
void expansion()
{
	fstream f,fout,f1;
	char c,str[40],temp[40];
	int doubl=0;
	int i=0,mflag=0,j=0,k,n,mfind=0,b,s;          	//mflag=0;OUTSIDE MACRO	mflag=1;INSIDE MACRO
	fout.open("ala2.txt",ios::out|ios::binary);
	f1.open("expansion.txt",ios::out|ios::binary);
	f.open(filename,ios::binary||ios::in);
	ps2.index=1;
	while(1)
	{
		c=f.get();
		if(c==EOF)
			break;
		if(c=='\n')
		{
			c=f.get();
			j=0;
			str[i]='\0';
			if(str[0]=='e' && str[1]=='n' && str[2]=='d')
				goto down;
			if(str[0]=='m' && str[1]=='a' && str[2]=='c')
				mflag=1;
			mfind=0;
			if(mflag==0)      	//INdicate that we are not in macro
			{
				k=j=0;
				while(str[j]!=' ' && str[j]!='\0')
					temp[k++]=str[j++];
				temp[k]='\0';
				fstream fin;
				fin.open("mnt.txt",ios::in|ios::binary);
				fin.seekg(0,ios::end);
				n=fin.tellp()/sizeof(mnt);
				for(int a=0;a<n;a++)
				{
					fin.seekg(a*sizeof(mnt),ios::beg);
					fin.read((char*)&mnt,sizeof(mnt));
					if(strcmpi(mnt.name,temp)==0)
					{

						//strcpy(ala2.name,temp);
						while(str[j]==' ')
							j++;
						if(mnt.nop==0)
							goto end;//no need for ala,(no parameters)
						//construct ala2 table
						char p[10],a1[10],a2[10],a3[10];
						dou:
						strcpy(ala2.name,temp);
						strcpy(p,"");
						k=0;
						do
							p[k++]=str[j++];
						while(str[j]!=',' && str[j]!='\0');
						//j++;
						p[k]='\0';
						strcpy(a1,p);
						strcpy(ala2.actual,p);
						strcpy(ala2.positional,"#1");
						fout.seekp(0,ios::end);
						fout.write((char*)&ala2,sizeof(ala2));

						if(mnt.nop==1)
						{	if(str[j]!='\0')
							{	doubl=1;
								goto end;  }
							else
								goto end;   }
						j++;
						strcpy(p,"");
						k=0;
						do
							p[k++]=str[j++];
						while(str[j]!=',' && str[j]!='\0');
					    //	j++;
						p[k]='\0';
						strcpy(a2,p);
						strcpy(ala2.actual,p);
						strcpy(ala2.positional,"#2");
						fout.seekp(0,ios::end);
						fout.write((char*)&ala2,sizeof(ala2));
						if(mnt.nop==2)
						{	if(str[j]!='\0')
							{	doubl=1;
								goto end; }
							else
								goto end; }
						j++;
						strcpy(p,"");
						k=0;
						do
							p[k++]=str[j++];
						while(str[j]!=',' && str[j]!='\0');
						//j++;
						p[k]='\0';
						if(str[j]!='\0')
							doubl=1;
						j++;
						strcpy(a3,p);
						strcpy(ala2.actual,p);
						strcpy(ala2.positional,"#3");
						fout.seekp(0,ios::end);
						fout.write((char*)&ala2,sizeof(ala2));


					  end:
						//replace macro instruction
						int td;
						td=j;
						mfind=1;
						fstream fin1;
						int l;
						fin1.open("mdt.txt",ios::in|ios::binary);
						fin1.seekg(0,ios::end);
						s=fin1.tellp()/sizeof(mdt);
						for(b=0;b<s;b++)
						{
							fin1.seekg(b*sizeof(mdt),ios::beg);
							fin1.read((char*)&mdt,sizeof(mdt));
							if(mdt.row==mnt.row+1)
							{
								while(strcmpi(mdt.inst,"mend")!=0)
								{
									k=j=0;
									while(mdt.inst[k]!='\0')
									{
										if(mdt.inst[k]=='#')
										{	l=0;
											if(mdt.inst[k+1]=='1')
											{
												do
													ps2.inst[j++]=a1[l++];
												while(a1[l]!='\0');
												k=k+2;
											}
											if(mdt.inst[k+1]=='2')
											{
												do
													ps2.inst[j++]=a2[l++];
												while(a2[l]!='\0');
												k=k+2;
											}
											if(mdt.inst[k+1]=='3')
											{
												do
													ps2.inst[j++]=a3[l++];
												while(a3[l]!='\0');
												k=k+2;
											}
										}
										else
											ps2.inst[j++]=mdt.inst[k++];
									}
									ps2.inst[j]='\0';
									f1.seekp(0,ios::end);
									f1.write((char*)&ps2,sizeof(ps2));
									ps2.index++;
									b++;
									fin1.seekg(b*sizeof(mdt),ios::beg);
									fin1.read((char*)&mdt,sizeof(mdt));
								}
							}
						}
						if(doubl==1)
						{
							j=td+1;
							doubl=0;
							goto dou;
						}
					}
				}
				if(mfind==0)
				{
					strcpy(ps2.inst,str);
					f1.seekp(0,ios::end);
					f1.write((char*)&ps2,sizeof(ps2));
					ps2.index++;
				}
			}
			if(str[0]=='m' && str[1]=='e' && str[2]=='n')
				mflag=0;       //Ensure that next line will not b in macro
			i=0;
		}
		str[i++]=c;
	}
	down:
	f1.close();
	fout.close();
	f.close();
}
void dispmdt()
{
	int n;
	fstream fin;
	fin.open("mdt.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(mdt);
	cout<<"\n\t\tMDT TABLE\n";
	cout<<"_____________________________________________________\n\n";
	cout<<"Index\tInstruction\n";
	cout<<"_____________________________________________________\n\n";
	for(int i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(mdt),ios::beg);
		fin.read((char*)&mdt,sizeof(mdt));
		cout<<mdt.index<<"\t"<<mdt.inst<<"\n";
	}
	fin.close();
	cout<<"_____________________________________________________\n\n";
}
void dispmnt()
{
	int n;
	fstream fin;
	fin.open("mnt.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(mnt);
	cout<<"\n\n\t\tMNT TABLE\n";
	cout<<"_____________________________________________________\n\n";
	cout<<"Name\tNumber of Parameters\trow number\n";
	cout<<"_____________________________________________________\n\n";
	for(int i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(mnt),ios::beg);
		fin.read((char*)&mnt,sizeof(mnt));
		cout<<mnt.name<<"\t"<<mnt.nop<<"\t\t\t"<<mnt.row<<"\n";
	}
	fin.close();
	cout<<"_____________________________________________________\n\n";
}
void dispala2()
{
	int n;
	fstream fin;
	fin.open("ala2.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(ala2);
	cout<<"\n\n\t\tALA2 TABLE\n";
	cout<<"_____________________________________________________\n\n";
	cout<<"Name\tActual\tPositional\n";
	cout<<"_____________________________________________________\n\n";
	for(int i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(ala2),ios::beg);
		fin.read((char*)&ala2,sizeof(ala2));
		cout<<ala2.name<<"\t"<<ala2.actual<<"\t"<<ala2.positional<<"\n";
	}
	fin.close();
	cout<<"_____________________________________________________\n\n";
}
void dispala1()
{
	int n;
	fstream fin;
	fin.open("ala1.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(ala1);
	cout<<"\n\n\t\tALA1 TABLE\n";
	cout<<"_____________________________________________________\n\n";
	cout<<"Name\tFormal\tPositional\n";
	cout<<"_____________________________________________________\n\n";
	for(int i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(ala1),ios::beg);
		fin.read((char*)&ala1,sizeof(ala1));
		cout<<ala1.name<<"\t"<<ala1.formal<<"\t"<<ala1.positional<<"\n";
	}
	fin.close();
	cout<<"_____________________________________________________\n\n";
}
void dispexp()
{
	int n;
	fstream fin;
	fin.open("expansion.txt",ios::in|ios::binary);
	fin.seekg(0,ios::end);
	n=fin.tellp()/sizeof(ps2);
	cout<<"\n\n\t\tEXPANDED CODE\n";
	cout<<"_____________________________________________________\n\n";
	cout<<"Index\tInstruction\n";
	cout<<"_____________________________________________________\n\n";
	for(int i=0;i<n;i++)
	{
		fin.seekg(i*sizeof(ps2),ios::beg);
		fin.read((char*)&ps2,sizeof(ps2));
		cout<<ps2.index<<"\t"<<ps2.inst<<"\n";
	}
	fin.close();
	cout<<"_____________________________________________________\n\n";
}
int main()
{
	clrscr();
	cout<<"Enter Filename:";
	cin>>filename;
	create();
	getch();
	dispmnt();
	getch();
	dispmdt();
	getch();
	dispala1();
	getch();
	expansion();
	dispala2();
	getch();
	dispexp();
	getch();
	return 0;
}
