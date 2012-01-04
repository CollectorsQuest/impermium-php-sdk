<?php

/**
 * Copyright 2011 Collectors' Quest, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

class ImpermiumTestCase extends PHPUnit_Framework_TestCase
{
  /**
   * Replace here with your valid API key
   *
   * @var null|string
   */
  private $_api_key = null;

  public function testSetApiKey()
  {
    $impermium = new Impermium();
    $impermium->setApiKey('dummy');

    $this->assertEquals($impermium->getApiKey(), 'dummy', 'Expect the API key to be dummy.');
  }

  public function testApiUserAccount30()
  {
    $impermium = new Impermium(null, '3.0');
    $impermium->setApiKey($this->_api_key !== null ? $this->_api_key : $_SERVER['API_KEY']);

    try
    {
      $params = array(
        'user_id' => rand(11111, 99999),
        'operation' => 'CREATE',
        'enduser_ip' => '74.125.39.99',
        'first_name' => 'Johnny',
        'last_name' => 'Depp',
        'password_hash' => substr(hash('sha1', md5(uniqid('Impermium'))), 12),
        'email_identity' => 'johnny@example.org',
        'zip' => '24712',
        'user_url' => 'http://www.example.org',
        'profile_permalink' => 'http://www.example.org/users/1/johnny-depp',
        'http_headers' => array(
          "HTTP_ACCEPT_LANGUAGE" => "en-us,en;q=0.5",
          "HTTP_REFERER" => "http://search.yahoo.com/search/_ylt0oGdXSqha",
          "HTTP_ACCEPT_CHARSET" => "ISO-8859-1,utf-8;q=0.7,*;q=0.7",
          "HTTP_KEEP_ALIVE" => "300",
          "HTTP_ACCEPT_ENCODING" => "gzip,deflate",
          "HTTP_CONNECTION" => "keep-alive",
          "HTTP_ACCEPT" => "text/html,application/xhtml+xml;q=0.9,*/*;q=0.8",
          "HTTP_USER_AGENT" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/534.51.22 (KHTML, like Gecko) Version/5.1.1 Safari/534.51.22"
        )
      );
      $response = $impermium->api('user/account', $params, true);

      $this->assertEquals(substr($response['timestamp'], 0, 8), date('Ymd'), 'Check for the timestamp of the $response');
      $this->assertArrayHasKey('response_id', $response, 'Checking of $response has response_id');
      $this->assertArrayHasKey('spam_classifier', $response, 'Checking of $response has spam_classifier');
      $this->assertArrayHasKey('profanity_classifier', $response, 'Checking of $response has profanity_classifier');
      $this->assertArrayHasKey('quality_classifier', $response, 'Checking of $response has quality_classifier');
    }
    catch (ImpermiumApiException $e)
    {
      $this->fail($e->getMessage());
    }
  }

  public function testApiUserAccount31()
  {
    $impermium = new Impermium(null, '3.1');
    $impermium->setApiKey($this->_api_key !== null ? $this->_api_key : $_SERVER['API_KEY']);

    try
    {
      $params = array(
        'user_id' => rand(11111, 99999),
        'alias' => 'Johnny Depp the Pirate',
        'operation' => 'CREATE',
        'enduser_ip' => '74.125.39.99',
        'first_name' => 'Johnny',
        'last_name' => 'Depp',
        'password_hash' => substr(hash('sha1', md5(uniqid('Impermium'))), 12),
        'email_identity' => 'johnny@example.org',
        'zip' => '24712',
        'user_url' => 'http://www.example.org',
        'profile_permalink' => 'http://www.example.org/users/1/johnny-depp',
        'click_count' => 10, 'key_count' => 55,
        'http_headers' => array(
          "HTTP_ACCEPT_LANGUAGE" => "en-us,en;q=0.5",
          "HTTP_REFERER" => "http://search.yahoo.com/search/_ylt0oGdXSqha",
          "HTTP_ACCEPT_CHARSET" => "ISO-8859-1,utf-8;q=0.7,*;q=0.7",
          "HTTP_KEEP_ALIVE" => "300",
          "HTTP_ACCEPT_ENCODING" => "gzip,deflate",
          "HTTP_CONNECTION" => "keep-alive",
          "HTTP_ACCEPT" => "text/html,application/xhtml+xml;q=0.9,*/*;q=0.8",
          "HTTP_USER_AGENT" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/534.51.22 (KHTML, like Gecko) Version/5.1.1 Safari/534.51.22"
        )
      );
      $response = $impermium->api('account', $params, true);

      $this->assertEquals(substr($response['timestamp'], 0, 8), date('Ymd'), 'Check for the timestamp of the $response');
      $this->assertArrayHasKey('response_id', $response, 'Checking of $response has response_id');
      $this->assertArrayHasKey('spam_classifier', $response, 'Checking of $response has spam_classifier');
      $this->assertArrayHasKey('profanity_classifier', $response, 'Checking of $response has profanity_classifier');
      $this->assertArrayHasKey('quality_classifier', $response, 'Checking of $response has quality_classifier');
    }
    catch (ImpermiumApiException $e)
    {
      $this->fail($e->getMessage());
    }
  }
}
