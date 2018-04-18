<?php
require "vendor/autoload.php";

use Intercom\IntercomClient;

$client = new IntercomClient("", null);
$httpclient = new \GuzzleHttp\Client();

$name = "test";
$email = "test@test.com";

$resp = $client->users->scrollUsers([]);

while (!empty($resp->scroll_param) && sizeof($resp->users) > 0){
    foreach ($resp->users as $user) {
        $intercom_id = $user.id;

        $res = $httpclient->request('GET', 'https://uinames.com/api/');
        $personArray = (json_decode($res->getBody()->getContents()));
        $name = $personArray['name'];

        $create = $client->users->create([
            $id => $intercom_id,
            "name" => $name
        ]);
    }
    $resp = $intercom->users->scrollUsers(["scroll_param" => $resp->scroll_param]);
}

echo "done";
