#!/bin/bash

echo "System Report for $HOSTNAME"
printf "\t\tReport Date:\t%(%Y-%m-%d)T\n"
printf "\t\tKernel Release:\t$(uname -r)\n"
printf "\t\tBash Version:\t%s\n" $BASH_VERSION
printf "\t\tAvailable Storage:\t$(df -h / | awk 'NR==2 {print $4}')\n"
printf "\t\tAvailable Memory:\t$(free -h | awk '/^Mem:/ {print $7}')\n"
printf "\t\tFiles in Directory:\t$(ls | wc -l)\n"