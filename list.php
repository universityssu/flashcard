<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$files = [];
$folder = 'file/';

if (is_dir($folder)) {
    $fileList = scandir($folder);
    foreach ($fileList as $file) {
        if ($file !== '.' && $file !== '..') {
            $filePath = $folder . $file;
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            
            if ($fileType === 'xlsx' || $fileType === 'xls') {
                $files[] = [
                    'name' => $file,
                    'size' => filesize($filePath),
                    'date' => date('Y-m-d H:i:s', filemtime($filePath))
                ];
            }
        }
    }
}

echo json_encode(['success' => true, 'files' => $files]);
?>