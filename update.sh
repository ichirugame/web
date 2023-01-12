#!/bin/bash
git clone https://github.com/ichirugame/web.git
cp -rf web/* .
cp -f web/.ht* .
rm -rf web
exit
