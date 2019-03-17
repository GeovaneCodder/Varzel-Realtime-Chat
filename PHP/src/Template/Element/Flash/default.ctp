<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="col-md-6 text-center" style="margin: 2% auto;">
    <div class="alert alert-info" role="alert">
        <?php echo $message ?>
    </div>
</div>
