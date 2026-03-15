<?php
$i = 1;

while ($i <= 20) { // 「21未満」でも良いですが、20までと明示するなら <= 20
    echo $i . '<br />';
    $i++; // 1ずつ増やす
}
?>
<br><br> <hr>     <br><br>
<?php
for ($i = 1; $i <= 20; $i++) {
    // 確実に改行を入れるため、HTMLの<br>を出力
    echo $i . "<br />\n"; 
}
?>
<br><br> <hr>     <br><br>
<?php
$count = 0;

while ($count <= 100) {
  if ($count === 20) {
    break;
  }
  if ($count % 3 === 0) {
    $count++;
    continue;
  }
  echo $count . '<br />';
  $count++;
}

?>