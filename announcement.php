<br/>
<?php
    $announcement = get_setting($con, 'announcement');
    if($announcement){
?>
    <div class="alert alert-warning" role="alert">
        <?php echo $announcement; ?>
    </div>
<?php } ?>
<br/>