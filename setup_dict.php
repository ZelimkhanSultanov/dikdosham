<?php
include ("settings/bd.php");
$dicti = 'aslahanov_ru_ce';
$dict = 'dict/'.$dicti.'.txt';
$file_array = file($dict); // Считывание файла в массив $file_array

for ($i = 0; $i <= count($file_array); $i++) 
  { 
    list($word,$translate) = explode('|', $file_array[$i]);
    // $word1 = str_replace('̃','',$word);
    // $word1 = str_replace('́','',$word1);
    // mysql_query("INSERT INTO $dicti (word1, word,translate) VALUES ('$word1','$word', '$translate')"); 
    mysqli_query("INSERT INTO $dicti (word,translate) VALUES ('$word', '$translate')"); 
  }
?>