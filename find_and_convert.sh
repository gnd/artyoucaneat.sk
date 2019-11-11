#!/bin/bash
#
# find and convert new videos for Artyoucaneat
#
# 2019, gnd
##############################################

usage() {
        printf "\n"
        printf "Usage: \n"
        printf "$0 \n\n"
}

# Define globals
source settings

# Find and convert videos
for k in `find $WEB_ROOT/wp-content/uploads/20* -type f -name "*.mp4" | grep -vFf $WEB_ROOT/wp-content/uploads/converted`
do
	DIR=`dirname $k`
	FILE=`basename $k`
	RAWNAME=`echo $FILE|sed 's/\.mp4//g'`
	echo $RAWNAME"_240p.mp4" >> $WEB_ROOT/wp-content/uploads/converted
	echo $RAWNAME"_480p.mp4" >> $WEB_ROOT/wp-content/uploads/converted
	echo $RAWNAME"_720p.mp4" >> $WEB_ROOT/wp-content/uploads/converted
	echo $RAWNAME".mp4" >> $WEB_ROOT/wp-content/uploads/converted
	echo $RAWNAME".ogg" >> $WEB_ROOT/wp-content/uploads/converted
	cd $DIR
	$WEB_ROOT/wp-content/themes/allyoucan/convert.sh $FILE
done

# Report conversion
sendemail -o tls=yes -s $SERVER:$PORT -xu $USER -xp $PASS -f $FROM -t $TO -u "New video converted: $RAWNAME" -m "No further text."
