#!/bin/bash
mkdir ./tmp
mv *.php tmp
rm -rf ./download/*
rm -rf ./upload/*
mv ./tmp/ .
rm -rf tmp
exit
