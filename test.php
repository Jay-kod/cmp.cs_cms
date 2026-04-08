<?php
$ch = curl_init('http://localhost:3000/admin/announcements');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
if (strpos($res, 'admin.announcements.settings') !== false || strpos($res, 'Route [') !== false) {
    file_put_contents('err.txt', substr($res, 0, 5000));
} else {
    file_put_contents('err.txt', 'looks good: ' . substr($res, 0, 200));
}
