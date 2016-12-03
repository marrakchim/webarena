<div class="fighters form large-9 medium-8 columns content">
    <h3>Fighters of the guild : <?= $guild->name ?></h3>
    
    <p><? if(!$fighterInGuild) { echo $this->Html->link(__('Join Guild'), ['action' => 'guildjoin', $guild->id]); } ?></p>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('level') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fighters as $fighter): ?>
            <form>
              <tr>
                  <td><?= h($fighter->name) ?> <? if($selectedFighterId == $fighter->id) { echo "(My Fighter)"; } ?></td>
                  <td><?= $this->Number->format($fighter->level) ?></td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
