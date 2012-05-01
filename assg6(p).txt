
/* College Name			:	PICT
*   Subject			:	SL
*   Assignment No.		:	6
*   Title			:	Scheduling Algorithms
*   Software Used		:	Turbo C++
*   Start Date			:	28-02-11
*   Date Last Modified  	:	02-03-11
*   Developed By		:	Saumya.Nair
*   Roll No			:	3145
*   Data Structure Used		:	Queue,Circular Queue,2D-Array.
*/
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
	void insert(int p,int at,int bt)
	{
		p_no=p;
		arrival_time=at;
		burst_time=bt;
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
	Process a[50]; //To store a Process
	int num; //number of processes
	int rear;
	int front;
	int start_time;
	int finish_time;
	int turn_around_time;
	int waiting_time;
	Sequence s[50];
	int k;
	public:
	void insert();
	void display();
	void deletes();
	void exchange(Process*,Process*);
	void fcfs();
	void sjf();
	void rr();
	void check(int *);
};
void Queue::insert()
{
	rear=front=k=0;
	cout<<"Enter the number of processes\t";
	cin>>num;
	for(int i=0;i<num;i++)
		a[rear++].insert();
	for(i=0;i<num;i++)   //Sort the Queue on the basis of arrival_time
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
	cout<<finish_time<<"\n\nNote *P0 indicates No Process\n";
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

void insert_to_arr(int *ptr,int num,int p_no,int val)
{
	for(int i=0;i<num;i++)
	{
		if(*(ptr+(i*8))==p_no&&*(ptr+(i*8+7))==0)
		{
			*(ptr+(i*8+3))=val;
			*(ptr+(i*8+7))=1;
			break;
		}
	}
}

void insert_to_arr1(int *ptr,int num,int p_no,int val)
{
	for(int i=0;i<num;i++)
	{
		if(*(ptr+(i*8))==p_no)
		{
			*(ptr+(i*8+4))=val;
			*(ptr+(i*8+5))=val-*(ptr+(i*8+1));
			*(ptr+(i*8+6))=val-*(ptr+(i*8+1))-*(ptr+(i*8+2));
			break;
		}
	}
}

void Queue::rr()
{
	int quantum=0,time=a[front].arrival_time,arr[20][8];
	cout<<"Enter the quantum time \t";
	cin>>quantum;
	for(int i=front;i<rear;i++)
	{
		arr[i][0]=a[i].p_no;
		arr[i][1]=a[i].arrival_time;
		arr[i][2]=a[i].burst_time;
		arr[i][7]=0;

	}
	while(front<rear)
	{
		if(a[front].arrival_time>time)
			a[rear++].insert(a[front].p_no,a[front].arrival_time,a[front].burst_time);
		else
		{
			insert_to_arr(&arr[0][0],num,a[front].p_no,time);
			if(a[front].burst_time>quantum)
			{
				a[rear++].insert(a[front].p_no,a[front].arrival_time,a[front].burst_time-2);
				s[k++].insert(a[front].p_no,time);
				time+=2;
			}
			else if(a[front].burst_time<=quantum)
			{
				s[k++].insert(a[front].p_no,time);
				time+=a[front].burst_time;
				insert_to_arr1(&arr[0][0],num,a[front].p_no,time);
			}
		}
		front+=1;
		check(&time);
	}
	finish_time=time;
	cout<<"Process\tStart time  Finish time Arrival time  Turnaround time  Waiting time\n";
	for(i=0;i<num;i++)
		cout<<"\n"<<arr[i][0]<<"\t"<<arr[i][3]<<"\t    "<<arr[i][4]<<"\t\t"<<arr[i][1]<<"\t\t"<<arr[i][5]<<"\t\t"<<arr[i][6];
	display();
}

void Queue::check(int *time)
{
	int sh_time=999;
	if(front<rear)
	{
		for(int i=front;i<rear;i++)
		{
			if(a[i].arrival_time<*time)
				return;
			else if(a[i].arrival_time<sh_time)
				sh_time=a[i].arrival_time;
		}
		s[k++].insert(0,*time);
		*time=sh_time;
	}
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
				q.insert();
				q.rr();
				break;
		}
	}while(i!=4);
	getch();
}
/*


*******Output***********
Enter the choice
1:First Come First Serve Basis
2:Shortest Job First
3:Round Robin Scheduling
4:Exit
1
Enter the number of processes   4
Enter the process number        1
Enter the arrival time  2
Enter the burst time    3
Enter the process number        2
Enter the arrival time  3
Enter the burst time    2
Enter the process number        3
Enter the arrival time  9
Enter the burst time    1
Enter the process number        4
Enter the arrival time  11
Enter the burst time    2
Process Start time  Finish time Arrival time  Turnaround time  Waiting time

1       2           5           2               3               0
2       5           7           3               4               2
3       9           10          9               1               0
4       11          13          11              2               0


| P1    | P2    | P0    | P3    | P0    | P4    |
2       5       7       9       10      11      13

Note *P0 indicates No Process


Enter the choice
1:First Come First Serve Basis
2:Shortest Job First
3:Round Robin Scheduling
4:Exit
2
Enter the number of processes   5
Enter the process number        1
Enter the arrival time  0
Enter the burst time    3
Enter the process number        2
Enter the arrival time  2
Enter the burst time    6
Enter the process number        3
Enter the arrival time  4
Enter the burst time    4
Enter the process number        4
Enter the arrival time  6
Enter the burst time    5
Enter the process number        5
Enter the arrival time  8
Enter the burst time    2
Process Start time  Finish time Arrival time  Turnaround time  Waiting time

1       0           3           0               3               0
2       3           9           2               7               1
5       9           11          8               3               1
3       11          15          4               11              7
4       15          20          6               14              9


| P1    | P2    | P5    | P3    | P4    |
0       3       9       11      15      20

Note *P0 indicates No Process


Enter the choice
1:First Come First Serve Basis
2:Shortest Job First
3:Round Robin Scheduling
4:Exit
3
Enter the number of processes   4
Enter the process number        1
Enter the arrival time  0
Enter the burst time    3
Enter the process number        2
Enter the arrival time  2
Enter the burst time    6
Enter the process number        3
Enter the arrival time  10
Enter the burst time    2
Enter the process number        4
Enter the arrival time  11
Enter the burst time    2
Enter the quantum time  2
Process Start time  Finish time Arrival time  Turnaround time  Waiting time

1       0           5           0               5               2
2       2           9           2               7               1
3       10          12          10              2               0
4       12          14          11              3               1


| P1    | P2    | P1    | P2    | P2    | P0    | P3    | P4    |
0       2       4       5       7       9       10      12      14

Note *P0 indicates No Process

Enter the choice
1:First Come First Serve Basis
2:Shortest Job First
3:Round Robin Scheduling
4:Exit
4
*/