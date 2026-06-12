#!/usr/bin/env -S guile -s
!#

#| SUM SQUARE DIFFERENCE
  The sum of the square of the first ten natural numbers is,
  				1^2 + 2^2 + ... + 10^2 = 385
  The square of the sum of the first ten natural numbers is,
  				(1 + 2 + ... + 10)^2 = 55^2 = 3025
  Hence the difference between the sum of the squares of the
first ten natural numbers and the square of the sum is
				3025 - 385 = 2640

  Find the difference between the sum of the squares of the
first one hundred natural numbers and the square of the sum.
|#

(use-modules (ice-9 format))

(define (sum-of-square num)
  (apply + (map (lambda (x) (* x x)) (iota num 1))))

(define (square-of-sum num)
  (let ((n (apply + (iota num 1))))
    (* n n)))

(define num 100)
(define sosq (sum-of-square num))
(define sqos (square-of-sum num))
(define diff (- sqos sosq))

(format #t "Sum of square is ~a~%" sosq)
(format #t "Square of sum is ~a~%" sqos)
(format #t "Difference is    ~a~%" diff)