// example2.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"
#include "string.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}

char* _stdcall to_upper(char *lowerstring)
{
_strupr(lowerstring);
return lowerstring;
}