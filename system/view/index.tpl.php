<?php foreach ($resources as $key => $data) { ?>

    <strong>
        <?=$key?>,
        <?=$data['url']?>
    </strong>
    <br>
    Method: <?=$data['method']?>
    <br>
    <?=$data['description']?>
    <br>

<?php } ?>