(defun sort()
	(princ "Enter size:")
	(setq n (read))
	(setf arr (make-array n))
	(princ "Enter elements:")
	(dotimes (i n)
		(setf (aref arr i) (read))
	)
	(print arr)
	
	(do ((i 0 (+ i 1)))
		((eql i n))
		(setq k i)
		(do ((j (+ i 1) (+ j 1)))
			((eql j n))
			(if (< (aref arr j) (aref arr k))
				(setq k j)
			)
		)
		(if (eql k i)
			(progn 
				(setq r 0)
			)
			(progn
				(setf t (aref arr k))
				(setf (aref arr k) (aref arr i))
				(setf (aref arr i) t)
			)
		)
	)
	(princ "After Sorting")
	(print arr)
)
(sort)