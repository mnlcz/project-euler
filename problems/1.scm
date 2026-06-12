#!/usr/bin/env -S guile -s
!#

#| MULTIPLES OF 3 OR 5
  If we list all the natural numbers below 10 that are multiples of 3 or 5, we get
3, 5, 6 and 9. The sum of these multiples is 23.

  Find the sum of all the multiples of 3 and 5 below 1000.
|#

(use-modules
  (ice-9 format))

(define (euler1 limit-ni)
  (let* ((nums (iota (- limit-ni 1) 1))
        (filtered
          (filter
            (lambda (curr)
              (or
                (= 0 (modulo curr 5))
                (= 0 (modulo curr 3))))
              nums)))
    (apply + filtered)))

(let ((example (euler1 10)))
  (format #t "Example result: ~a~%" example))

(let ((real (euler1 1000)))
  (format #t "Problem result: ~a~%" real))