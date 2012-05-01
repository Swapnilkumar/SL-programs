#include<iostream.h>
#include<conio.h>
#include<fstream.h>
#include<string.h>
#include<stdio.h>

struct process
{
	int name;
	int at,bt,ft,tt,wt,st,finished;
};

class queue
{
	process p[20];
	int ptr,front,rear;

	public:
	void add(process t);
	void display();
	int sort();
	void empty();
	void cdelete();
	void cadd(process t);

	queue()
	{
		ptr=0;
		front=rear=0;
	}
};

class algo
{
	process p[20];
	int n;
	public:
	void read();
	void FCFS();
	void SJF();
	void ROUND_ROBIN();
	void ROUND_ROBIN1();
	void check_idle(int *);
	void display();
	int idl_check(int);
	algo()
	{
		read();
	}
};

void queue::cadd(process t)
{
	p[ptr]=t;
	rear++;
	ptr++;
}

void queue::cdelete()
{
	front++;
}

void algo::ROUND_ROBIN()
{

	int i,j;
	process t,q[10];

	for(i=0;i<n;i++)
		for(j=0;j<n;j++)
		{
			if(p[i].at<p[j].at)
			{
				t=p[i];
				p[i]=p[j];
				p[j]=t;
			}
		}

	for(i=0;i<n;i++)
	{
		p[i].finished=p[i].bt;

	}
	int tq;

	cout<<"\n\nEnter Time Quantum";
	cin>>tq;

	queue q1;
	i=0;
	int pflag,time=0,front=0,rear=0;

	if(p[0].at<time)
	{
		t.name=0;
		t.st=0;
		t.ft=p[0].at;
		time=p[0].at;
		q1.add(t);

	}

	q[rear]=p[0];
	rear++;
	if(tq<p[0].finished)
	{

		time+=tq;
		p[0].finished-=tq;
		front++;
	}
	else
	{
		time+=p[0].bt;
		p[0].finished=0;
		front++;
	}
	for(i=1;i<n;i++)
	{
		if(p[i].at<=time)
		{
			q[rear++]=p[i];
		}
	}
	if(p[0].finished)
		q[rear++]=p[i];

	q1.add(p[0]);
	while(pflag)
	{
		pflag=0;



		for(j=0;j<n;j++)
		{
			if(p[j].finished)
			{
				pflag=1;
				break;
			}
		}


	}



	display();
	//q.display();

}

int algo::idl_check(int e_time)
{
	int i,k=32767;

	for(i=0;i<n;i++)
	{
		if(p[i].finished)
		{
			//if(p[i].at > e_time)
			{
				if( (p[i].at-e_time) < k )
					k=p[i].at-e_time;
			}
		}
	}
	if(k<0)
		k=0;
	return k;


}
void algo::SJF()
{
	int i=0,start,end,job_finished=0,posi,k=0;

	queue q,wq;

	for(i=0;i<n;i++)
	{
		p[i].finished=0;
	}
	i=0;
	p[0].st=0;
	p[0].ft=p[i].bt;
	p[0].tt=p[i].ft-p[i].at;
	p[0].wt=p[i].st-p[i].at;
	p[0].finished=1;
	q.add(p[0]);
	end =p[i].ft;
	job_finished++;
	while(job_finished<n)
	{
		wq.empty();
	for(i=0;i<n;i++)
	{
			if( p[i].at<=end )
			{
				if(p[i].finished== 0 )
					wq.add(p[i]);
			}
	}
	posi=wq.sort();
	i=posi;
	p[i].st=p[k].ft;
	p[i].ft=p[i].bt+p[i].st;
	p[i].tt=p[i].ft-p[i].at;
	p[i].wt=p[i].st-p[i].at;
	p[i].finished=1;
	q.add(p[i]);
	end +=p[i].ft;
	job_finished++;
	k=i;
		getch();
	}
	display();
	q.display();
}

