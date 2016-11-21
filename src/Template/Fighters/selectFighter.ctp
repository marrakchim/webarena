<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fighters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="fighters form large-9 medium-8 columns content">
    <?= $this->Form->create($fighter) ?>
    <fieldset>
        <legend><?= __('Add Fighter') ?></legend>
        <?php
            $coordinate_x = rand(0,15);
            $coordinate_y = rand(0,10);
            echo $this->Form->input('name');
            echo $this->Form->input('player_id');
            echo $this->Form->input('coordinate_x', ['value' => $coordinate_x, 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('coordinate_y', ['value' => $coordinate_y, 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('level', ['value' => '1', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('xp', ['value' => '0', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('skill_sight', ['value' => '0', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('skill_strength', ['value' => '1', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('skill_health', ['value' => '3', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('current_health', ['value' => '3', 'disabled' => 'true', 'required' => false]);
            echo $this->Form->input('next_action_time', ['empty' => true]);
            echo $this->Form->input('guild_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
