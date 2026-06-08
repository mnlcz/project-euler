#!/usr/bin/env -S guile3 -s
!#

#| LARGEST PRIME FACTOR
  The prime factors of 13195 are 5, 7, 13 and 29.

  What is the largest prime factor of the number 600851475143?
|#

(use-modules (ice-9 format)
             (math primes))

(define example (apply max (factor 13195)))
(format #t "Example max prime factor: ~a~%" example)

(define solution (apply max (factor 600851475143)))
(format #t "Real max prime factor: ~a~%" solution)