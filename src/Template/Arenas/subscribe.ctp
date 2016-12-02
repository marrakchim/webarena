
  <?= $this->Form->create(null,['name' => 'Register']) ?>
    <fieldset>
        <legend><?= __('No account? Create one ! ') ?></legend>
        <?php
            echo $this->Form->input('email', ['value'=>'example@gmail.com','required'=>'true']);
            echo $this->Form->input('password', ['required'=>'true']);
            echo $this->Form->input('confirmation', ['label'=>'Confirm your password','type'=>'password', 'required'=>'true']);
        ?>
    </fieldset>

    <center>
        <?= $this->Form->button(__('Submit')) ?>
    </center>
  <?= $this->Form->end() ?>
