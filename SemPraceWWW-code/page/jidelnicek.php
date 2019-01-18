<?php
$string = file_get_contents("/home/michael/test.json");
$json = json_decode($string, true);

foreach ($json as $key => $value) {
if (!is_array($value)) {
echo $key . '=>' . $value . '<br />';
} else {
foreach ($value as $key => $val) {
echo $key . '=>' . $val . '<br />';
}
}
}