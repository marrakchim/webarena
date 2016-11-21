<div class="fighters form large-9 medium-8 columns content">
    <?= $this->Form->create($fighter) ?>
    <fieldset>
        <legend><?= __('Add a Fighter') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
