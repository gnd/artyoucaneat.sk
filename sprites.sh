#!/bin/bash
#
# A very simple BASH script to take an input video and generate sprite JPG image
# from video thumbs in equal sequence of time periods.
#
# Copyright (c) 2018, Nuevolab.com, All rights reserved.
#
# Redistribution and use in source and binary forms, with or without modification,
# are permitted provided for everyone without restrictions
#
# gnd edit, 2019

function usage() {
cat << EOM
    Video Sprite Generator
    Version 1
    Copyright (C) 2018 Nuevolab.com
    Usage: spritevideo -i [inputfile] -o [outputdir] -p [outputfile]
        -i      Input video file
        -o      Output directory
        -p      Output jpg file
EOM
    exit
}

# Print usage if not enough params
if [ -z $6 ]; then
    usage
fi

# Check if ffmpeg and convert available
if hash ffmpeg 2> /dev/null; then
    echo "ffmpeg command found.... continuing"
else
    echo "Error: FFmpeg doesn't appear to exist in your PATH. Please addresss and try again"
    exit 1
fi
command -v convert >/dev/null 2>&1 || { echo >&2 "Imagemagick not installed.  Aborting."; exit 1; }

# Set some params
INPUTFILE=""
OUTPUT_DIRECTORY=""
OUTPUT_FILENAME=""
SPRITE_WIDTH=192
SPRITE_HEIGHT=108

# Get params from the command line
while getopts ":i:o:p:w:h:" optname; do
  case "$optname" in
    "i")
      INPUTFILE=$OPTARG
    ;;
    "o")
      OUTPUT_DIRECTORY=$OPTARG
    ;;
    "p")
      OUTPUTFILE=$OPTARG
    ;;
    "w")
      SPRITE_WIDTH=$OPTARG
    ;;
    "h")
      SPRITE_HEIGHT=$OPTARG
    ;;
  esac
done

# Check if all params correct
if [ ! -f "$INPUTFILE" ]; then
      echo "Input video file does not exist. Exiting ..."
      exit 1
fi
if [ ! -d "$OUTPUT_DIRECTORY" ]; then
      echo "Output directory does not exist. Exiting ..."
      exit 1
fi
if [ $OUTPUTFILE == "" ]; then
      echo "Output file not defined. Exiting ..."
      exit 1
fi

# Get video duration
fulltime=`ffmpeg -i "$INPUTFILE" 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//`;
seconds=0;
hour=`echo $fulltime | cut -d ':' -f 1`;
minute=`echo $fulltime | cut -d ':' -f 2`;
second=`echo $fulltime | cut -d ':' -f 3 | cut -d '.' -f 1`;
duration=`expr 3600 \* $hour + 60 \* $minute + $second`;

# Create sprites
if [ $duration -gt 0 ]; then
        frequency=$((duration / 80))
        if [ $frequency -lt 1 ]; then
            frequency=1;
        fi
        i=0;
        RND=`openssl rand -hex 2`
        TMPDIR="$OUTPUT_DIRECTORY""/tmp_"$RND
        mkdir "$TMPDIR"
        chmod 777 "$TMPDIR"
        while [ $i -lt $duration ]; do
                thumb="$TMPDIR/$i.jpg"
                ffmpeg -ss "$i" -i "$INPUTFILE" -vframes 1 -f image2 -s "$SPRITE_WIDTH"x"$SPRITE_HEIGHT" "$thumb"
                i=`expr $i + $frequency`
        done
        if [ -f $OUTPUTFILE ]; then
                rm -f $OUTPUTFILE
        fi
        convert -append "$TMPDIR/*.jpg" "$OUTPUTFILE"
        rm -rf "$TMPDIR"
else
        echo "Video duration = 0. Exiting..."
        exit 1
fi
