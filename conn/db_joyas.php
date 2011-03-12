<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db_joyas = "localhost";
$database_db_joyas = "joyas";
$username_db_joyas = "joyas";
$password_db_joyas = "joyas";
$db_joyas = mysql_pconnect($hostname_db_joyas, $username_db_joyas, $password_db_joyas) or trigger_error(mysql_error(),E_USER_ERROR); 
?>