<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="col-md-6 text-center" style="margin: 2% auto;">
    <div class="alert alert-success" role="alert">
        <?php echo $message ?>
    </div>
</div>
