Impermium PHP SDK (v1.0)
==========================

[Impermium](http://www.impermium.com) is a service to help you fight with social spam.
Read more about [Impermium API](http://www.impermium.com/api) on their website.

Usage
-----

The minimal you'll need to have is:

    require 'impermium-php-sdk/src/Impermium.class.php';

    $impermium = new Impermium('YOUR_APP_KEY');

To make [API][API] calls:

    try
    {
      $params = array(
        'user_id' => 123456,
        'operation' => 'CREATE',
        'enduser_ip' => '74.125.39.99',
        'first_name' => 'Johnny',
        'last_name' => 'Depp',
        'password_hash' => 'Sw0rdf1sh',
        'email_identity' => 'johnny@example.org'
      );

      $response = $impermium->api('user/account', $params);
    }
    catch (ImpermiumApiException $e) { ; }

[API]: http://www.impermium.com/api

Tests
-----

The tests can be executed by using this command from the base directory:

    API_KEY=123456789abcdefghijk phpunit --stderr --bootstrap tests/bootstrap.php tests/tests.php
