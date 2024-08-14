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

mysql_select_db($database_mysqli, $mysqli);
$query_kla_rec_admin = "SELECT * FROM std_it12";
$kla_rec_admin = mysql_query($query_kla_rec_admin, $mysqli) or die(mysql_error());
$row_kla_rec_admin = mysql_fetch_assoc($kla_rec_admin);
$totalRows_kla_rec_admin = mysql_num_rows($kla_rec_admin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p align="center">ข้อมูลสมาชิก สทส.12</p>
<p align="center"><a href="insert.php">insert data</a></p>
<form id="form1" name="form1" method="post" action="search1.php">
  <label for="search">
    <div align="center">ค้นหา :</div>
  </label>
  <div align="center">
    <input type="text" name="search" id="search" />
    <input type="submit" name="button" id="button" value="search" />
  </div>
</form>
<p align="center"><a href="logout.php">logout</a></p>
<p>&nbsp;</p>
<div align="center">
  <table border="1">
    <tr>
      <td><div align="center">id</div></td>
      <td><div align="center">code</div></td>
      <td><div align="center">name</div></td>
      <td><div align="center">dep</div></td>
      <td><div align="center">tel</div></td>
      <td>option</td>
      <td>option</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_kla_rec_admin['id']; ?></td>
        <td><?php echo $row_kla_rec_admin['code_std']; ?></td>
        <td><?php echo $row_kla_rec_admin['name_std']; ?></td>
        <td><?php echo $row_kla_rec_admin['dep_std']; ?></td>
        <td><?php echo $row_kla_rec_admin['tel_std']; ?></td>
        <td><a href="delete.php?id=<?php echo $row_kla_rec_admin['id']; ?>">delete</a></td>
        <td><a href="update.php?id=<?php echo $row_kla_rec_admin['id']; ?>">update</a></td>
      </tr>
      <?php } while ($row_kla_rec_admin = mysql_fetch_assoc($kla_rec_admin)); ?>
  </table>
</div>
<div align="center"></div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kla_rec_admin);
?>
