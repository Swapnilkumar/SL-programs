// sl5.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}

double _stdcall sum(double* x , double* y)
{
	return *x+*y;
}


double _stdcall sub1(double x , double y)
{
	return x-y;
}

double _stdcall mult(double x , double y)
{
	return x*y;
}


double _stdcall div1(double x , double y)
{
	return (x/y);
}
