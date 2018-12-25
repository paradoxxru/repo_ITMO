<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 06.12.2018
 * Time: 13:37
 */

?>
<form method="post" action="index.php">
    <input name="plates" type="text">
    <input name="soap" type="text">
    <button>Помыть!</button>
</form>
<?php
//todo  Array
//todo (
//todo     [plates] =>
//todo     [soap] =>
//todo )
$plates = $_POST['plates'];
$soap = $_POST['soap'];
while($plates > 0 && $soap > 0) {
    $plates--; //todo $plates = $plates - 1;
    $soap -= 0.5;//todo $soap = $soap - 0.5;
    echo "Осталось " . $plates .
        " тарелок и " . $soap . " моющего средства." .
        "<br/>";
}
if($plates > 0)
    echo "Осталось " . $plates . " тарелок.";
if($soap > 0)
    echo "Осталось " . $soap . " моющего средства.";

// echo "<pre>" . print_r($_POST, true) . "</pre>";
