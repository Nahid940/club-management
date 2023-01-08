<?php
//$path = "{{40048855000_1673206976_NID.pdf}}";
$path = "http://127.0.0.1:8000/storage/member_nid/40048855000_1673206976_NID.pdf";

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename='.$path);
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

readfile($path);