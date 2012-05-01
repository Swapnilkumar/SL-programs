VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   1950
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   3630
   LinkTopic       =   "Form1"
   LockControls    =   -1  'True
   ScaleHeight     =   1950
   ScaleWidth      =   3630
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command2 
      Caption         =   "Read it"
      Height          =   330
      Left            =   1995
      TabIndex        =   5
      Top             =   1320
      Width           =   1155
   End
   Begin VB.TextBox Text3 
      Height          =   330
      Left            =   1995
      TabIndex        =   4
      Text            =   "0"
      Top             =   840
      Width           =   1155
   End
   Begin VB.CommandButton Command1 
      Caption         =   "Write it"
      Height          =   330
      Left            =   315
      TabIndex        =   3
      Top             =   1320
      Width           =   1155
   End
   Begin VB.TextBox Text2 
      Height          =   330
      Left            =   1650
      TabIndex        =   1
      Text            =   "378"
      Top             =   165
      Width           =   1125
   End
   Begin VB.TextBox Text1 
      Height          =   330
      Left            =   315
      TabIndex        =   0
      Text            =   "0"
      Top             =   840
      Width           =   1155
   End
   Begin VB.Label Label1 
      Caption         =   "Address   0X"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   300
      Left            =   285
      TabIndex        =   2
      Top             =   195
      Width           =   1410
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function InPort Lib "example3.dll" (ByVal portaddress As Integer) As Integer
Private Declare Function OutPort Lib "example3.dll" (ByVal portaddress As Integer, ByVal data As Integer) As Integer

Private Sub Command1_Click()
OutPort 888, 10 'Val("&h" + Text2.Text), Val(Text1.Text)
End Sub

Private Sub Command2_Click()
Text3.Text = Str(InPort(Val("&h" + Text2.Text)))
End Sub
