<div class='container'>
  <div class='row '>
    <h1 class='page-header'>Guilds</h1>
    <div class='margin-10px'>
      <?
      echo $this->Html->link(
          ('New guild'),
          array('action' => 'guild_create'),
          array('class' => 'button btn btn-warning')
      );
      ?>
    </div>
    <div class='well'>
      <table class="table" cellpadding="0" cellspacing="0">
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
                        <? if($fighterGuild == $guild->id) {
                          echo $this->Html->link(__('Quit Guild'), ['action' => 'guildQuit', $guild->id]);
                        } else {
                          echo $this->Html->link(__('Join Guild'), ['action' => 'guildjoin', $guild->id]); } ?>
                    </td>
                </tr>
              </form>
              <?php endforeach; ?>
          </tbody>
      </table>
    </div>

  </div>
</div>
