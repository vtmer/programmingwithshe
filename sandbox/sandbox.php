<?php
function compile($name) {
    $name = escapeshellarg($name);
    $command = 'gcc -O2 --static -lm -Wall -std=c99 -o ' . $name . ' ' .
        $name . '.c 2>&1';

    exec($command, $output, $return_val);

    var_dump($output);
    var_dump($return_val);
}

function run($name, $time, $memory, $input=null, $output=null) {
    $time = intval($time);
    $memory = intval($memory);
    $command = './runner' . $name . ' -t' . $time . ' -m' . $memory;
    if ($input)
        $command = $command . ' -i' . $input; 
    if ($output)
        $command = $command . ' -o' . $output;

    $command = escapeshellcmd($command);

    exec($command, $output, $return_val);
    
    var_dump($output);
    var_dump($return_val);
}

run('error', 1, 2, 'foo', 'bar');
?>
