#!/bin/bash
logfile="/var/log/temper"
line=`/root/temper/temper`
if [ ! -f "$logfile" ]; then
	touch "$logfile"
fi
echo $line >> "$logfile"
