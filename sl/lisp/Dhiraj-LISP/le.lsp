(Defun Menu ()
  (princ "\n\n  ====MENU====         \n")
  (princ " 1. Create a file \n")
  (princ " 2. Display a file   \n")
  (princ " 3. Edit A Line \n")
  (princ " 4. Insert a line \n")
  (princ " 5. Delete a line  \n")
  (princ " 6. Copy a file\n")
  (princ " 7. Exit \n")
  (setq ch (read))
    (case ch
      ( 1 (Create) )
      ( 2 (Display) )
      ( 3 (Edit-Line) )
      ( 4 (Insert) )
      ( 5 (Delete) )
      ( 6 (Copy) )
      ( 7 (Exit) )
    )
    (Menu)
)
;----------------------------------------------------------------------------
;Creating A New File
;----------------------------------------------------------------------------
(Defun Create nil
  (princ "\n Enter the File Name : ")
  (setq name1 (read))
  (setf fp (openi name1))
  (if (eql fp nil) (create-it))
  (close fp)
  (princ "\n The File Already Exists !! \n")
  (dos "pause")
)        

(Defun Create-it nil
  (setf fp (openo name1))
  (princ "\n File is created ......")
  (princ "\n Type the file contents, finish with a (.) on a new line :- \n")
  (read-line)
  (setq str1 (read-line))
  (do ()
      ((equal str1 "."))
    
    (princ str1 fp)           
    (princ "\n" fp)
    (setq str1 (read-line))
  )
  (close fp)
  (menu) 
)
;----------------------------------------------------------------------------
;Displaying An Existing File
;----------------------------------------------------------------------------
(defun Display nil
  (princ "Enter File Name : ") 
  (setq filename (read))
  (setf  FPtr (openi FileName))
  (if (eql FPtr nil)
    (Disp-Err)
  )
  
  ( setf  LineCount 0)
  ( setf  sLine "")
  ( setf  sLine (read-line FPtr))
  ( do ((eof 0)) 
       ((eql eof 1))
     ( setf  LineCount (1+ LineCount))
     ( princ LineCount)
     ( princ " : ")
     ( princ sLine)
     ( princ "\n")
     ( setq sLine (read-line FPtr))
     ( if (null sLine)
	(setf  eof 1)
     )
   )
   ( Close fptr)
   ( princ "\n")
   ( dos "pause")
)

(Defun Disp-Err nil
  (princ "\nFile Not Found !!\n")
  (menu)
)

;---------------------------------------------------------------------------
;Copying One File Into Another
;---------------------------------------------------------------------------
(defun Copy nil
  (princ "Enter source file name : ")
  (setq names (read))
  (setf fps (openi names))
  ( if (eql fps nil)
     (NoSource)
  )
  (princ "Enter destination File Name : ")
  (setq nameo (read))
  (setf fpo (openi nameo)) 
  (if (eql fpo nil) (Copy-it))
  (princ "\n File Already Exists !! \n")
  (dos "pause")
) 

(Defun NoSource nil
   (princ "\nFile Could Not Be Opened !\n")
   (dos "pause")
   (menu)
)

(Defun Copy-It nil
  (setf fpo (openo nameo))
  (setf  sLine "")
  (setf  sLine (read-line fps))
  (do ((eof 0))
      ((eql eof 1))
     (princ sLine fpo)
     (princ "\n" fpo)
     (setq sLine (read-line fps))
     (if (null sLine) (setf  eof 1))
  )
  (close fps)
  (close fpo)
  (princ "\n File Copied !! \n")
  (dos "pause")
  (menu)
)
;---------------------------------------------------------------------------

;---------------------------------------------------------------------------
;Insert A Line In A File
;---------------------------------------------------------------------------
(defun insert nil
  (princ "Enter file name : ")
  (setq names (read))
  
  (setf fps (openi names))
  ( if (eql fps nil)
    (file-err)
  )
  
  (princ "Enter Line No. : ")
  (setq LNo (read))
  (princ "Enter Contents of Line : ")
  (read-line)
  (setq str (list (read-line)))
  (setq str-list (list nil))
  
  ;Adding Lines before insertion point to the list
  (do ((x 1)) ((= x LNo))
    (setq str-temp (list (read-line fps)) ) 
    (setq str-list (append str-list str-temp) )
    (setq x (+ x 1))
  )
  
  ;Adding Line to be inserted to the list
  (setq str-list (append str-list str))
  
  ;Adding The Rest of the file to the list
  (setq  str-temp "")
  (setq eof 0)
  (setq  str-temp (read-line fps))
  ( if (null str-temp)
	(setq  eof 1))
  (setq str-temp (list str-temp))	
  ( do () ((= eof 1))
     (setq str-list (append str-list str-temp))  
     (setq  str-temp (read-line fps))
     ( if (null str-temp)
	(setq  eof 1))
     (setq str-temp (list str-temp))
  )  
  (close fps)
  
  ;Removing the first atom of list "nil"
  (setq str-list (cdr str-list))
   
  ;Writing all lines to the recreated file
  (setf fps (openo names))
  (do ()
    ((equal str-list nil))
    (setq str-temp (car str-list))
    (setq str-list (cdr str-list))
    (princ str-temp fps)
    (princ "\n" fps)
  )
  (close fps)
  (princ "\nLine Inserted\n")
  (dos "pause")
)

