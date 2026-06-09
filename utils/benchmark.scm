(define-module (utils benchmark)
  #:export (benchmark-func))

(use-modules (ice-9 format))

(define (benchmark-func name proc)
  (let* ((start-time (get-internal-run-time))
         (result     (proc))
         (end-time   (get-internal-run-time))
         (elapsed    (/ (- end-time start-time)
                        (exact->inexact internal-time-units-per-second))))
    (format #t "Method: ~a~%" name)
    (format #t "Result: ~a~%" result)
    (format #t "Time  : ~,6F seconds~%~%" elapsed)))