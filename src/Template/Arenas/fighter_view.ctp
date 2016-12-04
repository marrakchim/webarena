<? $nextLevel = $fighter->level + 1; ?>

<div class='container'>
  <div class='row '>
    <h1 class='page-header'>Details of my fighter</h1>
    <div class='inline-info-space-between'>
        <?
        echo $this->Html->link(
            ('Return to fighters'),
            array('action' => 'fighter'),
            array('class' => 'button btn btn-info')
        );
        ?>

        <?
        echo $this->Html->link(
            ("Edit my fighter's avatar"),
            array('action' => 'fighterAvatar',$fighter->id),
            array('class' => 'button btn btn-warning')
        );
        ?>
    </div>

    <div class='row col-md-12 well'>
      <center>
        <?
        if(file_exists(WWW_ROOT .'/img/avatars/'.$fighter->id.'.jpg')){
          echo $this->Html->image('avatars/'.$fighter->id.'.jpg',
          array(
            'width' => 200)
          );
        } else{ echo $this->Html->image('avatars/default.png', array(
            'width' => 200)); }
        ?>

            <div><strong><?= $fighter->name ?></strong></div>
            <div>Level: <?= $this->Number->format($fighter->level) ?></div>
            <div>XP: <?= $this->Number->format($fighter->xp) ?></div>
            <div>Sight: <?= $this->Number->format($fighter->skill_sight) ?></div>
            <div>Strength: <?= $this->Number->format($fighter->skill_strength) ?></div>
            <div>Life: <?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></div>

      <center>
    </div>


          <div class='row col-md-12 well'>

              <?php if($fighter->xp >= 4): ?>

              <h2>Increase your fighter's level !</h2>

              <div class="inline-info">
                  <?
                    echo $this->Html->link(
                        ('Pass level '.$nextLevel.' and increase Sight (+1)'),
                        array('action' => 'fighterPassLevel', $fighter->id, 'sight'),
                        array('class' => 'button btn btn-info')
                        );

                    echo $this->Html->link(
                        ('Pass level '.$nextLevel.' and increase Strength (+1)'),
                        array('action' => 'fighterPassLevel', $fighter->id, 'strength'),
                        array('class' => 'button btn btn-info')
                        );

                    echo $this->Html->link(
                        ('Pass level '.$nextLevel.' and gain (+3) lifepoints'),
                        array('action' => 'fighterPassLevel', $fighter->id, 'life'),
                        array('class' => 'button btn btn-info')
                        );
                ?>
              </div>

              <?php else: ?>

              <h2>You cannot increase your fighter's level !</h2>

              <p>Get at least 4 experience points to pass to level <?= $nextLevel ?></p>

              <?php endif; ?>

          </div>






  </div>
</div>
