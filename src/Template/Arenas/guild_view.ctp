

<div class='container'>
  <div class='row '>
    <h1 class='page-header'>Fighters of the guild : <?= $guild->name ?></h1>
    <div class='inline-info-space-between'>
        <?
        echo $this->Html->link(
            ('Return to guild'),
            array('action' => 'guild'),
            array('class' => 'button btn btn-info')
        );
        ?>

        <?
        if(!$fighterInGuild){
          echo $this->Html->link(
              ("Join guild"),
              array('action' => 'guildjoin',$guild->id),
              array('class' => 'button btn btn-warning')
          );
        } else {
          echo $this->Html->link(
              ("Quit guild"),
              array('action' => 'guildQuit',$guild->id),
              array('class' => 'button btn btn-warning')
          );
        }
        ?>
    </div>

    <div class='row col-md-12 well'>
        <table class='table' cellpadding="0" cellspacing="0">
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


  </div>
</div>
