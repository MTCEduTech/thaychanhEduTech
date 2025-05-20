<?php
$username = $_POST['username'] ?? '';
$oldPass = $_POST['oldPass'] ?? '';
$newPass = $_POST['newPass'] ?? '';

if (!$username || !$oldPass || !$newPass) {
    echo "Thiếu thông tin.";
    exit;
}

$filepath = 'ds.html';
$content = file_get_contents($filepath);

// Tìm dòng chứa username và mật khẩu cũ
$pattern = "/<tr><td>" . preg_quote($username, '/') . "<\/td><td>" . preg_quote($oldPass, '/') . "<\/td><\/tr>/";

// Nếu tìm thấy → thay bằng dòng mới
if (preg_match($pattern, $content)) {
    $newRow = "<tr><td>$username</td><td>$newPass</td></tr>";
    $content = preg_replace($pattern, $newRow, $content);
    file_put_contents($filepath, $content);
    echo "success";
} else {
    echo "Mật khẩu cũ không đúng!";
}
?>
