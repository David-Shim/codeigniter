<?php
if($start_number<=1){
    $previous_button = '';
}else{
    $previous_button = '<li class="page-item"><a class="page-link" href="./'.($start_number-1).'">Previous</a></li>';
}

if($last_number<=0){
    $next_button = '';
}else{
    $next_button = '<li class="page-item"><a class="page-link" href="./'.($start_number+1).'">Next</a></li>';
}
?>
<ul class="pagination justify-content-center" style="margin:20px 0">
    <?php echo $previous_button;?>
    <?php

    for($x=$start_number;$x <=($start_number+$last_number);$x++){
        echo '<li class="page-item"><a class="page-link" href="./'.$x.'">'.$x.'</a></li>';
    }
    ?>
    <?php echo $next_button;?>
</ul>