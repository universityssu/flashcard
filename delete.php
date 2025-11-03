<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (isset($_POST['fileName'])) {
    $fileName = basename($_POST['fileName']);
    $filePath = 'file/' . $fileName;
    
    if (file_exists($filePath) && unlink($filePath)) {
        echo json_encode(['success' => true, 'message' => 'فایل حذف شد']);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در حذف فایل']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'نام فایل ارسال نشده']);
}
?>