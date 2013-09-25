<?php

$file = "x.txt";
$content = fopen($file, "r");

while($line = fgets($content, 4096)){
    $array = explode(";", $line);
    $output[] = array_map('trim', $array);
}


echo "<table>";
foreach($output as $key => $value){
    echo "<tr>";
    foreach($value as $val){
        echo "<td>".$val."</td>";
    }
    echo "</tr>";
}
echo "</table>";
