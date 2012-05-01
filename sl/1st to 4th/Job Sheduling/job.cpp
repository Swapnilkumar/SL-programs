#include<stdio.h>
#include<iostream.h>
#include<conio.h>
#include<graphics.h>
#include<stdlib.h>
#include<string.h>
int n;
struct process
{
	int arrival,brust,index;
}pr[20],temp[20];
void accept()
{
	cout<<"Enter number of Processes:";
	cin>>n;
	cout<<"\t [PROCESS]"<<endl;
	for(int i=0;i<n;i++)
	{
		pr[i].index=i+1;
		cout<<i+1<<"]";
		cout<<"Arrival Time:";
		cin>>pr[i].arrival;
		cout<<"  Brust Time:";
		cin>>pr[i].brust;
	}
	cout<<"Process\tArrival\tBrust\n";
	cout<<"__________________________________\n";
	for(i=0;i<n;i++)
		cout<<"P"<<i+1<<"\t"<<pr[i].arrival<<"\t"<<pr[i].brust<<endl;
}
void gnatt(char str[20][4],int n1,int s[],int finish)
{
	int gd=DETECT,gm;
	char st[20];
	initgraph(&gd,&gm,"f:\\tc\\bgi");
	for(int i=0;i<n1;i++)
	{
		rectangle(i*40+20,50,i*40+50,80);
		itoa(s[i],st,10);
		outtextxy(i*40+13,90,st);
		outtextxy(i*40+30,62,str[i]);
	}
	itoa(finish,st,10);
	outtextxy(i*40+15,90,st);
	getch();
	closegraph();
}
void FCFS()
{
	int start,finish,arrival,turn,wait,s[20];
	float AVGt=0,AVGw=0;
	char str[20][4],t[10],m[10];
	for(int j=0;j<n;j++)
	{
		itoa(j+1,t,10);
		strcpy(m,"P");
		strcat(m,t);
		strcpy(str[j],m);
	}
	start=pr[0].arrival;
	cout<<"Process\tStart\tFinish\tArrival\tTurn-around\tWaiting\n";
	cout<<"__________________________________\n";
	for(int i=0;i<n;i++)
	{
		s[i]=start;
		finish=start+pr[i].brust;
		wait=start-pr[i].arrival;
		turn=finish-pr[i].arrival;
		cout<<"P"<<i+1<<"\t"<<start<<"\t"<<finish<<"\t"<<pr[i].arrival<<"\t"<<turn<<"\t\t"<<wait<<endl;
		AVGt+=turn;
		AVGw+=wait;
		start=finish;
		if(start<pr[i+1].arrival)
			start=pr[i+1].arrival;
	}
	cout<<"Avg Waiting time is "<<AVGw/n<<".\n";
	cout<<"Avg Turn-around time is "<<AVGt/n<<".\n";
	getch();
	int n1;
	n1=n;
	gnatt(str,n1,s,finish);//(string of processes,number of elements in chart,start time of each element,finish time)
}
void SJF()
{
	int global,flag[20],start,turn,wait,finish,s[20];
	float AVGt=0,AVGw=0;
	for(int k=0;k<20;k++)
		flag[k]=0;
	char str[20][4];
	process small;
	start=pr[0].arrival;		  //1 indicate that corresponding process hav been serviced
	global=pr[0].arrival;
	cout<<"Process\tStart\tFinish\tArrival\tTurn-around\tWaiting\n";
	cout<<"__________________________________\n";
	for(int i=0;i<n;i++)       //to keep track for number of serviced process
	{
		s[i]=start;
		small.brust=999;
		k=0;
		up:
		process t[20];
		for(int j=0;j<n;j++)  //Check all entries in 'pr' for arrival time
		{
			if(global>=pr[j].arrival && flag[j]==0)
				t[k++]=pr[j];
		}
		if(k==0)
		{
			global++;
			goto up;    //t will now contain all process which can b serviced
		}
		for(j=0;j<k;j++)
			if(small.brust>t[j].brust)
				small=t[j];
		flag[small.index-1]=1;
		char m[10],n[10];				//find shortest among t
		strcpy(m,"P");
		itoa(small.index+1,n,10);
		strcat(m,n);
		strcpy(str[i],m);
		//small will contain job to b served
		finish=start+small.brust;
		wait=start-small.arrival;
		turn=finish-small.arrival;
		cout<<"P"<<small.index<<"\t"<<start<<"\t"<<finish<<"\t"<<small.arrival<<"\t"<<turn<<"\t"<<wait<<endl;
		AVGt+=turn;
		AVGw+=wait;
		
		start=finish;
		if(k==1 && pr[i+1].arrival>start)
			start=pr[i+1].arrival;
		global=global+small.brust;
	}
	cout<<"Avg Waiting time is "<<AVGw/n<<".\n";
	cout<<"Avg Turn-around time is "<<AVGt/n<<".\n";
	getch();
	int n1;
	n1=n;
	gnatt(str,n1,s,finish);
}
int isclear(int flag[])           //Check weather all flags cleared or not
{
	for(int i=0;i<n;i++)
		if(flag[i])
			return 0;
	return 1;
}
void Round_Robin()
{
	int time,flag[20],wait[20],s[20];
	cout<<"Enter Time slice:";
	cin>>time;
	char str[20][4],t[10],m[10];
	int start=0;
	process temp[20];
	for(int i=0;i<20;i++)
	{
		flag[i]=1;
		wait[i]=0;
		temp[i]=pr[i];
	}
	i=0;
	while(!isclear(flag))   //until all flags become clears(process completes wid clear flag)
	{
		for(int k=0;k<n;k++)
		{
			s[i]=start;
			if(flag[k])
			{
				strcpy(m,"P");
				itoa(k+1,t,10);
				strcat(m,t);
				strcpy(str[i],m);
				if(temp[k].brust>time)
				{
					temp[k].brust=temp[k].brust-time;
					start=start+time;
				}
				else
				{
					flag[k]=0;
					start=start+temp[k].brust;
					temp[k].brust=0;
					wait[k]=start-pr[k].brust;

				}
				i++;
			}
		}
	}    //All process are served
	int n1;
	n1=i;
	cout<<"Process\tArrival\tBrust\tWait\n";
	cout<<"________________________________________________\n";
	for(i=0;i<n;i++)
		cout<<"P"<<i+1<<"\t"<<pr[i].arrival<<"\t"<<pr[i].brust<<"\t"<<wait[i]<<endl;
	getch();
	gnatt(str,n1,s,start);
}
int main()
{
	int ch;
	clrscr();
	accept();
	cout<<"Enter Your Choice:"<<endl;
	up:
	cout<<"1. FCFS"<<endl;
	cout<<"2. SJF"<<endl;
	cout<<"3. Roundk Robin"<<endl;
	cout<<"4. Exit";
	cin>>ch;
	switch(ch)
	{
		case 1:
			FCFS();
			break;
		case 2:
			SJF();
			break;
		case 3:
			Round_Robin();
			break;
		case 4:
			break;
		default:
			cout<<"Plz Enter Proper choice.";
	}
	if(ch!=4)
		goto up;
	getch();
	return 0;
}