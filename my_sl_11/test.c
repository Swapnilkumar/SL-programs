#include<stdio.h>
#include<sys/types.h>
#include<unistd.h>

int main()
{
	int i,id;
	printf("\nStarting main..");
	i=fork();
	sleep(10);
	if(i==0)
	{
		id=execl("child.o",(char*)0,(char*)0);
	}
	else
	{
		printf("\nParent Begins..\n\n");
		wait();
		printf("\nParent Ends..\n\n");
	}
	printf("\nExit from Main..\n\n");
	return 0;

}
