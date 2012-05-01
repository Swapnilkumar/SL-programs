
#include<conio.h>
#include<stdio.h>
#include<fstream.h>
#include<iostream.h>

#include<string.h>
#include<stdlib.h>


class sim
{
	public:

	void dataseg();
	void codeseg();
	void simmov(char str[30]);
	void simadd(char str[30]);

	int checkreg(char str[10]);
};


void sim::dataseg()
{
	fstream fin;

	fin.open("MYADD.ASM",ios::in);
	int endflag;
	char str[30];
	endflag=0;
	for(;;)
	{
		fin>>str;
		cout<<str;

		if(!strcmpi(str,"end"))
		{
			endflag=1;
			break;
		}
		if(!strcmpi(str,".Data"))
			break;


	}

	if(endflag ==1)
	{
		cout<<"\n\n\tNo DATA SEGMENT";
		fin.close();
		getch();
		return;

	}
	endflag=0;
	cout<<"\n\n\tDATA SEGMENT";


	for(;;)
	{
		fin>>str;

		if(!strcmpi(str,"end"))
		{
			endflag=1;
			break;
		}
		if(!strcmpi(str,".Code"))
		{
			cout<<"\n\ndata segment over";
			break;
		}
		cout<<"\n\nVariable : "<<str;

		fin>>str;
		cout<<"\nDatatype: "<<str;

		fin>>str;
		cout<<"\nInitial Value : "<<str;
	}
	fin.close();
	getch();
}


void sim::codeseg()
{
	ifstream fin;

	fin.open("MYADD.ASM",ios::in);
	int endflag;
	char str[30];
	endflag=0;
	for(;;)
	{
		fin>>str;
		cout<<str;

		if(!strcmpi(str,"end"))
		{
			endflag=1;
			break;
		}
		if(!strcmpi(str,".Code"))
			break;


	}

	if(endflag ==1)
	{
		cout<<"\n\n\tNo Code SEGMENT";
		fin.close();
		getch();
		return;

	}
	endflag=0;
	cout<<"\n\n\tCODE SEGMENT";


	for(;;)
	{
		fin>>str;
		if(!strcmpi(str,"end"))
		{
			endflag=1;
			cout<<"\n\nCode segment over";
			break;
		}

		if(strlen(str)==0)
			continue;

		if(!strcmpi(str,"mov"))
		{
			fin>>str;
			simmov(str);
		}
		if(!strcmpi(str,"add"))
		{
			fin>>str;
			simadd(str);
		}
	}
}

void sim::simmov(char str[30])
{
	char str1[10],str2[10];

	int i,flag,k;
	i=k=0;
	flag=0;
	while(str[i]!='\0')
	{
	       if(str[i]==',')
	       {
			i++;
			flag=1;
			str1[k]='\0';
			k=0;
	       }
	       if(flag==1)
	       {
			str2[k]=str[i];
			k++;i++;
			continue;
	       }
	       str1[k]=str[i];
	       k++;i++;
	}
	str2[k]='\0';
	cout<<"\n\n MOV INSTRUSTION";

	cout<<"\n\tOperands : ";

	cout<<"\t"<<str1;cout<<"\t"<<str2;cout<<endl;

}


void sim::simadd(char str[30])
{
	char str1[10],str2[10];

	//cout<<str;
	int i,flag,k;
	i=k=0;
	flag=0;
	while(str[i]!='\0')
	{
	       if(str[i]==',')
	       {
			i++;
			flag=1;
			str1[k]='\0';
			k=0;
	       }
	       if(flag==1)
	       {
			str2[k]=str[i];
			k++;i++;
			continue;
	       }
	       str1[k]=str[i];
	       k++;i++;
	}
	str2[k]='\0';
	cout<<"\n\n ADD INSTRUSTION";

	cout<<"\n\tOperands : ";

	cout<<"\t"<<str1;

	cout<<"\t"<<str2;
	cout<<endl;

}

int sim::checkreg(char str[10])
{
	if(!strcmpi(str,"ax"))
		return 1;
	if(!strcmpi(str,"bx"))
		return 1;
	if(!strcmpi(str,"cx"))
		return 1;
	if(!strcmpi(str,"dx"))
		return 1;

	if(!strcmpi(str,"ah"))
		return 1;
	if(!strcmpi(str,"bh"))
		return 1;
	if(!strcmpi(str,"ch"))
		return 1;
	if(!strcmpi(str,"dh"))
		return 1;

	if(!strcmpi(str,"al"))
		return 1;
	if(!strcmpi(str,"bl"))
		return 1;
	if(!strcmpi(str,"cl"))
		return 1;
	if(!strcmpi(str,"dl"))
		return 1;
	if(!strcmpi(str,"ds"))
		return 1;
	if(!strcmpi(str,"cs"))
		return 1;
	if(!strcmpi(str,"si"))
		return 1;
	if(!strcmpi(str,"di"))
		return 1;

	return 0;
}



int main()
{
	sim s;

	clrscr();

	s.dataseg();

	s.codeseg();

	return 0;
}









