<?php
require_once "lib/game.inc.php";
$view = new Lights\GameView($lights);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <link href="format.css" type="text/css" rel="stylesheet" />
    <script src="dist/main.js"></script>
</head>
<body>
<?php echo $view->present_header();?>
<div class="game">
    <?php echo $view->present_body();?>
</div>
<?php echo $view->present_footer();?>
</body>
</html>