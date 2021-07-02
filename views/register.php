<h1>Register</h1>
<?php

use app\core\form\Form;
use app\Utility as u;

?>

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
<!-- <form action="" method="post">
  <div class="form-group">
    <label >First Name</label>
    <input type="text" name="firstname" class="form-control" >
  </div>
  <div class="form-group">
    <label >Last Name</label>
    <input type="text" name="lastname" class="form-control" >
  </div>
  <div class="form-group">
    <label >Email address</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <div class="form-group">
    <label >Password Confirm</label>
    <input type="password" name="passwordConfirm" class="form-control" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->