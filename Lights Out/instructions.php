<?php
require_once "lib/game.inc.php";
$view = new Lights\InstructionsView($lights);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructions</title>
    <link href="format.css" type="text/css" rel="stylesheet" />
</head>
<body>
<body>
<?php echo $view->present(); ?>
</body>
</body>
</html>