void algo::FCFS()
{
	int i,j;
	process t;

	for(i=0;i<n;i++)
		for(j=0;j<n;j++)
		{
			if(p[i].at<p[j].at)
			{
				t=p[i];
				p[i]=p[j];
				p[j]=t;
			}
		}

	for(i=0;i<n;i++)
	{
		p[i].finished=p[i].bt;
	}

	i=0;
	int pflag,time=0;
	queue q;

	if(p[0].at<time)
	{
		t.name=0;
		t.st=0;
		t.ft=p[0].at;
		time=p[0].at;
		q.add(t);
	}

	while(pflag)
	{
		pflag=0;

		if(time>=p[i].at)
		{
			p[i].st=time;
			time+=p[i].bt;
			p[i].ft=time;
			p[i].tt=p[i].ft-p[i].at;
			p[i].wt=p[i].st-p[i].at;
			p[i].finished=0;
			q.add(p[i]);
			i++;
		}
		else
		{
			t.name=-1;
			t.st=time;
			t.ft=p[i].at;
			time=p[i].at;

			q.add(t);
		}
		for(j=0;j<n;j++)
		{
			if(p[j].finished)
			{
				pflag=1;
				break;
			}
		}

	}
	display();
	q.display();
}

int main()
{
	clrscr();


	int ch;

	do
	{
		algo a;
		cout<<"\n\n 1.FCFS\n 2.SJF\n 3.ROUND ROBIN\n 0.Exit\n \t Enter option : ";
		cin>>ch;
		clrscr();
		switch(ch)
		{

			case 1 :
				cout<<"\n\n Scheduling Algorithm  FCFS : ";
				a.FCFS();
				break;
			case 2 :
				cout<<"\n\n Scheduling Algorithm  SJF :";
				a.SJF();
				break;
			case 3 :
				cout<<"\n\n Scheduling Algorithm  ROUND ROBIN";
				a.ROUND_ROBIN();
				break;
		}
		getch();
	}while(ch);
	getch();
	return 1;
}

void algo::read()
{
	cout<<"\n\n Enter Total no. of Processes : ";
	cin>>n;

	for(int i = 0 ;i<n;i++)
	{
		p[i].name=i;
		cout<<"\nEnter Arrival time of p"<<i+1<<" : ";
		cin>>p[i].at;
		cout<<"\nEnter Burst time of p"<<i+1<<" : ";
		cin>>p[i].bt;
	}
}
	//p[i].wt=p[i].st-p[i].at;

void algo::display()
{
	int i=0,sum=0,sum1=0;

	cout<<"\n\nProcess start Finish Arrival Turnarround Waiting \n";
	for(i=0;i<n;i++)
	{
		p[i].tt=p[i].ft-p[i].at;
		cout<<"\n\n  p"<<p[i].name+1<<"\t  "<<p[i].st<<"\t"<<p[i].ft<<"\t"<<p[i].at<<"\t"<<p[i].tt<<"\t   "<<p[i].wt;
		sum+=p[i].tt;
		sum1+=p[i].wt;
	}

	cout<<"\n\n\t Average Turn Around Time : "<<(double)sum/n;
	cout<<"\n\n\t Average Waiting Time : "<<(double)sum1/n;

}

void queue::empty()
{
	ptr=0;
}

void queue::display()
{
	int i;
	cout<<"\n\n Queue -> ";
	i=0;
	/*	cout<<"| p";
		gotoxy(wherex()-3,wherey()+1);
		cout<<"0";
		gotoxy(wherex()+2,wherey()-1);
		cout<<p[i].name+1;*/
	for(i=0;i<ptr;i++)
	{
		cout<<"| p";
		gotoxy(wherex()-3,wherey()+1);
		cout<<p[i].st;
		gotoxy(wherex()+2,wherey()-1);
		cout<<p[i].name+1;
	}                            //gotoxy

	cout<<" | ";
	gotoxy(wherex()-3,wherey()+1);
	cout<<p[i-1].ft;

	cout<<"\n\n P0 process means IDLE TIME-No process ";
}

void queue::add(process t)
{
	p[ptr]=t;
	ptr++;
}

int queue::sort()
{
	int i,j;
	process t;

	for(i=0;i<ptr;i++)
		for(j=0;j<ptr;j++)
		{
			if(p[i].bt<p[j].bt)
			{
				t=p[i];
				p[i]=p[j];
				p[j]=t;
			}
		}
	return p[0].name;
}