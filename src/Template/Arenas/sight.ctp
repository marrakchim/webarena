<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="fighters index large-9 medium-8 columns content">
    <h3><?= __('Fighters Around You !') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('player_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coordinate_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coordinate_y') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('level') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Strength') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Health') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('current_health') ?></th>
                <th scope="col"><?= $this->Paginator->sort('next_action_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('guild_id') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fightersAround as $fighter): ?>
            <form>
                <!--Check if the fighter is dead (Modify the test) (-> Other color, disabled...)-->
              <tr>
                  <td><?= h($fighter->name) ?></td>
                  <!--<td><?= h($fighter->player_id) ?></td>
                  <td><?= $this->Number->format($fighter->coordinate_x) ?></td>
                  <td><?= $this->Number->format($fighter->coordinate_y) ?></td>-->
                  <td><?= $this->Number->format($fighter->level) ?></td>
                  <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                  <td><?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></td>
                  <!--<td><?= $this->Number->format($fighter->current_health) ?></td>
                  <td><?= h($fighter->next_action_time) ?></td>
                  <td><?= $this->Number->format($fighter->guild_id) ?></td>-->
                  <td class="actions">
                      <?= $this->Html->link(__('Attack'), ['action' => 'view', $fighter->id]) ?>
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
