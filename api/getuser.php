<?php
$data = json_decode(file_get_contents('php://input'), true);
$key = $data['key'];
$users = json_decode(file_get_contents("users.json"), true);

foreach ($users as $user) {
    if ($user["key"] == $key) {
        echo $user["name"];
        exit;
    }
}
echo "Not found";
?>

