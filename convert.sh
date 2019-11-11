#!/bin/bash
#
# Convert new videos for artyoucaneat
#
# 2019, gnd
#####################################

if [ -z $1 ]; then
        echo "Please provide a input file. Exiting"
        exit
else
        infile=$1
fi

# check if input file exists
if [ ! -f $infile ]; then
        echo "File $infile doesnt exist. Exiting"
        exit
fi

# check if input file is a mp4
if [[ ! $infile =~ "mp4" ]]; then
        echo "File $infile is not a mp4. Exiting"
        exit
fi

# convert the file
filename=`echo $infile|sed 's/\.mp4//g'`
ffmpeg -i $infile -s 1280x720 $filename"_720p.mp4"
ffmpeg -i $infile -s 850x480 $filename"_480p.mp4"
ffmpeg -i $infile -s 426x240 $filename"_240p.mp4"
ffmpeg -i $infile $filename".ogg"
