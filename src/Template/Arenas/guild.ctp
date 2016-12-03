<div class="fighters index large-9 medium-8 columns content">
    <h3>Guilds</h3>
    
    <ul>
        <li><?= $this->Html->link(__('Create a new Guild'), ['action' => 'guildCreate']) ?></li>
    </ul>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guilds as $guild): ?>
            <form>
              <tr>
                  <td><?= h($guild->name) ?> <? if($fighterGuild == $guild->id) { echo "(My Guild)"; } ?></td>
                  <td class="actions">
                      <?= $this->Html->link(__('View'), ['action' => 'guildView', $guild->id]) ?>
                      <br />
                      <? if($fighterGuild == $guild->id) { echo $this->Html->link(__('Quit Guild'), ['action' => 'guildQuit', $guild->id]); } else { echo $this->Html->link(__('Join Guild'), ['action' => 'guildjoin', $guild->id]); } ?>
                  </td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
