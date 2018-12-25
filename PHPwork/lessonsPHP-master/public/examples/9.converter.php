<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 18.12.2018
 * Time: 20:40
 */

$funts = "";
$gramms = "";
if(!empty((int)$_POST['funts'])) {
    $funts = (int)$_POST['funts'];
    $gramms = $funts * 453;
} elseif (!empty($_POST['gramms'])) {
    $gramms = (int)$_POST['gramms'];
    $funts = $gramms / 453;
}

echo "<form action=\"index.php\" method=\"post\">
	Фунты: <input name=\"funts\" 
	    type=\"number\" 
	    placeholder='{$funts}'/><br/>
	Граммы: <input name=\"gramms\" 
	    type=\"number\"
	    placeholder=\"{$gramms}\" /><br/>
	<input type=\"submit\" value=\"Send\" />
</form>";
