# Simple Adbrowser php class
##Description
This is sample api class to use for connection with Adbrowser instance.
Developer documentation can be found under link below:
www.adbrowser.net/docs/

##Requirements
- adbrowser account
- PHP 5.3 or higher
- PHP JSON extension

##Sample use
Before start, edit **$_accessToken** variable with your actual API key, and **$_systemLogin** variable with your system nickname.

######Basic usage
```php
$adb = new Adbrowser(); //Initializing object

//Preparing parameters array, according to manual, without "key" parameter
$params = array( 'parameter' => 'value', 'parameter2' => 'value2' );

$return = $adb->prepareQuery('function_name', $params, "get");
```

According to above example with function to get specific user data
http://adbrowser.net/docs/users.php#getUser
will look like this:

```php
$adb = new Adbrowser(); //Initializing object

//Preparing parameters array, according to manual, without "key" parameter
$params = array( 'user_id' => '13');

$return = $adb->prepareQuery('getUserDetails', $params, "get");
```

####Bugs & issues
Please report all bugs and issues to: maciej@adbrowser.net
