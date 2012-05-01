#include<iostream.h>
#include<stdio.h>
#include<conio.h>
#include<stdlib.h>
#include<fstream.h>
struct mot
{
   char mne[30],op1[10],op2[10],cls[10];
   int len;
   long hex;
}m;
int main()
{
   clrscr();
   fstream f;
   char ch;
   int a,n;
   cout<<"\n\n1.ADD\n2.DISPLAY\n3.EXIT\n";
   cin>>a;
   switch(a)
   {
   case 1:
	f.open("mot.txt",ios::app);
	do
	{
	cout<<"MNE : ";
	cin>>m.mne;
	cout<<"OP1 : ";
	cin>>m.op1;
	cout<<"OP2 : ";
	cin>>m.op2;
	cout<<"Hex code :";
	cin>>m.hex;
	cout<<"Length : ";
	cin>>m.len;
	cout<<"Class :";
	cin>>m.cls;
	f.write((char*)&m,sizeof(m));
	cout<<"Do U want to add more mne??(Y/N):";
	cin>>ch;
	}while(ch=='y'||ch=='Y');
	f.close();
	break;
   case 2:
	f.open("mot.txt",ios::in);
	f.seekp(0,ios::end);
	n=f.tellp()/sizeof(m);
	cout<<"\nMNE\tOP1\tOP2\tHEX CODE\tLEN\tCLASS\n";
	cout<<"------------------------------------------------------------\n";
	for(int i=0;i<n;i++)
	{
	f.seekg(i*sizeof(m),ios::beg);
	f.read((char*)&m,sizeof(m));
	cout<<m.mne<<"\t"<<m.op1<<"\t"<<m.op2<<"\t";
	printf("%d\t",m.hex);
	cout<<m.len<<"\t"<<m.cls<<endl;
	}
	f.close();
	break;
   case 3:
	exit(0);
   }
   getch();
   return 0;

}