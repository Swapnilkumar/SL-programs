#include<stdio.h>
#include<conio.h>
#include<iostream.h>
class node
{    public:
	int pgNo;
	node *next;
	node()
	{
		next=NULL;
	}
};
class frame
{
	public:
	int fNo;  //frame no
	int state;   //how long refer in the string
};
class pageReplace
{
	node *head,*p;
	int count;
	int frames;
	frame *f;
	public:
	pageReplace()
	{
		head=NULL;
		count=0;
		p=NULL;
	}
	void input();
	void lru();   //lru function
	void optimal();   //optimal page replacement function
};
void pageReplace::input()
{
	cout<<"ENTER REFERENCE STRING (NOTE ENTER -1 TO EXIT) :  ";
	cout<<"\n";
	int i;
	cin>>i;

	node *temp;
	while(i>=0)
	{
		temp=new(node);
		temp->pgNo=i;
		if(head==NULL)
		{
		   head=p=temp;
		}
		else
		{
			p->next=temp;
			p=p->next;
		}
		count++;
		cin>>i;
	}
	p=head;
       /*	while(p!=NULL)
	{
		cout<<"\n"<<p->pgNo;
		p=p->next;
	}*/
	cout<<"\nENTER NO OF FRAMES : ";
	cin>>frames;
	f=new frame[frames];
	 i=0;
	for(i=0;i<frames;i++)  //first make all frame empty
	{
		f[i].fNo=-1;
		f[i].state=0;
	}
}
void pageReplace::lru()
{
	node *traverse;
	traverse=head;
	int hit;
	float fault=0;
	while(traverse!=NULL)
	{
		int i=0,k=0;
		hit=0;
		 for(i=0;i<frames;i++)
		 {
			  if(f[i].fNo==traverse->pgNo)  //
			  {
				f[i].state=0;
				hit=1;
				continue;
			  }
			  if(f[i].fNo==-1 && hit==0)
			  {
				 f[i].fNo=traverse->pgNo;  //assign the page to frame
				 f[i].state=0;
			 //	   cout<<"*";

				 hit=1;
				 fault++;   //fault find
			  }
			  else
			  {
				f[i].state++;
			  }
			  //cout<<"*";
		 }
		 if(hit==0)
		 {
			i=0,k=0;
			fault++;
			while(i<frames)
			{
				if(f[i].state>f[k].state)  //if page not found
				{
					k=i;

				}
				i++;
			 }
			 i=0;
			 while(i<frames)
			 {
				if(i==k)
				{
					f[i].fNo=traverse->pgNo;  //replace the least recently used
								  // page by new page
					f[i].state=0;

				}
				else
				{
					f[i].state++;
				}
				i++;
			 }

		 }
		 cout<<"\n";      //print all page
		 for(i=0;i<frames;i++)
		 {    	cout<<f[i].fNo<<"  ";
		  // cout<<"*";

		 }
			 traverse=traverse->next;

	}
	cout<<"\n\n\n\tAVERAGE PAGE FAULT = "<<fault/count;
}
void pageReplace::optimal()
{
	node *traverse;
	traverse=head;
	int hit;
	float fault=0;
	int i=0,k=0;
	for(i=0;i<frames;i++)
	{
		f[i].fNo=-1;
		f[i].state=0;  //page not visit
	}
	while(traverse!=NULL)
	{

		hit=0;
		 for(i=0;i<frames;i++)
		 {
			  if(f[i].fNo==traverse->pgNo)
			  {
				f[i].state=0;
				hit=1;
				break;
			  }
			  if(f[i].fNo==-1 && hit==0)
			  {
				 f[i].fNo=traverse->pgNo;
				 f[i].state=0;
				 hit=1;
				 fault++;
			  }
			  else
			  {
				f[i].state++;
			  }
		 }
		//cout<<"HIT ="<<hit;
		 if(hit==0)
		 {
			i=0;
			 k=0;
			 fault++;
			while(i<frames)
			{       int j;
				node *tmp=traverse->next;
				for( j=0;tmp!=NULL;j++)
				{
					if(f[i].fNo==tmp->pgNo)   //find the page not longer needed

					{
					      break;
					}
					tmp=tmp->next;
				}
				f[i].state=j;
				if(f[i].state>f[k].state)
					k=i;
				i++;
			}
			f[k].fNo=traverse->pgNo;   //assign the new page


		 }
		 cout<<"\n";                 //print the page
		 for(i=0;i<frames;i++)
		 {
			cout<<f[i].fNo<<"  ";
		 }
		       traverse=traverse->next;

	}
	cout<<"\n\n\n\n\tAVERAGE PAGE FAULT = "<<fault/count;  //average page fault
}

int main()
{   pageReplace p;
clrscr();
	p.input();
	getch();
	clrscr();
	cout<<"\n\n\nLeast Recently Used Page Algorithm\n\n";
	p.lru();
       getch();
	clrscr();
	cout<<"\n\n\nOptimal page Replacement Algorithm\n\n";

	p.optimal();
	getch();
	return 0;
}
