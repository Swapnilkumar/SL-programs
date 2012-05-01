VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   5220
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   7065
   LinkTopic       =   "Form1"
   ScaleHeight     =   5220
   ScaleWidth      =   7065
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox Text7 
      Height          =   495
      Left            =   2400
      TabIndex        =   12
      Top             =   240
      Width           =   1335
   End
   Begin VB.TextBox Text6 
      Height          =   495
      Left            =   5040
      TabIndex        =   11
      Top             =   4320
      Width           =   1455
   End
   Begin VB.TextBox Text5 
      Height          =   495
      Left            =   5040
      TabIndex        =   8
      Top             =   3600
      Width           =   1455
   End
   Begin VB.TextBox Text4 
      Height          =   495
      Left            =   5040
      TabIndex        =   6
      Top             =   2880
      Width           =   1455
   End
   Begin VB.TextBox Text3 
      Height          =   495
      Left            =   5040
      TabIndex        =   3
      Top             =   2160
      Width           =   1455
   End
   Begin VB.TextBox Text2 
      Height          =   495
      Left            =   5040
      TabIndex        =   2
      Top             =   1440
      Width           =   1455
   End
   Begin VB.TextBox Text1 
      Height          =   495
      Left            =   720
      TabIndex        =   1
      Top             =   240
      Width           =   1455
   End
   Begin VB.CommandButton Command1 
      Caption         =   "Command1"
      Height          =   495
      Left            =   1440
      TabIndex        =   0
      Top             =   1560
      Width           =   1575
   End
   Begin VB.Label Label5 
      Caption         =   "compare"
      Height          =   375
      Left            =   4080
      TabIndex        =   10
      Top             =   4320
      Width           =   855
   End
   Begin VB.Label Label4 
      Caption         =   "Concat"
      Height          =   375
      Left            =   4080
      TabIndex        =   9
      Top             =   3720
      Width           =   1215
   End
   Begin VB.Label Label3 
      Caption         =   "Pailendrom"
      Height          =   375
      Left            =   4080
      TabIndex        =   7
      Top             =   3000
      Width           =   855
   End
   Begin VB.Label Label2 
      Caption         =   "Reverse"
      Height          =   375
      Left            =   4080
      TabIndex        =   5
      Top             =   1560
      Width           =   855
   End
   Begin VB.Label Label1 
      Caption         =   "length"
      Height          =   495
      Left            =   4080
      TabIndex        =   4
      Top             =   2280
      Width           =   1215
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function rev Lib "String1.dll" (ByVal x As String) As String
Private Declare Function lent Lib "String1.dll" (ByVal x As String) As Integer
Private Declare Function pal Lib "String1.dll" (ByVal x As String) As Integer
Private Declare Function cct Lib "String1.dll" (ByVal x As String, ByVal y As String) As String
Private Declare Function cmp Lib "String1.dll" (ByVal x As String, ByVal y As String) As Integer




Private Sub Command1_Click()
Text2.Text = rev(Text1.Text)
Text3.Text = lent(Text1.Text)
Text4.Text = pal(Text1.Text)
Text5.Text = cct(Text1.Text, Text7.Text)
Text6.Text = cmp(Text1.Text, Text7.Text)
End Sub
