#!/usr/bin/env -S guile3 -s
!#

#| LARGEST PALINDROME PRODUCT
  A palindromic number reads the same both ways. The largest palindrome made from the
product of two 2-digit numbers is:

      9009 = 91 x 99

  Find the largest palindrome made from the product of two 3-digit numbers.
|#

(use-modules (ice-9 format)
             (srfi srfi-1))

(define (is-pal? num)
  (let ((s-num (number->string num)))
    (string=? s-num (string-reverse s-num))))

(define three-digit-nums (iota 900 100))
(define len (length three-digit-nums))
(define curr-max -1)

(define (largest-palindrome-product)
  (for-each
    (lambda (i)
      (for-each
        (lambda (j)
          (let* ((x (list-ref three-digit-nums i))
                 (y (list-ref three-digit-nums j))
                 (product (* x y)))
            (when (is-pal? product)
              (when (> product curr-max)
                (set! curr-max product)))))
        (iota (- len i 1) (+ i 1))))
    (iota len)))

(largest-palindrome-product)
(format #t "Result is: ~a" curr-max)
(newline)