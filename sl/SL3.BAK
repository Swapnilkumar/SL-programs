
#include<conio.h>
#include<stdio.h>
#include<fstream.h>
#include<iostream.h>
#include<string.h>
#include<stdlib.h>

class asmb
{
	public:
	void createtab();
	void pass2();
	void tabdisplay();
};

struct mot
{
	char mno[10];
	char op[10];
	int size;
	struct mot* npt;
};
mot mott[26]={NULL};
char dltab[5][5]={"DC","DS"},adtab[10][10]={"start","end","origin","equ","ltorg"};
char regtab[5][5]={"AREG","BREG","CREG","DREG"};
char condtab[7][5]={"LT","LE","EQ","GT","GE","ANY"};

char symtab[10][3][10],littab[10][2][10];
int pooltab[10]={0};
int symptr=0,litptr=0,poolptr=0,mnosize;

void asmb::pass2()
{
	cout<<"\n\n\t OUTPUT OF PASS 2\n\n";

	fstream fin,fout;
	fout.open("myfile.obj",ios::out);
	fin.open("inter.obj",ios::in);

	char str[10],str1[10];
	int lptr,code,ptr,index,reg,pool_ptr=0,i;
up:
	fin>>str;

	if(!strcmpi(str,"AD"))
	{
		fin>>code;
		switch(code)
		{
			case 1 :
				fin>>str;
				fin>>lptr;
			break;

			case 5 :
				for(i=pooltab[pool_ptr];i<pooltab[pool_ptr+1];i++)
				{
				strcpy(str1,littab[i][0]+2);
				str1[strlen(str1)-1]='\0';
				fout<<"\n"<<lptr<<" +00 0 00"<<str1;
				cout<<"\n\n"<<lptr<<" +00 0 00"<<str1;
				lptr++;
				}
				pool_ptr++;
			break;

		}
		goto  up;
	}
	else if(!strcmpi(str,"IS"))
	{

		fin>>code;
		switch(code)
		{
			case 9 :

				fout<<"\n"<<lptr<<" +"<<code<<" 0 ";
				cout<<"\n\n"<<lptr<<" +"<<code<<" 0 ";
				lptr++;
				fin>>str;
				fin>>ptr;
			break;
			case 5 :
			case 4:
				fin>>reg;
				fout<<"\n"<<lptr<<" +"<<code<<" "<<reg;
				cout<<"\n\n"<<lptr<<" +"<<code<<" "<<reg;
				lptr++;
				fin>>str;
				fin>>ptr;
			break;
			case 7 :
				fin>>reg;
				fout<<"\n"<<lptr<<" +"<<code<<" "<<reg;
				cout<<"\n\n"<<lptr<<" +"<<code<<" "<<reg;
				lptr++;
				fin>>str;
				fin>>ptr;

			break;
		}
		if(!(strcmpi(str,"S")))
		{
			fout<<" "<<symtab[ptr-1][1];
			cout<<" "<<symtab[ptr-1][1];
		}
		if(!(strcmpi(str,"L")))
		{
			fout<<" "<<littab[ptr-1][1];
			cout<<" "<<littab[ptr-1][1];
		}

		goto  up;


	}
	else if(!strcmpi(str,"DL"))
	{
		fin>>code;
		switch(code)
		{
			case 1 :
				fout<<"\n"<<lptr;
				cout<<"\n\n"<<lptr;
				fin>>str;
				fin>>index;

				lptr++;
			break;
			case 2 :
				fout<<"\n"<<lptr;
				cout<<"\n\n"<<lptr;

				fin>>str;
				fin>>index;
				lptr+=index;
			break;
		}
		goto  up;

	}
	if(!fin.eof())
		goto up;

	fin.close();
	fout.close();

}

void asmb::createtab()
{
	int i,j;

	fstream fin;
	fin.open("symbol.txt",ios::in);

	cout<<"\n\n\tSymbol Table : \n";
	i=0;
	while(!fin.eof())
	{


		fin>>symtab[i][0]>>symtab[i][1]>>symtab[i][2];
		cout<<"\n "<<symtab[i][0]<<"\t"<<symtab[i][1]<<"\t"<<symtab[i][2];
		i++;
	}
	fin.close();

	fin.open("literal.txt",ios::in);
	cout<<"\n\n\tLiteral Table : \n";
	i=0;
	while(!fin.eof())
	{


		fin>>littab[i][0]>>littab[i][1];
		cout<<"\n "<<littab[i][0]<<"\t"<<littab[i][1];
		i++;
	}
	fin.close();

	fin.open("pooltab.txt",ios::in);

	cout<<"\n\n\tPool Table : \n";
	i=0;
	fin>>pooltab[i];
	while(!fin.eof())
	{



		cout<<"\n "<<pooltab[i];
		i++;
		fin>>pooltab[i];

	}
	fin.close();

}



int main()
{
	clrscr();

	asmb a;
	a.createtab();

	getch();
	a.pass2();
	getch();
	return 0;
}