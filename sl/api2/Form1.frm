VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   2835
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   4680
   LinkTopic       =   "Form1"
   ScaleHeight     =   2835
   ScaleWidth      =   4680
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command8 
      Caption         =   "Log Off"
      Height          =   495
      Left            =   1800
      TabIndex        =   7
      Top             =   2040
      Width           =   1215
   End
   Begin VB.CommandButton Command7 
      Caption         =   "Set Color"
      Height          =   495
      Left            =   1800
      TabIndex        =   6
      Top             =   1440
      Width           =   1215
   End
   Begin VB.CommandButton Command6 
      Caption         =   "Get Color"
      Height          =   495
      Left            =   1800
      TabIndex        =   5
      Top             =   840
      Width           =   1215
   End
   Begin VB.CommandButton Command5 
      Caption         =   "Free_Space"
      Height          =   495
      Left            =   1800
      TabIndex        =   4
      Top             =   240
      Width           =   1215
   End
   Begin VB.CommandButton Command4 
      Caption         =   "Notepad"
      Height          =   495
      Left            =   360
      TabIndex        =   3
      Top             =   2040
      Width           =   1215
   End
   Begin VB.CommandButton Command3 
      Caption         =   "CompName"
      Height          =   495
      Left            =   360
      TabIndex        =   2
      Top             =   1440
      Width           =   1215
   End
   Begin VB.CommandButton Command2 
      Caption         =   "System dir"
      Height          =   495
      Left            =   360
      TabIndex        =   1
      Top             =   840
      Width           =   1215
   End
   Begin VB.CommandButton Command1 
      Caption         =   "User Name"
      Height          =   495
      Left            =   360
      TabIndex        =   0
      Top             =   240
      Width           =   1215
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function GetUserName Lib "advapi32.dll" Alias "GetUserNameA" (ByVal lpBuffer As String, nSize As Long) As Long
Dim d As Long
Dim st As String * 20
Private Declare Function GetSystemDirectory Lib "kernel32" Alias "GetSystemDirectoryA" (ByVal lpBuffer As String, ByVal nSize As Long) As Long
Private Declare Function GetComputerName Lib "kernel32" Alias "GetComputerNameA" (ByVal lpBuffer As String, nSize As Long) As Long
Private Declare Function WinExec Lib "kernel32" (ByVal lpCmdLine As String, ByVal nCmdShow As Long) As Long
Private Declare Function GetDiskFreeSpace Lib "kernel32" Alias "GetDiskFreeSpaceA" (ByVal lpRootPathName As String, lpSectorsPerCluster As Long, lpBytesPerSector As Long, lpNumberOfFreeClusters As Long, lpTotalNumberOfClusters As Long) As Long
Private Declare Function GetSysColor Lib "user32" (ByVal nIndex As Long) As Long
Private Declare Function SetSysColors Lib "user32" (ByVal nChanges As Long, lpSysColor As Long, lpColorValues As Long) As Long
Private Declare Function ExitWindowsEx Lib "user32" (ByVal uFlags As Long, ByVal dwReserved As Long) As Long






Private Sub Command1_Click()
d = GetUserName(st, 20)
MsgBox st
End Sub

Private Sub Command2_Click()
d = GetSystemDirectory(st, 20)
MsgBox Str
End Sub

Private Sub Command3_Click()
d = GetComputerName(st, 20)
MsgBox st
End Sub


Private Sub Command4_Click()
d = WinExec("notepad.exe", 1)
End Sub

Private Sub Command5_Click()
Dim a, b, c, f As Long
f = GetDiskFreeSpace("c:\", a, b, c, d)
MsgBox ("   C DRIVE  " + vbNewLine + "Total Size:" + Str(a * b * d / (1048576)) + vbNewLine + "  Free Size:" + Str(a * b * c / (1048576)))
f = GetDiskFreeSpace("d:\", a, b, c, d)
MsgBox ("   D DRIVE  " + vbNewLine + "Total Size:" + Str(a * b * d / (1048576)) + vbNewLine + "  Free Size:" + Str(a * b * c / (1048576)))
f = GetDiskFreeSpace("e:\", a, b, c, d)
MsgBox ("   E DRIVE  " + vbNewLine + "Total Size:" + Str(a * b * d / (1048576)) + vbNewLine + "  Free Size:" + Str(a * b * c / (1048576)))

End Sub

Private Sub Command6_Click()
d = GetSysColor(5)
MsgBox d
'16777215
End Sub

Private Sub Command7_Click()
d = SetSysColors(1, 5, 16777215)
End Sub

'Const COLOR_SCROLLBAR = 0 'The Scrollbar colour
'Const COLOR_BACKGROUND = 1 'Colour of the background with no wallpaper
'Const COLOR_ACTIVECAPTION = 2 'Caption of Active Window
'Const COLOR_INACTIVECAPTION = 3 'Caption of Inactive window
'Const COLOR_MENU = 4 'Menu
'Const COLOR_WINDOW = 5 'Windows background
'Const COLOR_WINDOWFRAME = 6 'Window frame
'Const COLOR_MENUTEXT = 7 'Window Text
'Const COLOR_WINDOWTEXT = 8 '3D dark shadow (Win95)
'Const COLOR_CAPTIONTEXT = 9 'Text in window caption
'Const COLOR_ACTIVEBORDER = 10 'Border of active window
'Const COLOR_INACTIVEBORDER = 11 'Border of inactive window
'Const COLOR_APPWORKSPACE = 12 'Background of MDI desktop
'Const COLOR_HIGHLIGHT = 13 'Selected item background
'Const COLOR_HIGHLIGHTTEXT = 14 'Selected menu item
'Const COLOR_BTNFACE = 15 'Button
'Const COLOR_BTNSHADOW = 16 '3D shading of button
'Const COLOR_GRAYTEXT = 17 'Grey text, of zero if dithering is used.
'Const COLOR_BTNTEXT = 18 'Button text
'Const COLOR_INACTIVECAPTIONTEXT = 19 'Text of inactive window
'Const COLOR_BTNHIGHLIGHT = 20 '3D highlight of button
'Const COLOR_2NDACTIVECAPTION = 27 'Win98 only: 2nd active window color
'Const COLOR_2NDINACTIVECAPTION = 28 'Win98 only: 2nd inactive window color



'Declare Function ExitWindowsEx Lib "user32.dll" (ByVal uFlags As _
'Long, ByVal dwReserved As Long) As Long
'
'uFlags
'One or more of the following flags specifying how to shut down or reboot the computer:
'EWX_FORCE = 4
'Force any applications to quit instead of prompting the user to close them.
'EWX_LOGOFF = 0
'Log off the network.
'EWX_POWEROFF = 8
'Shut down the system and, if possible, turn the computer off.
'EWX_REBOOT = 2
'Perform a full reboot of the system.
'EWX_SHUTDOWN = 1
'Shut down the system.
'dwReserved
'Reserved for future versions of Windows. Always set to 0.
'

Private Sub Command8_Click()
d = ExitWindowsEx(4, 0)
End Sub
