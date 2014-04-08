#!/bin/bash
pushd . > /dev/null
SCRIPT_PATH="${BASH_SOURCE[0]}";
while([ -h "${SCRIPT_PATH}" ]); do
    cd "`dirname "${SCRIPT_PATH}"`"
    SCRIPT_PATH="$(readlink "`basename "${SCRIPT_PATH}"`")";
done
cd "`dirname "${SCRIPT_PATH}"`" > /dev/null
SCRIPT_PATH="`pwd`";
popd  > /dev/null
end=$(date -ud "1 minute" +%s)
while [[ $(date -u +%s) -le $end ]]
do
	php ${SCRIPT_PATH}/limiters.php >> "${SCRIPT_PATH}/logs/LIMITER_$(date +\%F).txt"
	sleep 30
done