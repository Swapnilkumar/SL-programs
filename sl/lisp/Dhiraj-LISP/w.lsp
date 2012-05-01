; program for line editor

(defun clrscr ()
        (dos "cls"))

(defun menu() 
	
        (princ "**********************************\n")
        (princ "     LINE EDITOR USING LISP       \n")
        (princ "**********************************\n")
        (princ "   1 : CREATE FILE                \n")
        (princ "   2 : READ FILE                  \n")
        (princ "   3 : INSERT LINE                \n")
        (princ "   4 : DELETE LINE                \n")
        (princ "   5 : UPDATE LINE                \n")
        (princ "   6 : EXIT                       \n")
        (princ "**********************************\n")
        (princ "   ENTER THE OPTION  : ")
        (setf ch (read))
		(case ch
		      (1 (Create_File))
		      (2 (Read_File))
		      (3 (edit))
		      (4 (edit))
                      (5 (edit))
		      (6 (exit)))
       (menu) )

(Defun Create_file ()
	(clrscr)
        (princ "*********************************\n")
        (princ "           FILE CREATION         \n")
        (princ "**********************************\n")
        (princ " ENTER THE FILE NAME:")
    	(setf F1 (read))
	(setf FP (openo F1))
        (princ "ENTER THE CONTENTS : ")
	(setf x 0)
	(setf count -1)
        (princ " TYPE # TO QUIT")

       (setf Input_list (read-line))
	(do ((x 1 (+ 1 x)))
            ((equal Input_list "#"))
	    (princ Input_list FP)
	    (princ "\n"	 FP)
	    (setf count (+ 1 count))
	    (setf Input_list (read-line)))	
       (princ " NO. OF LINES IN THE FILE : ") 
	    (print count)
	    (close FP)
(menu)
        )


(Defun Read_file ()
	    (clrscr)
        (princ "*********************************\n")
        (princ "      READING FILE CONTENTS      \n")
        (princ "*********************************\n")

        (princ " ENTER THE FILE NAME : ")
	    (setf F1 (read))	
	    (setf FP (openi F1))
        (if (eql FP nil)
             (progn(princ "FILE NOT FOUND ")
             (return (menu))))
        (setf Input_list (read-line FP)) 
	(do ((x 1 (+ 1 x)))
            ((equal Input_list nil))
	    (princ Input_list)
            (princ "\n")
            (setf Input_list (read-line FP)))
         (close FP)
(dos "pause")
(menu)
         )

	

	
(defun Edit()
        (clrscr)
        (princ "*********************************\n")
        (princ "         FILE UPDATION           \n")
        (princ "*********************************\n")
	    (princ "ENTER THE FILE NAME : ")
	    (setf F1 (read))
        (setf FP (openi F1))
        (princ "ENTER THE LINE NO.:")
	    (setf no (read))
        (setf Input_list (read-line FP))
        (setf Input_list (list Input_list))
        (setf temp_list Input_list)
        (setf no (- no 1))
        (do ((x 0 (+ 1 x)))
	        ((= x no))	
            (setf Input_list (read-line FP))
            (if (equal Input_list nil)
                  (progn(princ "NOT POSSIBLE \n")
                  (return (menu))))
            (setf Input_list (list Input_list))
            (setf temp_list (append temp_list Input_list)))
        (if(equal ch 3)
                     (progn
			(princ "ENTER THE DATA: ")
	                 (setf data (read-line))
                     (setf data (read-line))
                     (setf data (list data))
                     (setf temp_list (append temp_list data))))   
        (if(equal ch 4)
                   (setf Input_list (read-line FP)) )
        (if(equal ch 5)
                    (progn(setf Input_list (read-line FP))
                    (princ "ENTER THE DATA: ")
	                (setf data (read-line))
                    (setf data (read-line))
                    (setf data (list data))
                    (setf temp_list (append temp_list data))))     
        (setf Input_list (read-line FP))
	    (do ((x 1 (+ 1 x)))    
                ((equal Input_list nil))
                (setf Input_list (list Input_list))
                (setf temp_list (append temp_list Input_list))
                (setf Input_list (read-line FP)))
        (close FP)
        (setf FP (openo F1))
    	(do ((x 1 (+ 1 x)))
                 ((equal temp_list nil))
                 (princ (car temp_list) FP)
                 (princ "\n"  FP)
                 (setf temp_list (cdr temp_list)))
        (close FP)
	)
(dos "pause")
        (menu)    


)
;outputs
;**********************************
;     LINE EDITOR USING LISP
;**********************************
;   1 : CREATE FILE
;   2 : READ FILE
;   3 : INSERT LINE
;   4 : DELETE LINE
;   5 : UPDATE LINE
;   6 : EXIT
;**********************************
;
;*********************************
;           FILE CREATION
;**********************************
; ENTER THE FILE NAME:> "abc.txt"
;ENTER THE CONTENTS :  TYPE # TO QUIT> line editor in lisp by pict #
;>*********************************
;      READING FILE CONTENTS
;*********************************
; ENTER THE FILE NAME : > "abc.txt"
;
;line editor in lisp by pict #
;Press any key to continue . . .
;*********************************
;      READING FILE CONTENTS
;*********************************
; ENTER THE FILE NAME : > "abc.txt"
;
;new first line inserted
;line editor in lisp by pict #
;Press any key to continue . . .
;
;*********************************
;        FILE UPDATION
;*********************************
;ENTER THE FILE NAME : > "abc.txt"
;ENTER THE LINE NO.:> 1
;ENTER THE DATA: > new first line inserted