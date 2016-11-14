<?= $this->Form->create($player) ?>
<fieldset>
    <legend><?= __('Subscribe') ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        //echo $this->Form->input('password_check', array('label'=>'Confirm your password','type'=>'password'))

    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
