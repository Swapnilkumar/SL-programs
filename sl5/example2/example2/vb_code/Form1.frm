VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   3195
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   4680
   LinkTopic       =   "Form1"
   ScaleHeight     =   3195
   ScaleWidth      =   4680
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command1 
      Caption         =   "Change Case"
      Height          =   510
      Left            =   1215
      TabIndex        =   1
      Top             =   1620
      Width           =   1830
   End
   Begin VB.TextBox Text1 
      Height          =   375
      Left            =   720
      TabIndex        =   0
      Top             =   615
      Width           =   2985
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function to_upper Lib "example2.dll" (ByVal text As String) As String

Private Sub Command1_Click()
If (Text1.text) = "" Then
 Exit Sub
End If

MsgBox to_upper(Text1.text)
End Sub


