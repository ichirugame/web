#!/bin/bash
mkdir ./tmp
mv *.php tmp
rm -rf ./download/*
rm -rf ./download/.*
mv ./tmp/ .
rm -rf tmp
exit
