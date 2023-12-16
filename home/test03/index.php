<?php
$imput = "imput_msg";

$echo_language = "python ";
$echo_filename = "test01_imput.py ";
$command = $echo_language . $echo_filename;

$full_cmmand = $command . " " . escapeshellarg($imput);

exec($full_cmmand, $output);
for ($i = 0; $i < count($output); $i++) {
    print $output[$i] . "<br>\n";
}
