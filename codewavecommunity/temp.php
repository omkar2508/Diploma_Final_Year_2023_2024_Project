<?php
exec("php D:\Abhay\Xampp\htdocs\codewavecommunity\copy.php", $output, $return_var);
echo "<pre>";
print_r($output);
echo "</pre>";
echo "Return Value: $return_var";
?>

