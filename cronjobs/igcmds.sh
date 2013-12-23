#!/bin/bash
while true
do
	php igcmds.php >> "logs/IGCMDS_$(date +\%F).txt"
	sleep 5
done