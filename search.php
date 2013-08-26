<html>

<head>
<title>-- Search Screen of Wine store -- </title>
</head>

<?php
require_once('database.php');
if(!$dbconnect = mysql_connect(DB_HOST, DB_USER, DB_PW))
{
echo 'Could not connect to mysql ' . DB_HOST . '\n';
exit;
}


if(!mysql_select_db(DB_NAME, $dbconnect))
{
echo 'Could not user database ' . DB_NAME . '\n';
echo mysql_error() . '\n';
exit;
}


    $query = 'SELECT * FROM grape_variety ORDER BY variety';
    $varieties = mysql_query($query, $dbconnect);


    $query = 'SELECT * FROM region ORDER BY region_name';
    $regions = mysql_query($query, $dbconnect);

   
    $yearArray = array();
    $query = 'SELECT DISTINCT year FROM wine ORDER BY year';
    $years = mysql_query($query, $dbconnect);
    $x = 0;
    while($row = mysql_fetch_row($years))
{
        $yearArray[$x] = $row[0];
        $x++;
    }
?>

<body>

<div align="center">

<div>
<div><h3><font size="18">Search Screen of Wine store </font></h3></div>
</div>
<div>

<form action="search_re.php" method="get" id="searchResult" name="searchResult">
<input type="hidden" id="criteria" name="criteria" />
<table>

<tr>
<td bgcolor="white"><strong>1. Wine Name</strong></td>
<td bgcolor="white">
<input type="text" name="winename" id="winename" class="txt" /></td>
</tr>
<!-- Table Row 2 -->
<tr>

<td><strong>2 Winery Name</strong></td>
<td bgcolor="white">
<input type="text" name="wineryname" id="wineryname" class="txt" /></td>
</tr>

<tr>
<td bgcolor="white"><strong>3 Region</strong></td>
<td bgcolor="white">
<select name="region" id="region">
<option value="0" selected="selected"> Select Region </option>
<?php
                            while($row = mysql_fetch_row($regions))
{
                                echo "<option value=\"$row[0]\">$row[1]</option>\n";
                            }
                        ?>
</select></td>
</tr>

<tr>
<td><strong>4 Grape Variety</strong></td>
<td>
<select name="grapeVariety" id="grapeVariety">
<option value="0" selected="selected"> Select Variety </option>
<?php
                            while($row = mysql_fetch_row($varieties))
{
                                echo "<option value=\"$row[0]\">$row[1]</option>\n";
                            }
                        ?>
</select></td>
</tr>

<tr>
<td bgcolor="white"><strong>5 Range of Years</strong></td>
<td bgcolor="white">
From
<select name="yearFrom" id="yearFrom">
<option value="0" selected="selected"> Select Year </option>
<?php
                            for($i=0; $i<count($yearArray); $i++)
{
                                echo "<option value=\"$yearArray[$i]\">$yearArray[$i]</option>\n";
                            }
                        ?>
</select>
to
<select name="yearTo" id="yearTo">
<option value="0" selected="selected"> Select Year </option>
<?php
                            for($i=0; $i<count($yearArray); $i++)
{
                                echo "<option value=\"$yearArray[$i]\">$yearArray[$i]</option>\n";
                            }
                        ?>
</select>
</td>
</tr>

<tr>
<td><strong>6 Min Number in Stock</strong></td>
<td><input type="text" name="min_instock" id="min_instock" class="number" /></td>
</tr>

<tr>
<td bgcolor="#D8CEF6"><strong>7 Min Number Ordered</strong></td>
<td bgcolor="#F2EFFB"><input type="text" name="min_ordered" id="min_ordered" class="number" /></td>
</tr>

<tr>
<td><strong>8 Cost Range</strong></td>
<td> (MIN)$<input type="text" name="min_cost" id="min_cost" class="number" /> (MAX)$<input type="text" name="max_cost" id="max_cost" class="number" /></td>
</tr>

<tr>
<td colspan="2" align="right" bgcolor="#F8E0F7"><input type="submit" name="btnSubmit" id="btnSubmit" value="Search" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="btnRst" id="btnRst" value="Reset form" /></td>
</tr>
</table>
</form>
</div>
</div>
</body>
<?php
    mysql_close($dbconnect);
    echo error_get_last();
?>
</html>
