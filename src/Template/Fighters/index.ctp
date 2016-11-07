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
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('player_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coordinate_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coordinate_y') ?></th>
                <th scope="col"><?= $this->Paginator->sort('level') ?></th>
                <th scope="col"><?= $this->Paginator->sort('xp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_sight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_strength') ?></th>
                <th scope="col"><?= $this->Paginator->sort('skill_health') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_health') ?></th>
                <th scope="col"><?= $this->Paginator->sort('next_action_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('guild_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fighters as $fighter): ?>
            <tr>
                <td><?= $this->Number->format($fighter->id) ?></td>
                <td><?= h($fighter->name) ?></td>
                <td><?= h($fighter->player_id) ?></td>
                <td><?= $this->Number->format($fighter->coordinate_x) ?></td>
                <td><?= $this->Number->format($fighter->coordinate_y) ?></td>
                <td><?= $this->Number->format($fighter->level) ?></td>
                <td><?= $this->Number->format($fighter->xp) ?></td>
                <td><?= $this->Number->format($fighter->skill_sight) ?></td>
                <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                <td><?= $this->Number->format($fighter->skill_health) ?></td>
                <td><?= $this->Number->format($fighter->current_health) ?></td>
                <td><?= h($fighter->next_action_time) ?></td>
                <td><?= $this->Number->format($fighter->guild_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fighter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fighter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fighter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fighter->id)]) ?>
                </td>
            </tr>
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
