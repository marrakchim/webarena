
  <?= $this->Form->create(null,['name' => 'guildEvent']) ?>
    <fieldset>
        <legend><?= __('Create an event for your guild ! ') ?></legend>
        <?php
            echo $this->Form->input('Name of the event', ['type'=>'text', 'required'=>'true']);
            echo $this->Form->input('Date', ['type'=>'date','required'=>'true']);
            echo $this->Form->input('coordinate_x', ['type'=>'integer', 'required'=>'true']);
            echo $this->Form->input('coordinate_y', ['type'=>'integer', 'required'=>'true']);

        ?>
    </fieldset>

    <center>
        <?= $this->Form->button(__('Submit')) ?>
    </center>
  <?= $this->Form->end() ?>
