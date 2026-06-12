#!/usr/bin/env -S guile -s
!#

#| SMALLEST MULTIPLE
  2520 is the smallest number that can be divisible by each of the numbers from
1 to 10 without any remainder.

  What is the smallest positive number that is evenly divisible by all of the numbers from 1 to 20?
|#

(add-to-load-path
  (dirname (dirname (current-filename))))
(use-modules (ice-9 format)
             (srfi srfi-1)
             (utils benchmark))

;; Sol1: BRUTE-FORCE
;; Prep funcs
(define (last-digit num) (modulo num 10))
(define (rule2 num) (even? num))
(define (rule3 num) (= 0 (modulo num 3)))
(define (rule4 num) (= 0 (modulo num 4)))
(define (rule5 num)
  (or
    (= 0 (last-digit num))
    (= 5 (last-digit num))))
(define (rule6 num) (and (rule2 num) (rule3 num)))
(define (rule7 num) (= 0 (modulo num 7)))
(define (rule8 num) (= 0 (modulo num 8)))
(define (rule9 num) (= 0 (modulo num 9)))
(define (rule10 num) (= 0 (last-digit num)))
(define (rule11 num) (= 0 (modulo num 11)))
(define (rule12 num) (and (rule3 num) (rule4 num)))
(define (rule13 num) (= 0 (modulo num 13)))
(define (rule14 num) (and (rule2 num) (rule7 num)))
(define (rule15 num) (and (rule5 num) (rule3 num)))
(define (rule16 num) (= 0 (modulo num 16)))
(define (rule17 num) (= 0 (modulo num 17)))
(define (rule18 num) (and (rule2 num) (rule9 num)))
(define (rule19 num) (= 0 (modulo num 19)))
(define (rule20 num) (and (rule4 num) (rule5 num)))
;; Example
(define (example-bf)
  (let wloop ((num 10))
    (if (and (rule10 num) (rule9 num) (rule8 num) (rule7 num) (rule6 num) (rule5 num)
             (rule4 num) (rule3 num) (rule2 num))
      num
      (wloop (+ num 10)))))
;; Real
(define (solution-bf)
  (let wloop ((num 10))
    (if (and (rule20 num) (rule19 num) (rule18 num) (rule17 num) (rule16 num)
             (rule15 num) (rule14 num) (rule13 num) (rule12 num) (rule11 num)
             (rule10 num) (rule9 num) (rule8 num) (rule7 num) (rule6 num)
             (rule5 num) (rule4 num) (rule3 num) (rule2 num))
      num
      (wloop (+ num 10)))))

;; Sol2: MATH ONE-LINER
;; Example
(define (example-math) (lcm 1 2 3 4 5 6 7 8 9 10))
;; Real
(define (solution-math) (lcm 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20))

;; Sol3: LCM WITHOUT HARDCODING NUMS, FUNCTIONAL WAY
(define (solution max)
  (let ((numbers (iota max 1)))
    (reduce lcm 1 numbers)))

(benchmark-func "Brute Force" (lambda () (solution-bf)))
(benchmark-func "One-liner lcm" (lambda () (solution-math)))
(benchmark-func "Functional Math" (lambda () (solution 20)))