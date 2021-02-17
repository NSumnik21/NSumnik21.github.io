<?php
require_once "lib/game.inc.php";
$view = new Lights\IndexView($lights);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link href="format.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $view->present(); ?>
</body>
</html>