(Defun File-Err nil
  (princ "\nFile Not Found !\n")
  (dos "pause")
  (menu)
)
;---------------------------------------------------------------------------

;---------------------------------------------------------------------------
;Deleting A Line from a file
;---------------------------------------------------------------------------
(defun delete nil
  (princ "Enter file name : ")
  (setq names (read))
  (setf fps (openi names))
  ( if (eql fps nil)
    (file-err)
  )
  
  (princ "Enter Line No. : ")
  (setq LNo (read))
  
  (setq str-list (list nil))
  
  ;Adding All lines before line to be deleted to list
  (do ((x 1)) ((= x LNo))
    (setq str-temp (read-line fps))
    (if (eql str-temp nil) (lineno-err))
    (setq str-temp (list str-temp))
    (setq str-list (append str-list str-temp) )
    (setq x (+ x 1))
  )
  
  ;Skipping line to deleted
  (setq str-temp (read-line fps))
  (if (eql str-temp nil) (lineno-err))
  
  ;Adding remaining lines in file to the list
  (setq  str-temp "")
  (setq eof 0)
  (setq  str-temp (read-line fps))
  ( if (null str-temp)
	(setq  eof 1))
  (setq str-temp (list str-temp))	
  
  ( do () ((= eof 1))
    (setq str-list (append str-list str-temp))  
    (setq  str-temp (read-line fps))
    ( if (null str-temp)
      (setq  eof 1))
    (setq str-temp (list str-temp))
  )  
  
  (close fps)
  
  ;Removing first node "nil" from list
  (setq str-list (cdr str-list))
  
  ;Writing all lines to recreated file
  (setf fps (openo names))
  (do ()
    ((equal str-list nil))
    (setq str-temp (car str-list))
    (setq str-list (cdr str-list))
    (princ str-temp fps)
    (princ "\n" fps)
  )
  (close fps)
  (princ "\n Line Deleted \n")
  (dos "pause")
)

(Defun LineNo-Err nil
  (princ "\n Line No. Exceeds Length of file !!\n")
  (close fps)
  (dos "pause")
  (menu)
)
;---------------------------------------------------------------------------

;---------------------------------------------------------------------------
;Editing A Line from a file
;---------------------------------------------------------------------------
(defun Edit-Line nil
  (princ "Enter file name : ")
  (setq names (read))
  (setf fps (openi names))
  ( if (eql fps nil)
    (file-err)
  )
  
  (princ "Enter Line No. : ")
  (setq LNo (read))
  
  (setq str-list (list nil))
  
  ;Adding All lines before line to be edited to list
  (do ((x 1)) ((= x LNo))
    (setq str-temp (read-line fps))
    (if (eql str-temp nil) (lineno-err))
    (setq str-temp (list str-temp))
    (setq str-list (append str-list str-temp) )
    (setq x (+ x 1))
  )
  
  ;Skipping line to edited
  (setq str-temp (read-line fps))
  (if (eql str-temp nil) (lineno-err))
  
  ;Getting New Line
  (princ "\n Current Line :\n")
  (princ str-temp)
  (princ "\n")
  (princ "\n Enter New Line :\n")
  (read-line)
  (setq str-temp (list (read-line)))
  (setq str-list (append str-list str-temp))
  
  ;Adding remaining lines in file to the list
  (setq  str-temp "")
  (setq eof 0)
  (setq  str-temp (read-line fps))
  ( if (null str-temp)
	(setq  eof 1))
  (setq str-temp (list str-temp))	
  
  ( do () ((= eof 1))
    (setq str-list (append str-list str-temp))  
    (setq  str-temp (read-line fps))
    ( if (null str-temp)
      (setq  eof 1))
    (setq str-temp (list str-temp))
  )  
  
  (close fps)
  
  ;Removing first node "nil" from list
  (setq str-list (cdr str-list))
  
  ;Writing all lines to recreated file
  (setf fps (openo names))
  (do ()
    ((equal str-list nil))
    (setq str-temp (car str-list))
    (setq str-list (cdr str-list))
    (princ str-temp fps)
    (princ "\n" fps)
  )
  (close fps)
  (princ "\n Line Edited \n")
  (dos "pause")
)
(Defun cls()
	(do ((x 1 (+ x 1)))
		((equal x 25))
			(princ "\n")
	)
)
(Defun LineNo-Err nil
  (princ "\n Line No. Exceeds Length of file !!\n")
  (close fps)
  (dos "pause")
  (menu)
)
;---------------------------------------------------------------------------
