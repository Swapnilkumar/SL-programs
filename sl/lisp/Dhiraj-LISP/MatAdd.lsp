(defun main()
  
	(princ "Rows :: ")
	(setq m (read))
	(princ "Columns :: ")
	(setq n (read))
	(setq arr1 (make-array (* m n)))
	(setq arr2 (make-array (* m n)))
	(setq arr3 (make-array (* m n)))

  
	(princ "Enter The First Matrix\n")
	(dotimes (i m)
		(dotimes (j n)
			(princ "Enter element:")
			(setf (aref arr1(+ (* i n) j)) (read))
		)
		(princ "\n")
	)
  
	(print arr1)

	(princ "Enter The Second Matrix\n")
	(dotimes (i m)
		(dotimes (j n)
			(princ "Enter element:")
			(setf (aref arr2(+ (* i n) j)) (read))
		)
		(princ "\n")
	)
  
	(print arr2)


	(princ "The Addition Matrix is:: \n")
	(dotimes (i m)
		(dotimes (j n)
			(setf (aref arr3(+ (* i n) j)) (+ (aref arr1(+ (* i n) j))  (aref arr2(+ (* i n) j)) ))
		)
	)
	(princ "\nThe answer is :\n")
	(do
		((i 0 (+ i 1)))
		((eql i m))
		(do
			((j 0 (+ j 1)))
			((eql j n))
			(princ "  ")
			(princ (aref arr3 (+ (* i n) j)))
		)
		(princ "\n")
	)
 
    (dos "pause")
	(exit)
 )
 
 (main)