<?php
$data = json_decode(file_get_contents('php://input'), true);
$key = $data['key'];
$hwid = $data['hwid'];
$users = json_decode(file_get_contents("users.json"), true);

foreach ($users as $user) {
    if ($user["key"] == $key) {
        if ($user["hwid"] == $hwid) {
            if (time() < $user["expiry"]) {
                echo "VALID|" . $user["name"];
                exit;
            } else {
                echo "EXPIRED";
                exit;
            }
        } else {
            echo "HWID_MISMATCH";
            exit;
        }
    }
}
echo "KEY_NOT_FOUND";
?>

