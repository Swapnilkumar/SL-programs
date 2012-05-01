
/* College Name			:	PICT, pune
*   Subject			:	SOFTWARE LAB
*   Assignment No.		:	7
*   Title			:	Page Replacement Algorithm
*   Software Used		:	TC++
*   Start Date			:	10-03-11
*   Date Last Modified  	:	17-03-11
*   Developed By		:	Swapnilkumar Khorate
*   Roll No			:	3133
*   Data Structure Used		:	Array structure
*/
#include<iostream.h>
#include<conio.h>
#define MAX 30
#define SLOTS 20

int m[SLOTS];
int m1[SLOTS];
int pages[MAX];

class page
{
	int no_of_pages;
	int slots;
	public:
	page()
	{
		no_of_pages=0;
	}
	void read();
	void init_m();
	void display_m(int);
	void calculate_fault(int);
	void least_recently_used();
	void optimal_replacement();
};
void page::read()
{
	cout<<"Enter No. of pages : ";
	cin>>no_of_pages;
	cout<<"Enter Order in which pages occur : \n";
	for(int i=0;i<no_of_pages;i++)
		cin>>pages[i];
	cout<<"Enter the number of slotsry slots : ";
	cin>>slots;
}
void page::init_m()
{
	for(int i=0;i<slots;i++)
		m[i]=0;
}

void page::display_m(int i)
{
	cout<<"\n   "<<pages[i]<<" \t";
	for(int k=0;k<slots;k++)
		cout<<m[k]<<"\t";
}
void page::calculate_fault(int fault)
{
	cout<<"\n\nThe number of faults are\t"<<fault;
	float fault_percent=fault*100.0/no_of_pages;
	cout<<"\nThe fault percent is\t"<<fault_percent<<"\n";
}
void page::least_recently_used()
{
	int found=0,num=0,fault=0;
	init_m();

	cout<<"\n\n   Page  \tSlots \n\n   no.";
	for(int i=0;i<slots;i++)
		cout<<"\ts"<<i+1;
	cout<<"\n\n";

	for(i=0;i<no_of_pages;i++)
	{
		if(num<slots)          //initially slots are empty
		{
			for(int j=slots-1;j>0;j--)
				m[j]=m[j-1];
			m[0]=pages[i];
			num++;
			fault++;
		}
		else
		{
			found=0; //check if page is already in slot
			for(int j=0;j<slots;j++)
			{
				if(pages[i]==m[j])
				{
					for(int k=j;k>0;k--)
						m[k]=m[k-1];
					m[0]=pages[i];
					found=1;
					break;
				}
			} //replace least recently used page with current page
			if(found==0)
			{
				for(int j=slots-1;j>0;j--)
					m[j]=m[j-1];
				m[0]=pages[i];
				fault++;
			}
		}
		display_m(i);
	}
	calculate_fault(fault);
}
void page::optimal_replacement()
{
	int found=0,num=0,fault=0;
	init_m();

	cout<<"\n\n   Page  \tSlots \n\n   no.";
	for(int i=0;i<slots;i++)
		cout<<"\ts"<<i+1;
	cout<<"\n\n";

	for( i=0;i<no_of_pages;i++)
	{
		if(num<slots)
		{
			m[num]=pages[i];
			num++;
			fault++;
		}
		else
		{
			found=0;

			for(int j=0;j<slots;j++)
			{
				if(pages[i]==m[j])
				{
					found=1;
					break;
				}
			}
			for(j=0;j<slots;j++)
			{
				m1[j]=m[j];

			}
			if(found==0)
			{
				int max=-99,place=0;
				for(int j=0;j<slots;j++)
				{
					pages[no_of_pages+j]=m[j];

				}
				for( j=i+1;j<no_of_pages+slots;j++)
					for(int k=0;k<slots;k++)
						if(pages[j]==m1[k])
						{
							if(max<=j)
							{
								max=j;
								place=k;
								m1[k]=0;
							}
						}
				m[place]=pages[i];
				fault++;
			}
		}
		display_m(i);
	}
	calculate_fault(fault);
}

void main()
{
	clrscr();
	int i;
	page a;
	do
	{
		cout<<"\nEnter the choice\n  1] Least recently used\n  2] Optimal Replacement\n  3] Exit\n\n\t : ";
		cin>>i;
		switch(i)
		{
			case 1:
				a.read();
				a.least_recently_used();
				break;
			case 2:
				a.read();
				a.optimal_replacement();
				break;
		}
	}while(i!=3);
}


OUTPUT

Enter the choice
  1] Least recently used
  2] Optimal Replacement
  3] Exit

         : 1
Enter No. of pages : 18
Enter Order in which pages occur :
1 2 3 4 2 1 5 6 1 3 4 7 1 2 6 4 2 6

Enter the number of slotsry slots : 3


   Page         Slots

   no.  s1      s2      s3


   1    1       0       0
   2    2       1       0
   3    3       2       1
   4    4       3       2
   2    2       4       3
   1    1       2       4
   5    5       1       2
   6    6       5       1
   1    1       6       5
   3    3       1       6
   4    4       3       1
   7    7       4       3
   1    1       7       4
   2    2       1       7
   6    6       2       1
   4    4       6       2
   2    2       4       6
   6    6       2       4

The number of faults are        14
The fault percent is    77.777779

Enter the choice
  1] Least recently used
  2] Optimal Replacement
  3] Exit

         : 2 

Enter No. of pages : 18
Enter Order in which pages occur :
1 2 3 4 2 1 5 6 1 3 4 7 1 2 6 4 2 6
Enter the number of slotsry slots : 3


   Page         Slots

   no.  s1      s2      s3


   1    1       0       0
   2    1       2       0
   3    1       2       3
   4    1       2       4
   2    1       2       4
   1    1       2       4
   5    1       5       4
   6    1       6       4
   1    1       6       4
   3    1       3       4
   4    1       3       4
   7    1       7       4
   1    1       7       4
   2    1       2       4
   6    6       2       4
   4    6       2       4
   2    6       2       4
   6    6       2       4

The number of faults are        10
The fault percent is    55.555557

Enter the choice
  1] Least recently used
  2] Optimal Replacement
  3] Exit

         : 3 

