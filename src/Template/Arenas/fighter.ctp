<div class="fighters index large-9 medium-8 columns content">
    <h3>My Fighters</h3>
    
    <?= $this->Html->link(__('New Fighter'), ['action' => 'fighterAdd']) ?>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
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
                  <td><?= h($fighter->name) ?></td>
                  <td><?= $this->Number->format($fighter->level) ?></td>
                  <td><?= $this->Number->format($fighter->xp) ?></td>
                  <td><?= $this->Number->format($fighter->skill_sight) ?></td>
                  <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                  <td><?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></td>
                  <td class="actions">
                      <?= $this->Html->link(__('View'), ['action' => 'fighterView', $fighter->id]) ?>
                      <br />
                      <?= $this->Html->link(__('Edit'), ['action' => 'fighterAvatar', $fighter->id]) ?>
                      <br />
                      <? if($selectedFighter == $fighter->id) { echo "Fighter Selected"; } else { echo $this->Html->link(__('Select Fighter'), ['action' => 'fighterSelect', $fighter->id]); } ?>
                  </td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
