<?php
require "vendor/autoload.php";

use Intercom\IntercomClient;

$client = new IntercomClient("", null);

$name = "test";
$email = "test@test.com";

$create = $client->users->create([
    "name" => $name
  ]);

  