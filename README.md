Twitter Bearer Key Cheat Script
===================================

Introduction
-------------

On June 11 2013, Twitter [disabled V1 of their API](https://dev.twitter.com/blog/api-v1-is-retired). The biggest material change between V1 and V1.1 of the API is that authentication is now required for all requests (even read-only ones).

If you're making read-only requests of public data, it's probably overkill to go through the full process of generating User OAuth tokens. 

Luckily Twitter's API also supports application only authentication, essentially you need to [register your application](https://dev.twitter.com/apps), create a Consumer Key and Consumer Secret and then exchange those for a bearer token.

This script allows you to complete the final step without too much extra hassle, just provide the Consumer Key and Consumer Secret and the script will place the request for you.


Usage
------

The script has been designed with two use-cases in mind, you can either

- Include within your application, **OR**
- Call directly from the command line

The recommended usage is to call from the shell. If you're including within an app, you'll need to disclose the Consumer Key and Secret (both of which should be considered secret), so unless you've tight control over your source, it presents a possible security risk.



Command Line Usage
--------------------

Calling from the command line involves a simple

  php twitter_bearer_key.php {your consumer key} {your consumer secret}

The Bearer key will then be output.



Including in an application
----------------------------

The consumer key and secret will only be pulled from $argv if they are not already set, so before including the code we simply need to set their values. The other thing we probably want to do is to prevent the bearer key from being echoed, so the following should work

  <?php
  $no_display_token = true;
  $consumer_key = {your consumer key};
  $consumer_secret = {your consumer secret}
  require('twitter_bearer_key.php');

  // The bearer key is now in $k->access_token

  ?>


License
--------

This script is Copyright 2013 [Ben Tasker](http://www.bentasker.co.uk) released under the [GNU GPL V2](http://www.gnu.org/licenses/gpl-2.0.txt).