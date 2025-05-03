<?php
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$key = $data['key'];
$hwid = $data['hwid'];
$duration = intval($data['minutes']);

$users = json_decode(file_get_contents("users.json"), true);

foreach ($users as $user) {
    if ($user["key"] == $key) {
        http_response_code(409);
        echo "Key already registered.";
        exit;
    }
}

$expiry = time() + ($duration * 60);
$users[] = [
    "name" => $name,
    "key" => $key,
    "hwid" => $hwid,
    "expiry" => $expiry
];

file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
echo "User registered.";
?>

