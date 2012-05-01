#include<conio.h>
#include<stdio.h>
#include<fstream.h>
#include<iostream.h>
#include<string.h>
#include<stdlib.h>


class asmb
{
	public:
	void pass1();

};



struct mot
{
	char mno[10];
	char op[10];
	struct mot* npt;
};
mot mott[26]={NULL};



void asmb::pass1()
{
	fstream fin;

	fin.open("myfile.asm",ios::in);

	char str[10],str1[10];
	int lp;

	fin>>str;


	cout<<str;


	fin.close();
}

void cmot()
{
	fstream fin;

	fin.open("mot.txt",ios::in);
	char str[10],str1[10];
	int n;

	mot t,p;
	while(1)
	{

	fin>>str;
	if(strlen(str)==0)
		break;
	str1[0]=str[0];
	str1[1]='\0';
	n=strcmpi(str1,"A");
	cout<<n<<" "<<str1<<" ";
	if(mott[n].npt==NULL)
	{
		fin>>str1;
		t.npt=mott[n].npt;
		t.npt=(mot *)malloc(sizeof(mot));
		strcpy(t.npt->mno,str);
		strcpy(t.npt->op,str1);
		t.npt->npt=NULL;
		mott[n].npt=t.npt;
		continue;
	}
	t.npt=mott[n].npt;
	while(t.npt->npt!=NULL)
		t.npt=t.npt->npt;

		fin>>str1;
		t.npt->npt=(mot *)malloc(sizeof(mot));
		strcpy(t.npt->npt->mno,str);
		strcpy(t.npt->npt->op,str1);
		t.npt->npt->npt=NULL;

	}
	fin.close();
}




int main()
{
	clrscr();

	cmot();

	asmb a;

	a.pass1();

	getch();
	return 0;
}