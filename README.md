## Synopsis

PHP code for keeping track of a simple home poker game. uses mysql as a backend, although any backend could be easily ported

## Motivation

started in 2001, and rehauled in 2010, just as a place to keep track of the winnings and losings of poker

## Installation

git clone it, create a database called 'poker' (or some other name if you desire)
replace USERNAME, PASSWORD in the files with a username, password combo that can access the pokerdb

mysql poker < poker.schema.sql

point the rest inside a webserver that serves php


## Contributors

Orignially written by Tim Newton and myself, and then re-written when all the bad php functions it depended on were fully depricated



