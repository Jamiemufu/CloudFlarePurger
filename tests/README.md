# CloudFlarePurger

These tests are just API calls

## Installation

`composer require jamiemufu/cloud-flare-purger:dev-main`

## Get your Token and SiteID from Cloud Flare

Log into Cloud Flare and click on your profile - or issue a token to another user.

https://developers.cloudflare.com/api/tokens/create

Get the ZoneID for the site on Cloud Flare - This can be found by clicking 'Overview' on your site in Cloud Flare.

## How to use tests

Just add `echo()` to `$verifyToken`, `$purgeAll` or `purgeUrls` to see the repsonse from Cloud Flare