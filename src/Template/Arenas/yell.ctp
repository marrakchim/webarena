
  <?= $this->Form->create(null, ['name' => 'yell']) ?>
    <fieldset>
        <legend><?= __('Yell something ! ') ?></legend>
        <?php
            echo $this->Form->input('message', ['type'=>'text', 'required'=>'true']);
        ?>
    </fieldset>

    <center>
        <?= $this->Form->button(__('Submit')) ?>
    </center>
  <?= $this->Form->end() ?>
