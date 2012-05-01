#include<conio.h>
#include<stdio.h>
#include<iostream.h>

struct page
{
	int index;
	int pg;
}p[10];
//getmax will compute the page number which has largest index
int getmax()
{
	int k=0,max=0;
	for(int i=0;i<10;i++)
		if(p[i].index>max)
		{
			max=p[i].index;
			k=i;
		}
	return k;
}
void fifo(int a[30],int n,int size)
{
	int j,found=0;
	j=0;
	int i=0;
	int fault=0;
	while(i<n)
	{
		found=0;
		//check weather page already present or not
		for(j=0;j<size;j++)
		{
			if(p[j].pg==a[i])
				found=1;
		}
		//if page not found then change it...
		if(found==0)
		{
			j=0;
			while(p[j].pg!=999)
				j++;
			//change wen page frame is not full
			
			if(j<size)
			{
				while(j>0)
				{
					p[j]=p[j-1];
					j--;
				}
				p[0].pg=a[i];
			}
			//page frame is full (fault occurs)
			else
			{
				fault++;
				j=size-1;
				while(j>0)
				{
					p[j]=p[j-1];
					j--;
				}
				p[0].pg=a[i];
			}
		}
		//Print pages..
		for(int m=0;m<size;m++)
		{
			cout<<p[m].pg;
			cout<<"     ";
		}
		cout<<"\n";
		i++;
	}
}
void lru(int a[30],int n,int size)
{
	int j,found=0;
	j=0;
	int i=0;
	int fault=0;
	while(i<n)
	{
		found=0;
		//check weather page already present or not
		for(j=0;j<size;j++)
		{
			if(p[j].pg==a[i])
				found=1;
		}
		//place the cuttent page at 0th location and shift others page...
		if(found==1)
		{
			j=0;
			while(p[j].pg!=a[i])
				j++;
			while(j>0)
			{
				p[j]=p[j-1];
				j--;
			}
			p[0].pg=a[i];
		}
		//if page not found then change it...
		if(found==0)
		{
			j=0;
			while(p[j].pg!=999)
				j++;
			//change wen page frame is not full
			if(j<size)
			{
				while(j>0)
				{
					p[j]=p[j-1];
					j--;
				}
				p[0].pg=a[i];
			}
			//page frame is full (fault occurs)
			else
			{
				fault++;
				j=size-1;
				while(j>0)
				{
					p[j]=p[j-1];
					j--;
				}
				p[0].pg=a[i];
			}
		}
		//Print pages..
		for(int m=0;m<size;m++)
		{
			cout<<p[m].pg;
			cout<<"     ";
		}
		cout<<"\n";
		i++;
	}
}
void opt(int a[30],int n,int size)
{
	int i=0,j,found=0,fault=0;

	while(i<n)
	{
		j=0;
		found=0;
		while(j<size)
		{
			if(p[j].pg==a[i])
				found=1;
			j++;
		}
		if(found==0)
		{
			j=0;
			while(p[j].pg!=999)
			{
				j++;
			}
			if(j<size)
				p[j].pg=a[i];
			else
			{
			for(int k=0;k<size;k++)
			{
				int temp=99;
				for(int m=i+1;m<n;m++)
				{
					if(a[m]==p[k].pg)
					{
						temp=m-i;
						break;
					}
				}
				p[k].index=temp;
			}
			int x=getmax();
			p[x].pg=a[i];
			fault++;
			}
		}
		for(int d=0;d<size;d++)
		{
			cout<<p[d].pg;
			cout<<"     ";
		}
		cout<<"\n";
		i++;
		
	}
}

int main()
{
	int ch,size,n,a[30];
	cout<<"Enter Frame Size:";
	cin>>size;
	cout<<"Enter number of pages:";
	cin>>n;
	cout<<"Enter sequence of pages:";
	for(int i=0;i<n;i++)
		cin>>a[i];

	up:
	for(i=0;i<10;i++)
	{
		p[i].index=0;
		p[i].pg=999;
	}
		
	cout<<"1. FIFO\n";
	cout<<"2. LRU\n";
	cout<<"3. OPT\n";
	cout<<"4. Exit";
	cin>>ch;

	switch(ch)
	{
		case 1:
			fifo(a,n,size);
			break;
		case 2:
			lru(a,n,size);
			break;

		case 3:
			opt(a,n,size);
			break;

	}
	if(ch!=4)
		goto up;
	getch();
	return 0;
}