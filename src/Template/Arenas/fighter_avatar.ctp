<div class="fighters form large-9 medium-8 columns content">
    
    <fieldset>
        <legend><?= __('Edit Fighter Avatar') ?></legend>
        <?php
    
            
            
            // add the type to the create-method
            echo $this->Form->create($entity, ['type' => 'file']);

            // add the avatar-input
            echo $this->Form->input('avatar', ['type' => 'file']);
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
