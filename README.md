# Code Samples

A collection of code samples.

___

## [class.autoload.php](class.autoload.php)

Extends PHP's autoload_register function. Allows you to choose multiple directories to include your classes. 

### Setup / How To Use

By default, this class looks for classes by the name of the file(s).  For example, if your class is named `users` then it will look for `class.users.php`.

*NOTE: The paramater needs to be an absolute server path to the directory/directories.*

```php
$directories = array('/home/directory/public_html/app/modules/');
#autoload = new autoload($directories);
```
___

## [class.installer.php](class.installer.php)

Downloads remote framework archive and unpacks contents.

### Setup / How To Use

#### Option 1: Download custom archive, unpack, & create config file

```php
$install = new installer();
$install->download('http://your-domain.com/framework.zip');
$install->unpack();
$cred = array(
	'DB_HOST' => 'localhost', 
	'DB_DATABASE' => 'user_db12', 
	'DB_USER' => 'user_kewl', 
	'DB_PASSWORD' => 'abc123456'
);
$install->create($cred, 'config.php');
```

#### Option 2: Download public archive & unpack

```php
# Download and unzip Wordpress (or a framework of your choosing).

$install = new installer($url);
$install->download($install->framework['wordpress']);
$install->unpack();
```

___

## [class.page.php](class.page.php)

Example script of pulling page content from database based on the URI.  If the lookup of the `page` doesn't exist it will return a *404*.
___

## [class.recaptcha.php](class.recaptcha.php)

Simple PHP class for reCAPTCHA verification.  Can be used to easily work into any framework, or by itself.

Get your SITE & SERVER KEY here: https://www.google.com/recaptcha/

### Setup / How To Use

#### Server-side
```php
require('class.recaptcha.php');
$recaptcha = new recaptcha('your_SITE_KEY', 'your_SECRET_KEY');		
if(!$recaptcha->response()):
	print 'Sorry, you failed the reCAPTCHA';
else:
	// All your form processing here.
endif;
```

#### Client-side

If possible, paste this snippet before the closing `</head>` tag.

```php
$recaptcha->script();
```

Put this at the end of the form where you want the reCAPTCHA widget to appear.

```php
$recaptcha->widget();
```

You can optionally add different parameters to the 'widget' method.  _Shown below._ 

```php
$recaptcha->widget('dark', 'compact');
// 1st param - 'light' is default (light|dark)
// 2nd param - 'normal' is default (normal|compact)
```

___

## [class.url_parser.php](class.url_parser.php)

### Setup / How To Use

```php
$url = new url_parser('https://main.google.com/?test=action');
print '<pre>';
print_r($url->url);
print '</pre>';
```

#### Example Output
```
Array(
    [scheme] => https
    [host] => main.google.com
    [path] => /
    [query] => test=action
)
```

___

## [dancing-cat-bookmarklet.html](dancing-cat-bookmarklet.html)

Put a dancing cat on any website... because, why not? ¯\\\_(ツ)\_/¯

### Setup / How To Use

1. Run the HTML file in your browser.
2. Then click and drag the bookmarklet to your browser bookmark toolbar.
3. ???
4. Profit

___

## [function.errorlog_notify.php](function.errorlog_notify.php)

Be notified of when there are `error_log` files on your server.  Emails the locations of the `error_log` and the filesize.  Run on a CRON to automate running the script.
