// MakeTempFilenameDLL.cpp : Defines the entry point for the DLL application.
//

#include "stdafx.h"

BOOL APIENTRY DllMain( HANDLE hModule, 
                       DWORD  ul_reason_for_call, 
                       LPVOID lpReserved
					 )
{
    return TRUE;
}

char szReturn[MAX_PATH];

__declspec(dllexport) LPCTSTR RetrieveTempFilename(LPCTSTR szDirectory, 
												   LPCTSTR szPrefix)
{
	char szBuffer[MAX_PATH];
	
	if(GetTempFileName(szDirectory,szPrefix,0,szBuffer) == 0)
	{
		// It failed - return the string "ERROR"
		lstrcpy(szReturn,"ERROR");
	} else
	{
		// Success!
		lstrcpy(szReturn,szBuffer);
	}

	return szReturn;
}