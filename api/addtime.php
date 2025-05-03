<?php
$data = json_decode(file_get_contents('php://input'), true);
$key = $data['key'];
$minutes = intval($data['minutes']);
$users = json_decode(file_get_contents("users.json"), true);

foreach ($users as &$user) {
    if ($user["key"] == $key) {
        $user["expiry"] = max(time(), $user["expiry"]) + ($minutes * 60);
        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
        echo "Time added.";
        exit;
    }
}
echo "Key not found.";
?>

