
  <?= $this->Form->create(null,['name' => 'Register']) ?>
    <fieldset>
        <legend><?= __('No account? Create one ! ') ?></legend>
        <?php
            echo $this->Form->input('email', ['value'=>'']);
            echo $this->Form->input('password', ['value'=>'']);
            echo $this->Form->input('confirmation', ['value'=>'', 'label'=>'Confirm your password','type'=>'password']);
        ?>
    </fieldset>

    <center>
        <?= $this->Form->button(__('Submit')) ?>
    </center>
  <?= $this->Form->end() ?>
