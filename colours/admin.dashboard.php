<?php

security_check();
admin_check();

define('APP_NAME', 'Colours');
define('PAGE_TITLE', 'Dashboard');
define('PAGE_SELECTED_SECTION', 'admin-dashboard');
define('PAGE_SELECTED_SUB_PAGE', '/admin/dashboard');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');
include('../templates/message.php');

$query = 'SELECT * 
    FROM colours 
    ORDER BY name';    
$result = mysqli_query($connect, $query);

$colours_count = mysqli_num_rows($result);

$colours_last_import = setting_fetch('COLOURS_LAST_IMPORT');

?>

<h1 class="w3-margin-top w3-margin-bottom">
    <img
        src="https://cdn.brickmmo.com/icons@1.0.0/colours.png"
        height="50"
        style="vertical-align: top"
    />
    Colours
</h1>

<p>
    Number of colours imported: <span class="w3-tag w3-blue"><?=$colours_count?></span> | 
    Last import: <span class="w3-tag w3-blue"><?=(new DateTime($colours_last_import))->format("D, M j g:i A")?></span>
</p>

<hr />

<h2>Colour List</h2>

<?php if (mysqli_num_rows($result)): ?>

    <div class="w3-container w3-border w3-padding-16 w3-margin-bottom">

        <?php while($colour = mysqli_fetch_assoc($result)): ?>

            <div class="w3-col l1 m2 s4 w3-margin-right w3-margin-left w3-center">
                <div style="width: 75px; height: 75px; background-color: #<?=$colour['rgb']?>"></div>
                <p>#<?=$colour['rgb']?></p>
            </div>

        <?php endwhile; ?>

    </div>

<?php else: ?>

    <div class="w3-panel w3-light-grey">
        <h3 class="w3-margin-top"><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i> Import Error</h3>
        <p>
            Colour data has not yet been imported from 
            <a href="https://rebrickable.com/api/">Rebrickable</a>.
        </p>
    </div>

<?php endif; ?>

<?php

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');
