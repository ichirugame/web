#!/bin/bash
cd ../
git clone https://github.com/ichirugame/web.git
mkdir tmp
mv db.php tmp
cp -rf web/* .
cp -f web/.ht* .
rm -rf web
mv tmp/db.php .
rm -rf tmp
rm -f README.md
exit
