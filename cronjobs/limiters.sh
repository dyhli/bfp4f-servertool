#!/bin/bash
while true
do
	php limiters.php &>> "logs/LIMITER_$(date +\%F).txt"
	sleep 30
done