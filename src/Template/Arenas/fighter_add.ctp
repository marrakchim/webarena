

<div class='container'>
  <div class='row '>
    <h1 class='page-header'>Create a new fighter</h1>
    <div class='margin-10px'>
      <?
      echo $this->Html->link(
          ('Return to fighters'),
          array('action' => 'fighter'),
          array('class' => 'button btn btn-info')
      );
      ?>
    </div>
    <div class=''>

      <div class='margin-top-30px'>
        <?php echo $this->Form->create($fighter,
                array(
                  'inputDefaults' => array(
                    'div' => 'form-group',
                    'wrapInput' => 'col col-md-9',
                    'class' => 'form-control'
                  ),
                  'class' => 'well form-horizontal'
                )); ?>

          <?php echo $this->Form->input('name', array(
            'class' => 'form-control',
            'type' => 'text',
            'empty' => false,
            'required'=>'true',
            'label' => 'Choose a name for your fighter'
          )); ?>


          <div class="form-group">
            <?php echo $this->Form->submit('Submit', array(
              'div' => 'col col-md-9 col-md-offset-3',
              'class' => 'btn btn-default margin-top-left-15px'
            )); ?>
          </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>
