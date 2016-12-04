
<div class='container'>
  <div class='row '>
    <h1 class='page-header'>Edit  <?= $fighter->name ?>'s avatar</h1>
    <div class='margin-10px'>
      <?
      echo $this->Html->link(
          ('Return to fighters'),
          array('action' => 'fighter'),
          array('class' => 'button btn btn-info')
      );
      ?>
    </div>
    <div class='well'>

      <h3><?= $fighter->name ?>'s avatar</h3>
      <div>
        <?
        if(file_exists(WWW_ROOT .'/img/avatars/'.$fighter->id.'.jpg')){
          echo $this->Html->image('avatars/'.$fighter->id.'.jpg',
          array(
            'width' => 150)
          );
          } else{ echo $this->Html->image('avatars/default.jpg', array(
            'width' => 150)); }
        ?>
      </div>
      <div class='margin-top-30px'>
        <?php echo $this->Form->create('avatar',  array('type'=>'file'),
                array(
                  'inputDefaults' => array(
                    'div' => 'form-group',
                    'wrapInput' => 'col col-md-9',
                    'class' => 'form-control'
                  ),
                  'class' => 'well form-horizontal'
                )); ?>

          <?php echo $this->Form->input('url', array(
            'class' => 'form-control',
            'type' => 'file',
            'empty' => false,
            'required'=>'true',
            'label' => 'Choose your avatar'
          )); ?>


          <div class="form-group">
            <?php echo $this->Form->submit('Save', array(
              'div' => 'col col-md-9 col-md-offset-3',
              'class' => 'btn btn-default margin-top-30px'
            )); ?>
          </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>
