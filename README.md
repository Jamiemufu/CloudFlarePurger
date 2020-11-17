# CloudFlarePurger

This package will you allow you to purge the cache of specific URLS or purge everything from an API request rather than logging into Cloud Flare and purging from the menu.
This package works well with WebHook - for instance if content get's updated and your get notified via web-hook. You can immedatiatly and programmatically clear the cache for the page where content was updated.

## Installation

Navigate to root of project (or whever your composer.json is)

`composer require jamiemufu/cloud-flare-purger:dev-main`

## Get your Token and SiteID from Cloud Flare

Log into Cloud Flare and click on your profile - or issue a token to another user.

https://developers.cloudflare.com/api/tokens/create

Get the ZoneID for the site on Cloud Flare - This can be found by clicking 'Overview' on your site in Cloud Flare.


## Verify your token

Check if you have a valid token

```php
$request = new CloudFlarePurger('your_token', 'your_zone_id);

$request->verifyToken();
```

## Purge the whole site

```php
$request = new CloudFlarePurger('your_token', 'your_zone_id);

$request->purgeAll();
```

## Purge specific URL's

Pass an array of URL's to CloudFlarePurger

```php
$urls = [
  'https://example.com',
  'https://example.com/1'
];

$request = new CloudFlarePurger('your_token', 'your_zone_id);

$request->purgeUrls($urls);
```

Or pass a single in the array

```php
$urls = [
  'https://example.com',
];

$request = new CloudFlarePurger('your_token', 'your_zone_id);

$request->purgeUrls($urls);
```
