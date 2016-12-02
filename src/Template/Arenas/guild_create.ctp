
  <?= $this->Form->create(null,['name' => 'guildCreate']) ?>
    <fieldset>
        <legend><?= __('Create your guild') ?></legend>
        <?php
            echo $this->Form->input('name', ['required'=>'true']);
        ?>
    </fieldset>

    <center>
        <?= $this->Form->button(__('Submit')) ?>
    </center>
  <?= $this->Form->end() ?>
