#!/bin/bash

echo -n "Input Facebook AppID :"
read FACEBOOK_APPID

echo -n "Input Facebook Secret :"
read FACEBOOK_SECRET

echo -n "Input YJDN AppID :"
read YJDN_APPID

cat tmpl/conf/oiseal.ini \
    | sed s/{{yjdn-appid}}/$YJDN_APPID/g \
    | sed s/{{facebook-appid}}/$FACEBOOK_APPID/g \
    | sed s/{{facebook-secret}}/$FACEBOOK_SECRET/g \
    > conf/oiseal.ini

cat tmpl/public_html/assets/js/config.js \
    | sed s/{{yjdn-appid}}/$YJDN_APPID/g \
    | sed s/{{facebook-appid}}/$FACEBOOK_APPID/g \
    | sed s/{{facebook-secret}}/$FACEBOOK_SECRET/g \
    > public_html/assets/js/config.js
