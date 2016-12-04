

  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <h2 class="page-title">No account? Create one ! </h2>


          <?php echo $this->Form->create('Register', array(
            'inputDefaults' => array(
              'div' => 'form-group',
              'wrapInput' => 'col col-md-9',
              'class' => 'form-control'
            ),
            'class' => 'well form-horizontal'
          )); ?>
            <?php echo $this->Form->input('email', array(
              'placeholder' => 'Email','class' => 'form-control'
            )); ?>
            <?php echo $this->Form->input('password', array(
              'placeholder' => 'Password', 'class' => 'form-control'
            )); ?>
            <?php echo $this->Form->input('confirmation', array(
              'placeholder' => 'Confirm your password',
              'type'=>'password',
              'class' => 'form-control'
            )); ?>

            <div class="form-group">
              <?php echo $this->Form->submit('Register', array(
                'div' => 'col col-md-9 col-md-offset-3',
                'class' => 'btn btn-default margin-top-left-15px'
              )); ?>
            </div>
          <?php echo $this->Form->end(); ?>


        </div>
      </div>
    </div>
  </div>
