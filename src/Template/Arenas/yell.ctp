

    <div class="content-wrapper">
      <div class="container-fluid">

        <?
        echo $this->Html->link(
            ('Back to messages'),
            array('action' => 'chat'),
            array('class' => 'button btn btn-info')
        );
        ?>

        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Yell something !</h2>

              <?php echo $this->Form->create('yell', array(
                'inputDefaults' => array(
                  'div' => 'form-group',
                  'wrapInput' => 'col col-md-9',
                  'class' => 'form-control'
                ),
                'class' => 'well form-horizontal'
              )); ?>

                <?php echo $this->Form->input('message', array(
                  'class' => 'form-control',
                  'type' => 'text',
                  'empty' => false,
                  'required'=>'true',
                  'placeholder' => 'This message will be seen by everyone',
                  'label' => 'Type your message'
                )); ?>


                <div class="form-group">
                  <?php echo $this->Form->submit('Yell', array(
                    'div' => 'col col-md-9 col-md-offset-3',
                    'class' => 'btn btn-default margin-top-left-15px'
                  )); ?>
                </div>
              <?php echo $this->Form->end(); ?>

            </div>
          </div>
        </div>
      </div>
