#!/bin/sh

rm -rf SimplyBibTeX
cvs -d:pserver:seichter@technotecturecvs.ath.cx:/home/seichter/cvshome export -r HEAD SimplyBibTeX

rm -f SimplyBibTeX/*.sh

tar cfjv SimplyBibTeX-`date +%d%m%Y`.tar.gz SimplyBibTeX
zip -r SimplyBibTeX-`date +%d%m%Y` SimplyBibTeX
