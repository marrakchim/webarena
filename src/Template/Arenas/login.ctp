
      <div class="content-wrapper">
        <div class="container-fluid">

          <div class="row" id='container-login'>
            <div class="col-md-12 ">
              <h2 class="page-title">Log in</h2>

              <?php echo $this->Form->create('Log In', array(
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

              	<div class="form-group">
              		<?php echo $this->Form->submit('Log in', array(
              			'div' => 'col col-md-9 col-md-offset-3',
              			'class' => 'btn btn-default margin-top-left-15px'
              		)); ?>
              	</div>
              <?php echo $this->Form->end(); ?>
            </div>
          </div>

          <? echo $this->Form->button('Forgot your password ?', array(
              'type' => 'button',
              'id' => 'btn-password-forgot',
              'class' => 'btn btn-default margin-10px'
              ));
          ?>

          <div id="popup-forgot-password" class="popup">
            <div class="row modal-pop">
              <div class="col-md-6 col-md-offset-2">
                <div class=" row bk-light">
                  <div class="text-center text-dark block-match">
                    <div class="page-header">

                      <h1>Forgot your password?</h1>

                      <div class="mb-3x mt-2x text-justify">

                        <?php echo $this->Form->create('Log In', array(
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

                          <div class="form-group">
                            <?php echo $this->Form->submit('Log in', array(
                              'div' => 'col col-md-9 col-md-offset-3',
                              'class' => 'btn btn-default margin-top-left-15px'
                            )); ?>
                          </div>
                        <?php echo $this->Form->end(); ?>

                        <? echo $this->Form->button('Close', array(
                          'type' => 'button',
                          'id' => 'close-popup',
                          'class' => 'col-md-6 btn btn-default'
                          ));?>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>




<script>

  $('#btn-password-forgot').on('click',function(){
        $('#popup-forgot-password').addClass('slideDown');
        $('#container-login').hide();
        $('#btn-password-forgot').hide();
  });

  $('#close-popup').on('click', function(){
        $('#popup-forgot-password').removeClass('slideDown');
        $('#container-login').show();
        $('#btn-password-forgot').show();

  });


</script>
