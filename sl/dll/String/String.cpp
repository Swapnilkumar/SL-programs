// String.cpp : Defines the entry point for the DLL application.
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
	//int l;
	//l=strlen(c);
	//return l;
	int l=0;
	do
	{
		c++;
		l++;
	}while(*c!='\0');
	return l;
}

int _stdcall pal(char *c)
{
	char *p;
	int r;
	p=strrev(c);
	r=strcmp(p,c);
	return r;
}

char * _stdcall cct(char *c,char *d)
{
	int l1;
	l1=strlen(c);
	do
	{
		c++;
		l1--;
	}
	while(l1!=0);
	l1=strlen(d);
	do
	{
		*c=*d;
		c++;
		d++;
		l1--;
	}while(l1!=0);
	*c='\0';
	return c;
}

int _stdcall cmp(char c[],char p[])
{
	int r;
	r=strcmp(c,p);
	return r;
}

		
