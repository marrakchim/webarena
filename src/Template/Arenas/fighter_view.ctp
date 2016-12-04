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
          } else{ echo $this->Html->image('avatars/default.jpg', array(
            'width' => 200)); }
        ?>

            <div><?= $fighter->name ?></div>
            <div>Level: <?= $this->Number->format($fighter->level) ?></div>
            <div>XP: <?= $this->Number->format($fighter->xp) ?></div>
            <div>Sight: <?= $this->Number->format($fighter->skill_sight) ?></div>
            <div>Strength: <?= $this->Number->format($fighter->skill_strength) ?></div>
            <div>Life: <?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></div>

      <center>
    </div>


  </div>
</div>
