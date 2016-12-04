

  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <h2 class="page-title">No account? Create one ! </h2>
          <?= $this->Form->create(null,['name' => 'Register']) ?>

          <div class="well">

          <form action=""  class="mt">
            <div class="row col-md-9" >
                <? echo $this->Form->input('email', array('required'=>'true','placeholder'=>'example@gmail.com','type' => 'email', 'class' => 'form-control mb padding-10px margin-10px' ));;?>
            </div>

            <div class="row" >
              <div class="col-md-6">
                <? echo $this->Form->input('password', array('required'=>'true','placeholder'=>'Password','type' => 'password', 'class' => 'form-control mb padding-10px margin-10px' ));?>
              </div>

              <div class="col-md-6">
                <? echo $this->Form->input('confirmation', array('required'=>'true','label'=>'Confirm your password','placeholder'=>'Confirm your password','type' => 'password', 'class' => 'form-control mb padding-10px margin-10px' ));?>
              </div>
            </div>

            <? echo $this->Form->button('Submit', array(
                'type' => 'button',
                'class' => 'btn btn-default margin-10px'
                ));
            ?>

          </form>
          <?= $this->Form->end() ?>

        </div>

        </div>
      </div>
    </div>
  </div>
