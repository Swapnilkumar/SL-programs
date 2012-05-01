// String1.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}


char * _stdcall rev(char *c)
{
	char *p;
	p=strrev(c);
	return(p);
}

int _stdcall lent(char *c)
{
	int l=0;
	do
	{
		c++;
		l++;
	}while(*c!='\0');
	return l;
}

int _stdcall pal(char c[])
{	
	int r,count=0;
	r=strlen(c);
	for(int i=0;i<r;i++)
	{
		if(c[i]==c[r-i-1])
			count++;
	}
	if(count==r)
		return 1;
	else
		return 0;
}

char * _stdcall cct(char c[],char d[])
{
	strcat(c,d);
	return c;
}

int _stdcall cmp(char c[],char p[])
{
	int r;
	r=strcmp(c,p);
	return r;
}

		
