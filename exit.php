<?php   
/*��������� ������*/
session_start();
/*����������� ���������*/
require "settings_db.php";
require "lib_db.php";

unset_session_vars();
echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";	
?>