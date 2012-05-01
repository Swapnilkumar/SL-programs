VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   6765
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   8805
   LinkTopic       =   "Form1"
   ScaleHeight     =   6765
   ScaleWidth      =   8805
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox Text1 
      Height          =   615
      Left            =   1560
      TabIndex        =   2
      Top             =   960
      Width           =   3615
   End
   Begin VB.Frame Frame2 
      Caption         =   "Frame2"
      Height          =   3015
      Left            =   4440
      TabIndex        =   1
      Top             =   2040
      Width           =   975
      Begin VB.CommandButton Command2 
         Caption         =   "/"
         Height          =   375
         Index           =   4
         Left            =   240
         TabIndex        =   17
         Top             =   1920
         Width           =   375
      End
      Begin VB.CommandButton Command2 
         Caption         =   "*"
         Height          =   375
         Index           =   3
         Left            =   240
         TabIndex        =   16
         Top             =   1320
         Width           =   375
      End
      Begin VB.CommandButton Command2 
         Caption         =   "-"
         Height          =   375
         Index           =   2
         Left            =   240
         TabIndex        =   15
         Top             =   720
         Width           =   375
      End
      Begin VB.CommandButton Command2 
         Caption         =   "+"
         Height          =   375
         Index           =   1
         Left            =   240
         TabIndex        =   14
         Top             =   240
         Width           =   375
      End
      Begin VB.CommandButton Command2 
         Caption         =   "="
         Height          =   375
         Index           =   0
         Left            =   240
         TabIndex        =   13
         Top             =   2520
         Width           =   375
      End
   End
   Begin VB.Frame Frame1 
      Caption         =   "Frame1"
      Height          =   3255
      Left            =   1440
      TabIndex        =   0
      Top             =   1920
      Width           =   2535
      Begin VB.CommandButton Command1 
         Caption         =   "9"
         Height          =   495
         Index           =   9
         Left            =   1680
         TabIndex        =   12
         Top             =   1800
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "8"
         Height          =   495
         Index           =   8
         Left            =   960
         TabIndex        =   11
         Top             =   1800
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "7"
         Height          =   495
         Index           =   7
         Left            =   240
         TabIndex        =   10
         Top             =   1800
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "6"
         Height          =   495
         Index           =   6
         Left            =   1680
         TabIndex        =   9
         Top             =   1080
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "5"
         Height          =   495
         Index           =   5
         Left            =   960
         TabIndex        =   8
         Top             =   1080
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "4"
         Height          =   495
         Index           =   4
         Left            =   240
         TabIndex        =   7
         Top             =   1080
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "3"
         Height          =   495
         Index           =   3
         Left            =   1680
         TabIndex        =   6
         Top             =   360
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "2"
         Height          =   495
         Index           =   2
         Left            =   960
         TabIndex        =   5
         Top             =   360
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "1"
         Height          =   495
         Index           =   1
         Left            =   240
         TabIndex        =   4
         Top             =   360
         Width           =   495
      End
      Begin VB.CommandButton Command1 
         Caption         =   "0"
         Height          =   495
         Index           =   0
         Left            =   960
         TabIndex        =   3
         Top             =   2520
         Width           =   495
      End
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function sub1 Lib "sl_5.dll" (ByVal x As Double, ByVal y As Double) As Double
Private Declare Function sum Lib "sl_5.dll" (ByVal x As Double, ByVal y As Double) As Double
Private Declare Function mult Lib "sl_5.dll" (ByVal x As Double, ByVal y As Double) As Double
Private Declare Function div1 Lib "sl_5.dll" (ByVal x As Double, ByVal y As Double) As Double
Private Declare Function sumref Lib "sl_5.dll" (ByRef x As Double, ByRef y As Double)
Private Declare Function subref Lib "sl_5.dll" (ByRef x As Integer, ByRef y As Integer)
Dim t1, t2 As Integer


Dim a, b, c As Double
Dim r1, r2, r3, op As Double
 

Private Sub Command1_Click(Index As Integer)
    
    If a = 0 And b = 1 Then
        Text1.Text = Text1.Text + Str(Index)
        r1 = Val(Text1.Text)
    End If
    
    If a = 1 And b = 1 Then
        Text1.Text = Text1.Text + Str(Index)
        r2 = Val(Text1.Text)
    End If
    If a = 1 And b = 0 Then
        Text1.Text = Str(Index)
        r2 = Val(Text1.Text)
        a = 1
        b = 1
    End If
    If a = 0 And b = 0 Then
        Text1.Text = Str(Index)
        a = 0
        b = 1
        r1 = Index
    End If
    

End Sub

Private Sub Command2_Click(Index As Integer)
    If Index <> 0 Then
        If (a = 1 And b = 0) Or (a = 1 And b = 1) Then
            
            Select Case op
                
                Case 1
                    r1 = sum(r1, r2)
                    Text1.Text = Str(r1)
                    
                Case 2
                    r1 = sub1(r1, r2)
                    Text1.Text = Str(r1)
                 Case 3
                        
                       r1 = mult(r1, r2)
                    Text1.Text = Str(r1)
                 
                 Case 4
                       If (r2 <> 0) Then
                            r1 = div1(r1, r2)
                            Text1.Text = Str(r1)
                        Else
                            Text1.Text = "Devide by 0 error"
                        End If
                 
            End Select
            r2 = 0
            a = 1
            b = 0
            op = Index
        End If
        If (a = 0 And b = 1) Or (a = 0 And b = 0) Then
            op = Index
            a = 1
            b = 0
        End If
    End If
    If Index = 0 Then
            Select Case op
                
                Case 1
                    Call sumref(r1, r2)
                    Text1.Text = Str(r1)
                Case 2
                    Call subref(t1, t2)
                    Text1.Text = Str(r1)
                Case 3
                    r1 = mult(r1, r2)
                    Text1.Text = Str(r1)
                Case 4
                    r1 = div1(r1, r2)
                    Text1.Text = Str(r1)
                    
            End Select
            r2 = 0
            a = 0
            b = 0
            op = Index
    End If
    
End Sub

Private Sub Form_Load()
a = 0
b = 0
End Sub

