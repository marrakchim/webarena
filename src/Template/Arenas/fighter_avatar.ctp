<div class="fighters form large-9 medium-8 columns content">
    <h3>Edit my fighter <?= $fighter->name ?></h3>
    
    <div>
        <?= $this->Form->create(null, ['type' => 'file'], ['name' => 'avatar']) ?>
        <fieldset>
            <legend><?= __('Edit Fighter Avatar') ?></legend>

            <?= $this->Form->input('url', ['type' => 'file']) ?>

        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

    
</div>
