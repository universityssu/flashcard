<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileName = basename($_FILES['file']['name']);
    $filePath = 'file/' . $fileName;
    
    // بررسی نوع فایل
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    if ($fileType !== 'xlsx' && $fileType !== 'xls') {
        echo json_encode(['success' => false, 'message' => 'فقط فایل‌های اکسل مجاز هستند']);
        exit;
    }
    
    // آپلود فایل
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        echo json_encode(['success' => true, 'message' => 'فایل با موفقیت آپلود شد', 'fileName' => $fileName]);
    } else {
        echo json_encode(['success' => false, 'message' => 'خطا در آپلود فایل']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'خطا در دریافت فایل']);
}
?>