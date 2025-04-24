#!/bin/bash

echo ~+
echo {0..100..5}
mkdir {png,jpg,pdf}_files{1..3}
touch {png,jpg,pdf}_files{1..3}/image_{1..5}
rm {png,jpg,pdf}_files{1..3}/image_{1..5}
rmdir {png,jpg,pdf}_files{1..3}
echo "6 times 3 is equal to: $(( 6 * 3 ))"
message="impossible work!"
echo ${message:2}