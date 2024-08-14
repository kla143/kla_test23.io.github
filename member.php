<?php require_once('Connections/mysqli.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO std_it12 (code_std, name_std, dep_std, tel_std) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['code_std'], "text"),
                       GetSQLValueString($_POST['name_std'], "text"),
                       GetSQLValueString($_POST['dep_std'], "text"),
                       GetSQLValueString($_POST['tel_std'], "text"));

  mysql_select_db($database_mysqli, $mysqli);
  $Result1 = mysql_query($insertSQL, $mysqli) or die(mysql_error());

  $insertGoTo = "member.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_mysqli, $mysqli);
$query_kla_rec_member = "SELECT * FROM std_it12";
$kla_rec_member = mysql_query($query_kla_rec_member, $mysqli) or die(mysql_error());
$row_kla_rec_member = mysql_fetch_assoc($kla_rec_member);
$totalRows_kla_rec_member = mysql_num_rows($kla_rec_member);

mysql_select_db($database_mysqli, $mysqli);
$query_member = "SELECT * FROM std_it12";
$member = mysql_query($query_member, $mysqli) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ข้อมูลสมาชิก สทส.12</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: #fff;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #eaeaea;
    }
    .container {
        max-width: 1000px;
        width: 100%;
        margin: 0 auto;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    h1 {
        color: #333;
    }
</style>
</head>
<body>
<form name="form1" method="post" action="">
  <div align="center">
    <p>ข้อมูลสมาชิก สทส.12
    </p>
    <p>&nbsp;</p>
    <table border="1">
      <tr>
        <td>id</td>
        <td>code_std</td>
        <td>name_std</td>
        <td>dep_std</td>
        <td>tel_std</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_kla_rec_member['id']; ?></td>
          <td><?php echo $row_kla_rec_member['code_std']; ?></td>
          <td><?php echo $row_kla_rec_member['name_std']; ?></td>
          <td><?php echo $row_kla_rec_member['dep_std']; ?></td>
          <td><?php echo $row_kla_rec_member['tel_std']; ?></td>
        </tr>
        <?php } while ($row_kla_rec_member = mysql_fetch_assoc($kla_rec_member)); ?>
    </table>
  </div>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kla_rec_member);

mysql_free_result($member);
?>
