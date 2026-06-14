#!/usr/bin/env -S GUILE_AUTO_COMPILE=0 GUILE_WARN_DEPRECATED=no guile -s

!#

#|
10001st PRIME
  By listing the first six prime numbers:
			2, 3, 5, 7, 11, 13
we can see that the 6th prime is 13.

  What is the 10001st prime number?
|#

(use-modules (ice-9 format) (math primes))

(define (nth-prime num)
  (let loop ((n 2) (cnt 1))
    (if (prime? n)
      (if (= cnt num)
        n
        (loop (+ n 1) (+ cnt 1)))
      (loop (+ n 1) cnt))))

(display (nth-prime 6))
