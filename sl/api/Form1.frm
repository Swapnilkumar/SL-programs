VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   6795
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   6525
   LinkTopic       =   "Form1"
   ScaleHeight     =   6795
   ScaleWidth      =   6525
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command8 
      Caption         =   "SET SYS COLOR"
      Height          =   495
      Left            =   4320
      TabIndex        =   16
      Top             =   5520
      Width           =   1455
   End
   Begin VB.CommandButton Command7 
      Caption         =   "RESTART"
      Height          =   495
      Left            =   3120
      TabIndex        =   15
      Top             =   4800
      Width           =   1575
   End
   Begin VB.CommandButton Command6 
      Caption         =   "SHUT DOWN"
      Height          =   495
      Left            =   2160
      TabIndex        =   14
      Top             =   5400
      Width           =   1575
   End
   Begin VB.CommandButton Command5 
      Caption         =   "CALCULATOR"
      Height          =   495
      Left            =   3120
      TabIndex        =   13
      Top             =   4200
      Width           =   1575
   End
   Begin VB.CommandButton Command4 
      Caption         =   "NOTEPAD"
      Height          =   495
      Left            =   3120
      TabIndex        =   3
      Top             =   3600
      Width           =   1575
   End
   Begin VB.CommandButton Command3 
      Caption         =   "GET SYS COLOR"
      Height          =   495
      Left            =   1320
      TabIndex        =   2
      Top             =   4800
      Width           =   1575
   End
   Begin VB.CommandButton Command2 
      Caption         =   "GET SYS DIR"
      Height          =   495
      Left            =   1320
      TabIndex        =   1
      Top             =   4200
      Width           =   1575
   End
   Begin VB.CommandButton Command1 
      Caption         =   "LOG OFF"
      Height          =   495
      Left            =   1320
      TabIndex        =   0
      Top             =   3600
      Width           =   1575
   End
   Begin VB.Line Line1 
      Index           =   2
      X1              =   1200
      X2              =   5040
      Y1              =   3360
      Y2              =   3360
   End
   Begin VB.Label Label8 
      Caption         =   "e drive"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   720
      TabIndex        =   12
      Top             =   2640
      Width           =   5175
   End
   Begin VB.Label Label7 
      Caption         =   "d drive"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   720
      TabIndex        =   11
      Top             =   2280
      Width           =   5175
   End
   Begin VB.Label Label6 
      Caption         =   "c drive"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   720
      TabIndex        =   10
      Top             =   1920
      Width           =   4935
   End
   Begin VB.Line Line1 
      Index           =   1
      X1              =   1200
      X2              =   5040
      Y1              =   1440
      Y2              =   1440
   End
   Begin VB.Line Line1 
      Index           =   0
      X1              =   1200
      X2              =   5040
      Y1              =   600
      Y2              =   600
   End
   Begin VB.Label Lab 
      Caption         =   "DISK INFORMATION"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   2040
      TabIndex        =   9
      Top             =   1560
      Width           =   2415
   End
   Begin VB.Label Label5 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   3000
      TabIndex        =   8
      Top             =   1080
      Width           =   1455
   End
   Begin VB.Label Label4 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   3000
      TabIndex        =   7
      Top             =   720
      Width           =   1455
   End
   Begin VB.Label Label3 
      Caption         =   "USER NAME:"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1560
      TabIndex        =   6
      Top             =   1080
      Width           =   1695
   End
   Begin VB.Label Label2 
      Caption         =   "COMP NAME:"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1560
      TabIndex        =   5
      Top             =   720
      Width           =   1695
   End
   Begin VB.Label Label1 
      Caption         =   "WINDOWS API"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   18
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Left            =   1920
      TabIndex        =   4
      Top             =   120
      Width           =   2535
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function ExitWindowsEx Lib "user32" (ByVal uFlags As Long, ByVal dwReserved As Long) As Long
Private Declare Function GetComputerName Lib "kernel32" Alias "GetComputerNameA" (ByVal lpBuffer As String, nSize As Long) As Long

Dim d As Long
Dim st As String * 20
Private Declare Function GetUserName Lib "advapi32.dll" Alias "GetUserNameA" (ByVal lpBuffer As String, nSize As Long) As Long
Private Declare Function GetSystemDirectory Lib "kernel32" Alias "GetSystemDirectoryA" (ByVal lpBuffer As String, ByVal nSize As Long) As Long
Private Declare Function GetDiskFreeSpace Lib "kernel32" Alias "GetDiskFreeSpaceA" (ByVal lpRootPathName As String, lpSectorsPerCluster As Long, lpBytesPerSector As Long, lpNumberOfFreeClusters As Long, lpTotalNumberOfClusters As Long) As Long
Private Declare Function GetSysColor Lib "user32" (ByVal nIndex As Long) As Long
Private Declare Function WinExec Lib "kernel32" (ByVal lpCmdLine As String, ByVal nCmdShow As Long) As Long
Private Declare Function SetSysColors Lib "user32" (ByVal nChanges As Long, lpSysColor As Long, lpColorValues As Long) As Long



Private Sub Command1_Click()
d = ExitWindowsEx(EWX_LOGOFF, EWX_FORCE)
End Sub

Private Sub Command2_Click()
d = GetSystemDirectory(st, 20)
MsgBox st
End Sub

Private Sub Command3_Click()
MsgBox ("Background Color: " + Str(GetSysColor(1)) + vbNewLine + "Active Caption Color: " + Str(GetSysColor(2)) + vbNewLine + "Inactive Caption Color: " + Str(GetSysColor(3)) + vbNewLine + "Caption Text Color: " + Str(GetSysColor(9)) + vbNewLine + "Menu Text Color: " + Str(GetSysColor(7)) + vbNewLine + "Scroll bar color:" + Str(GetSysColor(0)))
End Sub

Private Sub Command4_Click()
d = WinExec("notepad.exe", 1)
End Sub

Private Sub Command5_Click()
d = WinExec("shutdown -s -t 0", 1)
End Sub

Private Sub Command6_Click()
d = ExitWindowsEx(EWX_SHUTDOWN, EWX_FORCE)
End Sub

Private Sub Command7_Click()
d = ExitWindowsEx(EWX_REBOOT, EWX_FORCE)
End Sub

Private Sub Command8_Click()
Dim a As Long
a = InputBox("Enter color value")
d = SetSysColors(4, 5, a)
End Sub

Private Sub Form_Load()
d = GetComputerName(st, 20)
Label4.Caption = st
d = GetUserName(st, 20)
Label5.Caption = st

Dim a, b, c As Long
Dim size As Long
Dim r As String
'Dim SInfo As SYSTEM_INFO
r = GetDiskFreeSpace("c:\", a, b, c, d)
Label6.Caption = "C: " + Str(a * b * d / 1048576) + "MB total " + Str(a * b * c / 1048576) & " MB free "
r = GetDiskFreeSpace("d:\", a, b, c, d)
Label7.Caption = "D: " + Str(a * b * d / 1048576) + "MB total " + Str(a * b * c / 1048576) & " MB free "
r = GetDiskFreeSpace("f:\", a, b, c, d)
Label8.Caption = "F: " + Str(a * b * d / 1048576) + "MB total  " + Str(a * b * c / 1048576) & " MB free "

End Sub

