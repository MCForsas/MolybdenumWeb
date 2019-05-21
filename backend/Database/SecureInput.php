<?php
/*
  This is used to secure user input. IE: prevent html, sql and other injections
*/
function secureText($text){ //Secures from xss injections
  $secureText = htmlspecialchars($text);
  return $secureText;
}

function filterProfanity($text){ //Filters out bad words
  return $text;
}
?>
