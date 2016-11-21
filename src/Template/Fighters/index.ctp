<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fighter'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fighters index large-9 medium-8 columns content">
    <h3><?= __('Fighters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fighters number') ?></th>
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
                <!--Check if the fighter is dead (Modify the test) (-> Other color, disabled...)-->
              <tr>
                  <td><?= $this->Number->format($fighter->id) ?></td>
                  <td><?= h($fighter->name) ?></td>
                  <td><?= $this->Number->format($fighter->level) ?></td>
                  <td><?= $this->Number->format($fighter->xp) ?></td>
                  <td><?= $this->Number->format($fighter->skill_sight) ?></td>
                  <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                  <td><?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></td>
                  <td class="actions">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $fighter->id]) ?>
                      <br />
                      <?= $this->Html->link(__('Level Up'), ['action' => 'edit', $fighter->id]) ?>
                      <br />
                      <?= $this->Html->link(__('Select Fighter'), ['action' => 'selectFighter', $fighter->id]) ?>
                  </td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
