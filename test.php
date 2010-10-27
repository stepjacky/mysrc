<?php 
  $imgs = '宋上的发生的,撒的发生大幅,哀伤的发生大幅,撒的发生大幅,';
  echo preg_replace("/(.+),/i",urlencode("$0"),$imgs);

  
 $string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string);
?>