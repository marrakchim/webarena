<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <?= $this->Html->link(__('Messages'), ['action' => 'chat']) ?>
</nav>

  <div class="fighters form large-9 medium-8 columns content">
      <?= $this->Form->create($message) ?>
      <fieldset>
          <legend><?= __('Send a Message') ?></legend>
          <?php
            $fighters = array();
            foreach($allFighters as $fighter){
              $fighters[] = $fighter->name;
            }
            echo $this->Form->input('title', ['label' => 'Object']);
            echo $this->Form->input('fighter_id', array('options' => $fighters, 'type' => 'select','empty' => true, 'label' => 'Select the Reciever'));
            echo $this->Form->textarea('message');
          ?>
      </fieldset>
      <?= $this->Form->button(__('Submit')) ?>
      <?= $this->Form->end() ?>
  </div>
