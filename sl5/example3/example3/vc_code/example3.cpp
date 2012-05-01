// example3.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"
#include "conio.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}

short _stdcall InPort(short portaddress)
    {
            return _inp(portaddress);
    }
short _stdcall OutPort(short portaddress , short data)
    {
           _outp(portaddress,data);
		   return 0;	
	}

