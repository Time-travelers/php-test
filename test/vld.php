<?php
$code =<<<PHP_CODE
TIPI:深⼊理解PHP内核 RELEASE_2012-04-04_V0.7.3
<?php
$str = "Hello, Tipi\n";
echo $str;
PHP_CODE;
echo '<pre>';
var_dump(token_get_all($code));