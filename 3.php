<?php
require_once "config.php";
//$sqlo="SELECT COUNT(*) As E FROM msg WHERE did_fk=25 and cid_fk=$7 and rid_fk=71";
//$data=mysql_fetch_assoc($sqlo);
//echo $data['E'];

$sqlo = "SELECT chat_id FROM msg WHERE did_fk=25 and cid_fk=7 and rid_fk=71";
$stmto = mysqli_query($connect, $sqlo);

$cnt= mysqli_num_rows ( $stmto );
echo $cnt;
?>