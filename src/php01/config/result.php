<?php
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$list= htmlspecialchars($_POST['list'], ENT_QUOTES);
$kosuu = htmlspecialchars($_POST['kosuu'], ENT_QUOTES);

print "お名前   :" . $name . "様" . "<br>";
print "ご希望の商品:" . $list . "<br>";
print "ご注文数  :" . $kosuu . "個";
