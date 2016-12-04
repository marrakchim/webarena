
      <div class="content-wrapper">
        <div class="container-fluid">

          <div class="row" id='container-login'>
            <div class="col-md-12 well">
              <h2 class="page-title">Log in</h2>
              <?= $this->Form->create(null,['name' => 'Login']) ?>

              <div class="">

                <div class="row" >
                  <div class="col-md-9 col-md-offset-2">
                    <? echo $this->Form->input('email', array('required'=>'true','placeholder'=>'example@gmail.com','type' => 'email', 'class' => 'form-control mb padding-10px margin-10px' ));;?>
                  </div>

                  <div class="col-md-9 col-md-offset-2">
                    <? echo $this->Form->input('password', array('required'=>'true','label'=>'Password','placeholder'=>'Password','type' => 'password', 'class' => 'form-control mb padding-10px margin-10px' ));?>
                  </div>
                </div>

                <div class="col-md-offset-2">

                  <? echo $this->Form->button('Log In', array(
                      'type' => 'button',
                      'class' => 'btn btn-default margin-10px'
                      ));
                  ?>

                </div>

              <?= $this->Form->end() ?>

            </div>

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
                      <?= $this->Form->create(null,['name' => 'ForgetPass']) ?>

                      <div class="mb-3x mt-2x text-justify">
                        <? echo $this->Form->input('email', array('required'=>'true','label'=>'Type your email address','placeholder'=>'emailgiven@example.com','type' => 'email', 'class' => 'form-control mb padding-10px margin-10px'));
                           echo $this->Form->button('Send password', array(
                            'type' => 'button',
                            'class' => 'col-md-6 btn btn-error'
                            ));
                           echo $this->Form->button('Close', array(
                            'type' => 'button',
                            'id' => 'close-popup',
                            'class' => 'col-md-6 btn btn-default'
                            ));


                        ?>
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
