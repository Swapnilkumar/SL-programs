#include<stdio.h>
#include<sys/types.h>
#include<unistd.h>

int main()
{
	char a[10];
	printf("\nChild Process Begins..\n");
	scanf("%s",a);
	scanf("%s",a);
	sleep(10);
	printf("\nChild Process Ends..\n");
	printf("\nReturning Back to Main program\n");
	return 0;
}
