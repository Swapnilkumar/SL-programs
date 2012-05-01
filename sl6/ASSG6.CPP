#include<iostream.h>
#include<conio.h>

class Process{
	int p_no;
	int arrival_time;
	int burst_time;
	public:
	void insert()
	{
		cout<<"Enter the process number\t";
		cin>>p_no;
		cout<<"Enter the arrival time\t";
		cin>>arrival_time;
		cout<<"Enter the burst time\t";
		cin>>burst_time;
	}
	friend Queue;
};

class Sequence{
	int p_no;
	int start_time;
	public:
	friend class Queue;
	void insert(int p_no,int st)
	{
		this->p_no=p_no;
		start_time=st;
	}
};

class Queue{
	Process a[50];
	int num; //number of processes
	int rear;
	int front;
	int start_time;
	int finish_time;
	int turn_around_time;
	int waiting_time;
	Sequence s[20];
	int k;
	public:
	Queue()
	{
		rear=0;
		front=0;
		k=0;
	}
	void insert();
	void display();
	void deletes();
	void exchange(Process*,Process*);
	void fcfs();
	void sjf();
	void rr();
};
void Queue::insert()
{
	cout<<"Enter the number of processes\t";
	cin>>num;
	for(int i=0;i<num;i++)
		a[rear++].insert();
	for(i=0;i<num;i++)
		for(int j=i+1;j<num;j++)
			if(a[j].arrival_time<a[i].arrival_time)
				exchange(&a[i],&a[j]);
}

void Queue::fcfs()
{
	cout<<"Process\tStart time  Finish time Arrival time  Turnaround time  Waiting time\n";
	start_time=a[front].arrival_time;
	finish_time=0;
	while(front<rear)
		deletes();
	display();
}

void Queue::sjf()
{
	start_time=a[front].arrival_time;
	finish_time=0;
	cout<<"Process\tStart time  Finish time Arrival time  Turnaround time  Waiting time\n";
	while(front<rear)
	{
		deletes();
		int sh_time=999;
		for(int j=front;j<rear;j++)
		{
			if(a[j].arrival_time<finish_time&&sh_time>a[j].burst_time)
			{
				sh_time=a[j].burst_time;
				exchange(&a[j],&a[front]);
			}
		}
	}
	display();
}

void Queue::deletes()
{
	finish_time=start_time+a[front].burst_time;
	waiting_time=start_time-a[front].arrival_time;
	turn_around_time=finish_time-a[front].arrival_time;
	cout<<"\n"<<a[front].p_no<<"\t"<<start_time<<"\t    "<<finish_time<<"\t\t"<<a[front].arrival_time<<"\t\t"<<turn_around_time<<"\t\t"<<waiting_time;
	s[k++].insert(a[front].p_no,start_time);
	start_time=finish_time;
	front+=1;
	if(start_time<a[front].arrival_time&&front<rear)
	{
		start_time=a[front].arrival_time;
		s[k++].insert(0,finish_time);
	}
}

void Queue::display()
{
	cout<<"\n\n\n";
	for(int i=0;i<k;i++)
		cout<<"| P"<<s[i].p_no<<"\t";
	cout<<"|\n";
	for(i=0;i<k;i++)
		cout<<s[i].start_time<<"\t";
	cout<<finish_time;
}

void Queue::exchange(Process *i,Process *j)
{
	int temp;
	temp=i->arrival_time;
	i->arrival_time=j->arrival_time;
	j->arrival_time=temp;
	temp=i->burst_time;
	i->burst_time=j->burst_time;
	j->burst_time=temp;
	temp=i->p_no;
	i->p_no=j->p_no;
	j->p_no=temp;

}
void Queue::rr()
{
	int quantum=0;
	cout<<"Enter the quantum time \t";
	cin>>quantum;
}

void main()
{
	clrscr();
	Queue q;
	int i;
	do
	{

		cout<<"\nEnter the choice\n1:First Come First Serve Basis\n2:Shortest Job First\n3:Round Robin Scheduling\n4:Exit\n";
		cin>>i;
		switch(i)
		{
			case 1:
				q.insert();
				q.fcfs();
				break;
			case 2:
				q.insert();
				q.sjf();
				break;
			case 3:
				q.rr();
				break;
		}
	}while(i!=4);
	getch();
}