<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <?= $this->Html->link(__('Messages'), ['action' => 'chat']) ?>
</nav>

  <div class="fighters form large-9 medium-8 columns content">

  </div>
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <h2 class="page-title">Send a message</h2>


            <?php echo $this->Form->create($message, array(
              'inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => 'col col-md-9',
                'class' => 'form-control'
              ),
              'class' => 'well form-horizontal'
            )); ?>
            <?php
              $fighters = array();
              foreach($allFighters as $fighter){
                $fighters[] = $fighter->name;
              }?>
              <?php echo $this->Form->input('title', array(
                'placeholder' => 'Object',
                'class' => 'form-control',
                'label' => 'Object'
              )); ?>
              <?php echo $this->Form->input('fighter_id', array(
                'options' => $fighters,
                'class' => 'form-control',
                'type' => 'select',
                'empty' => false,
                'label' => 'Select the Reciever'
              )); ?>
              <?php echo $this->Form->textArea('message', array(
                'placeholder' => 'Enter your message',
                'class' => 'form-control'
              )); ?>

              <div class="form-group">
                <?php echo $this->Form->submit('Send message', array(
                  'div' => 'col col-md-9 col-md-offset-3',
                  'class' => 'btn btn-default margin-top-left-15px'
                )); ?>
              </div>
            <?php echo $this->Form->end(); ?>

          </div>
        </div>
      </div>
    </div>
