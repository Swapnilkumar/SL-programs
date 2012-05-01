// cal.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"
#include "math.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}

int _stdcall factr(int x)
{
	int fact=1;
	do
	{
		fact=fact*x;
		x--;
	}while(x!=1);
	return fact;
}

float _stdcall sqr(int x)
{
	float n;
	n=sqrt(x);
	return n;
}