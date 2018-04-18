<?php
require "vendor/autoload.php";

use Intercom\IntercomClient;

$client = new IntercomClient("", null);

$name = "test";
$email = "test@test.com";

$resp = $client->users->scrollUsers([]);
$count = 0;

while (!empty($resp->scroll_param) && sizeof($resp->users) > 0){
    foreach ($resp->users as $user) {
        $intercom_id = $user.id;

        $create = $client->users->create([
            $id => $intercom_id,
            "email" => "fake@fake.com"+$count
        ]);
        
        $count = $count + 1;
    }
    $resp = $intercom->users->scrollUsers(["scroll_param" => $resp->scroll_param]);
}

echo "done";