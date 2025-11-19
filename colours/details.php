<?php

define('APP_NAME', 'Colours');
define('PAGE_TITLE', 'Colour Details');
define('PAGE_SELECTED_SECTION', '');
define('PAGE_SELECTED_SUB_PAGE', '');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_slideout.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');

include('../templates/message.php');

$query = 'SELECT colours.*, (
    SELECT GROUP_CONCAT(DISTINCT externals.name SEPARATOR ", ")
    FROM externals WHERE colours.id = externals.colour_id
) AS externals
FROM colours
WHERE id = "'.addslashes($_GET['key']).'"
LIMIT 1';
$result = mysqli_query($connect, $query);
$record = mysqli_fetch_assoc($result);

?>

<main>   
    <div class="w3-center">
        <h1><?=$record['name']?></h1>
    </div>
    <hr>
    <div class="w3-container w3-padding w3-center">
        <div style="display: inline-block; position: relative; width: 120px; height: 120px; margin-bottom: 16px;">
            <div style="background-color: #<?=$record['rgb']?>; width: 100%; height: 100%; border-radius: 8px; border: 1px solid #ccc;"></div>
            <?php if($record['is_trans'] == 'yes'): ?>
                <span style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; background: url('https://cdn.brickmmo.com/images@1.0.0/trans-checkers.png') repeat; background-position: center; opacity: 0.5; border-radius: 8px;"></span>
            <?php endif; ?>
        </div>
        <p><strong>Name:</strong> <?=$record['name']?></p>
        <p><strong>RGB:</strong> #<?=$record['rgb']?></p>
        <p><strong>Transparent:</strong> <?=$record['is_trans'] == 'yes' ? 'Yes' : 'No'?></p>
        <p><strong>Externals:</strong> <?=$record['externals'] ?: '-'?></p>
        <p><strong>ID:</strong> <?=$record['id']?></p>
    </div>
    <hr>
    <a href="/q" class="w3-button w3-white w3-border">
        <i class="fa-solid fa-caret-left fa-padding-right"></i>
        Back to Colour List
    </a>
</main>

<?php

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');