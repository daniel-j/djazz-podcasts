#!/usr/bin/env bash

magick -verbose rss.png \( -size 256x256 -define gradient:vector="0,0 256,256" gradient:"#ff9900-#996600" -brightness-contrast 10x-30 -negate \) -compose overlay -composite -channel RGB -negate -alpha off -strip -compress none -define icon:auto-resize=16,32,48,64,256 favicon.ico
