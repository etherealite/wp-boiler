#!/bin/sh
set -x
test -n "$(mc config host list | grep '^minio')" || {
  mc config host add minio 'http://minio:9000' 'minio' 'minio123' --insecure
}

test -n "$(mc ls 'minio' | grep 'wp-uploads')" || {
  mc mb minio/wp-uploads
}
test "$( mc policy minio/wp-uploads | cut -d ' '  -f 6)" = '`download`' || {
  mc policy download minio/wp-uploads
}
