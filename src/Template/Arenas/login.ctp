<?= $this->Form->create($player) ?>
<fieldset>
    <legend><?= __('Login') ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>


<?= $this->Form->create($player) ?>
<fieldset>
    <legend><?= __('No account? Create one ! ') ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('Confirm password');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
