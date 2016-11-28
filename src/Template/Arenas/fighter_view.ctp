<div class="fighters form large-9 medium-8 columns content">
    <h3>Details of my fighter</h3>
    
    <div><? if(file_exists(WWW_ROOT .'/img/avatars/'.$fighter->id.'.jpg')){ echo $this->Html->image('avatars/'.$fighter->id.'.jpg', ['alt' => 'Avatar']); } else{ echo $this->Html->image('avatars/default.jpg', ['alt' => 'Avatar']); } ?></div>
    
    <ul>
        <li><?= $fighter->name ?></li>
        <li>Level: <?= $this->Number->format($fighter->level) ?></li>
        <li>XP: <?= $this->Number->format($fighter->xp) ?></li>
        <li>Sight: <?= $this->Number->format($fighter->skill_sight) ?></li>
        <li>Strength: <?= $this->Number->format($fighter->skill_strength) ?></li>
        <li>Life: <?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></li>
    </ul>
    
</div>
