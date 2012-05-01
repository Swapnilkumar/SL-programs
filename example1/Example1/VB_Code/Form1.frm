VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   2430
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   4110
   LinkTopic       =   "Form1"
   ScaleHeight     =   2430
   ScaleWidth      =   4110
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox Text3 
      Height          =   330
      Left            =   3135
      TabIndex        =   5
      Text            =   "0"
      Top             =   660
      Width           =   735
   End
   Begin VB.TextBox Text2 
      Height          =   330
      Left            =   1845
      TabIndex        =   2
      Text            =   "0"
      Top             =   660
      Width           =   735
   End
   Begin VB.TextBox Text1 
      Height          =   330
      Left            =   450
      TabIndex        =   1
      Text            =   "0"
      Top             =   660
      Width           =   735
   End
   Begin VB.CommandButton Command1 
      Caption         =   "Calculate"
      Height          =   585
      Left            =   1050
      TabIndex        =   0
      Top             =   1500
      Width           =   1830
   End
   Begin VB.Label Label2 
      Caption         =   "="
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   13.5
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2775
      TabIndex        =   4
      Top             =   645
      Width           =   270
   End
   Begin VB.Label Label1 
      Caption         =   "+"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   13.5
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   330
      Left            =   1485
      TabIndex        =   3
      Top             =   675
      Width           =   255
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function sum Lib "example1.dll" (ByVal x As Long, ByVal y As Long) As Long
Private Sub Command1_Click()
Text3.Text = Str(sum(CInt(Text1.Text), CInt(Text2.Text)))
End Sub
