VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   930
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   3435
   LinkTopic       =   "Form1"
   ScaleHeight     =   930
   ScaleWidth      =   3435
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command7 
      Caption         =   "="
      Height          =   375
      Left            =   3000
      TabIndex        =   7
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command6 
      Caption         =   "!"
      Height          =   375
      Left            =   2520
      TabIndex        =   6
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command5 
      Caption         =   "sqr"
      Height          =   375
      Left            =   2040
      TabIndex        =   5
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command4 
      Caption         =   "*"
      Height          =   375
      Left            =   1560
      TabIndex        =   4
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command3 
      Caption         =   "/"
      Height          =   375
      Left            =   1080
      TabIndex        =   3
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command2 
      Caption         =   "-"
      Height          =   375
      Left            =   600
      TabIndex        =   2
      Top             =   480
      Width           =   375
   End
   Begin VB.CommandButton Command1 
      Caption         =   "+"
      Height          =   375
      Left            =   120
      TabIndex        =   1
      Top             =   480
      Width           =   375
   End
   Begin VB.TextBox Text1 
      Alignment       =   1  'Right Justify
      Height          =   375
      Left            =   0
      TabIndex        =   0
      Top             =   0
      Width           =   3375
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function factr Lib "cal.dll" (ByVal x As Integer) As Integer
Private Declare Function sqr Lib "cal.dll" (ByVal x As Integer) As Long


Dim var1 As Integer
Dim op As Integer

Private Sub Command1_Click()
var1 = Int(Text1.Text)
op = 1
Text1.Text = ""
End Sub

Private Sub Command2_Click()
var1 = Int(Text1.Text)
op = 2
Text1.Text = ""
End Sub

Private Sub Command3_Click()
var1 = Int(Text1.Text)
op = 3
Text1.Text = ""
End Sub

Private Sub Command4_Click()
var1 = Int(Text1.Text)
op = 4
Text1.Text = ""
End Sub

Private Sub Command5_Click()
Text1.Text = sqr(CInt(Text1.Text))

End Sub

Private Sub Command6_Click()
Text1.Text = factr(CInt(Text1.Text))

End Sub

Private Sub Command7_Click()
var2 = Int(Text1.Text)
If (op = 1) Then
    Text1.Text = var1 + var2
End If
If (op = 2) Then
    Text1.Text = var1 - var2
End If
If (op = 3) Then
    Text1.Text = var1 / var2
End If
If (op = 4) Then
    Text1.Text = var1 * var2
End If

End Sub

Private Sub Form_Load()
op = 0
End Sub
