#!/bin/sh

rm -rf SimplyBibTeX
cvs -d:pserver:seichter@technotecturecvs.ath.cx:/home/seichter/cvshome export -r HEAD SimplyBibTeX

rm -f SimplyBibTeX/*.sh
rm -f SimplyBibTeX/*.bat
rm -f SimplyBibTeX/*.ppr

tar cfjv SimplyBibTeX-`date +%d%m%Y`.tar.bz2 SimplyBibTeX
zip -r SimplyBibTeX-`date +%d%m%Y` SimplyBibTeX
