<?php 
  /**  @var $model \app\models\User */
?>
<h1>Register</h1>
<?php use app\core\form\Form; ?>

<?php $form =  Form::begin('','post') ?>
  <div class="row">
    <div class="col">
      <?php echo $form->field($model,'firstname');?>
    </div>
    <div class="col">
      <?php echo $form->field($model,'lastname');?>
    </div>
  </div>
  <?php echo $form->field($model,'email');?>
  <?php echo $form->field($model,'password')->passwordField();?>
  <?php echo $form->field($model,'passwordConfirm')->passwordField();?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>