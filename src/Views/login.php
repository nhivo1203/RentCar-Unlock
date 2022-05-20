<?php

use Nhivonfq\Unlock\Views\form\Form;

$form = new Form();
?>

<h1>Login</h1>

<?php $form = Form::begin('', "post"); ?>
<?php echo $form->field($model, 'email')->emailField() ?>
<br>
<?php echo $form->field($model, 'password')->passwordField() ?>
<br>
<button type="submit" class="btn btn-primary">Submit</button>

<?php
$form = Form::end();
?>
