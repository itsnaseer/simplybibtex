@echo off

cvs -d:pserver:seichter@technotecturecvs.ath.cx:/home/seichter/cvshome export -r HEAD SimplyBibTeX
del SimplyBibTeX\*.bat
del SimplyBibTeX\*.sh
del SimplyBibTeX\*.ppr
del SimplyBibTeX\.cvsignore
