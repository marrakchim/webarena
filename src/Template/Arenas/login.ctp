<?= $this->Form->create(null,['name' => 'Login']) ?>
<fieldset>
    <legend><?= __('Login') ?></legend>
    <?php
        echo $this->Form->input('email', ['value'=>'']);
        echo $this->Form->input('password', ['value'=>'']);
    ?>
</fieldset>
<center>
    <?= $this->Form->button(__('Submit')) ?>
</center>
<?= $this->Form->end() ?>


<?= $this->Form->create(null,['name' => 'Register']) ?>
<fieldset>
    <legend><?= __('No account? Create one ! ') ?></legend>
    <?php
        echo $this->Form->input('email', ['value'=>'']);
        echo $this->Form->input('password', ['value'=>'']);
        echo $this->Form->input('Confirmation', ['value'=>'']);
    ?>
</fieldset>
<center>
    <?= $this->Form->button(__('Submit')) ?>
</center>
<?= $this->Form->end() ?>
