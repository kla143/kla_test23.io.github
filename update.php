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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE std_it12 SET code_std=%s, name_std=%s, dep_std=%s, tel_std=%s WHERE id=%s",
                       GetSQLValueString($_POST['upass'], "text"),
                       GetSQLValueString($_POST['myname'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['uname'], "int"));

  mysql_select_db($database_mysqli, $mysqli);
  $Result1 = mysql_query($updateSQL, $mysqli) or die(mysql_error());

  $updateGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rec_kla_up = "-1";
if (isset($_GET['id'])) {
  $colname_rec_kla_up = $_GET['id'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_rec_kla_up = sprintf("SELECT * FROM std_it12 WHERE id = %s", GetSQLValueString($colname_rec_kla_up, "int"));
$rec_kla_up = mysql_query($query_rec_kla_up, $mysqli) or die(mysql_error());
$row_rec_kla_up = mysql_fetch_assoc($rec_kla_up);
$totalRows_rec_kla_up = mysql_num_rows($rec_kla_up);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">id:</td>
      <td><input value="<?php echo $row_rec_kla_up['id']; ?>" type="text" name="uname" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">code</td>
      <td><input value="<?php echo $row_rec_kla_up['code_std']; ?>" type="text" name="upass" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">name:</td>
      <td><input value="<?php echo $row_rec_kla_up['name_std']; ?>" type="text" name="myname" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">dep</td>
      <td><input value="<?php echo $row_rec_kla_up['dep_std']; ?>" type="text" name="email" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tel:</td>
      <td><input value="<?php echo $row_rec_kla_up['tel_std']; ?>" type="text" name="tel" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="id" />
  <input type="hidden" name="MM_update" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rec_kla_up);
?>
