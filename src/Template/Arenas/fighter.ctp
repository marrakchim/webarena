
<div class='container'>
  <div class='row'>
    <h1 class='page-header'>My Fighters</h1>
    <?
    echo $this->Html->link(
        ('Create a new fighter'),
        array('action' => 'fighterAdd'),
        array('class' => 'button btn btn-info')
    );
    ?>
    <div class="fighters ">
      <h4 class='margin-top-30px'>Events in sight less than 24 hours</h4>

        <div class='table-responsive'>
          <table class='table table-striped' cellpadding="0" cellspacing="0">
              <thead class='thead-default'>
                  <tr>
                      <th>Avatar</th>
                      <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('level') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('xp') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('Sight') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('Strength') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('Health') ?></th>
                      <th scope="col" class="actions"><?= __('Actions') ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($fighters as $fighter): ?>
                  <form>
                    <tr>
                        <td><? if(file_exists(WWW_ROOT .'/img/avatars/'.$fighter->id.'.jpg')){ echo $this->Html->image('avatars/'.$fighter->id.'.jpg', array('width'=>40)); } else{ echo $this->Html->image('avatars/default.jpg', array('width'=>40)); } ?></td>
                        <td><?= h($fighter->name) ?></td>
                        <td><?= $this->Number->format($fighter->level) ?></td>
                        <td><?= $this->Number->format($fighter->xp) ?></td>
                        <td><?= $this->Number->format($fighter->skill_sight) ?></td>
                        <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                        <td><?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'fighterView', $fighter->id]) ?>
                            <br />
                            <?= $this->Html->link(__('Edit Avatar'), ['action' => 'fighterAvatar', $fighter->id]) ?>
                            <br />
                            <? if($selectedFighter == $fighter->id) { echo "Fighter Selected"; } else { echo $this->Html->link(__('Select Fighter'), ['action' => 'fighterSelect', $fighter->id]); } ?>
                        </td>
                    </tr>
                  </form>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
