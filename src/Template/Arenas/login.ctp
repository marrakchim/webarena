    <?= $this->Form->create(null,['name' => 'Login']) ?>
    <fieldset>
        <legend><?= __('Log In') ?></legend>
        <?php
            echo $this->Form->input('email', ['value'=>'']);
            echo $this->Form->input('password', ['value'=>'']);
        ?>
    </fieldset>
    <center>
        <?= $this->Form->button(__('Log In')) ?>
    </center>
    <?= $this->Form->end() ?>



    <?= $this->Form->create(null,['name' => 'ForgetPass']) ?>
    <fieldset>
        <legend><?= __('Did you forget your password ?') ?></legend>
        <?php
            echo $this->Form->input('email', ['value'=>'']);
        ?>
    </fieldset>
    <center>
        <?= $this->Form->button(__('Send Password')) ?>
    </center>
    <?= $this->Form->end() ?>
