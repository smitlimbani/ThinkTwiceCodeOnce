<?php
/**
 * Created by PhpStorm.
 * User: Smit Limbani
 * Date: 6/19/2017
 * Time: 3:38 PM
 */

$file = $_GET["filename"];

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
else
{
    header("location:export_data.php?msg=Export Contents first!");
    exit;
}
?>
