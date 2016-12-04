<div class="fighters col-md-6 ">
  <div class='container'>
    <div class='row'>
        <h1 class='page-header'>ARENA</h1>

        <h2>My Fighter</h2>

        <div class='well inline-info'>
          <p>
            <? if(file_exists(WWW_ROOT .'/img/avatars/'.$selectedFighter->id.'.jpg')){
              echo $this->Html->image('avatars/'.$selectedFighter->id.'.jpg',
              array(
                'width' => 50)
              );
            } else{ echo $this->Html->image('avatars/default.png', array(
                'width' => 50)); } ?>
          </p>
            <div>
                <p>Your fighter : <?= $selectedFighter->name; ?> (<?= $this->Number->format($selectedFighter->coordinate_x) ?>;<?= $this->Number->format($selectedFighter->coordinate_y) ?>)</p>
                <p><? if($selectedGuild) {echo'Your fighter\'s guild is : '.$selectedGuild->name;} else {echo "Your fighter does not have a guild.";} ?></p>
            </div>
            <div>
                <ul>
                    <li>Level: <?= $this->Number->format($selectedFighter->level) ?></li>
                    <li>XP: <?= $this->Number->format($selectedFighter->xp) ?></li>
                    <li>Strength: <?= $this->Number->format($selectedFighter->skill_strength) ?></li>
                    <li>Life: <?= $this->Number->format($selectedFighter->current_health) . ' / ' . $this->Number->format($selectedFighter->skill_health) ?></li>
                </ul>
            </div>

        </div>

        <h2>Players around</h2>

        <div class="well inline-info">

            <?php foreach ($fightersAround as $fighter): ?>
                <?php if ($selectedFighter->id != $fighter->id): ?>
                <ul>
                    <li><? if(file_exists(WWW_ROOT .'/img/avatars/'.$fighter->id.'.jpg')){
              echo $this->Html->image('avatars/'.$fighter->id.'.jpg',
              array(
                'width' => 50)
              );
            } else{ echo $this->Html->image('avatars/default.png', array(
                'width' => 50)); } ?></li>
                    <li><strong><?= $fighter->name ?> (<?= $this->Number->format($fighter->coordinate_x) ?>;<?= $this->Number->format($fighter->coordinate_y) ?>)</strong></li>
                    <li>Level: <?= $this->Number->format($fighter->level) ?></li>
                    <li>XP: <?= $this->Number->format($fighter->xp) ?></li>
                    <li>Strength: <?= $this->Number->format($fighter->skill_strength) ?></li>
                    <li>Life: <?= $this->Number->format($fighter->current_health) . ' / ' . $this->Number->format($fighter->skill_health) ?></li>
                    <li>Guild: <?= $fighter->guild; ?></li>
                </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

      </div>

      <div class='col-md-4 well'>
        <center>
          <table class="arrow ">
            <tr>
              <td>
              </td>
              <td>
                <?= $this->Html->image("fh.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'move', 'up'))); ?>
              </td>
              <td>
              </td>
            </tr>
            <tr>
              <td>
                <?= $this->Html->image("fg.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'move', 'left'))); ?>
              </td>
              <td>
                <?= $this->Html->image('sword.png', ['width' => 40]); ?>
              </td>
              <td>
                <?= $this->Html->image("fd.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'move', 'right'))); ?>
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>
                <?= $this->Html->image("fb.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'move', 'down'))); ?>
              </td>
              <td>
              </td>
            </tr>
          </table>
      </center>
    </div>

  <?php
  // genere une version indexee des objets
  $indexedFighters=array();
  foreach ($fightersAround as  $f)
    $indexedFighters[$f->coordinate_x][$f->coordinate_y]=$f;
    $view = false;
    ?>
    <div class='table-responsive'>
      <table class="map table col-md-4 col-md-offset-2">
        <tbody>

            <?php
                // construit le plateau en vérifiant pour chaque case le tableau indexe
                for($i=0;$i<15;$i++)
                {
                    echo '<tr>';

                    for($j=0;$j<10;$j++)
                    {
                        $visible = false;

                        if($selectedFighter->skill_sight >= abs($selectedFighter->coordinate_x - $i) + abs($selectedFighter->coordinate_y - $j)) { $visible = true; }

                          if(isset($indexedFighters[$i][$j]) && ($indexedFighters[$i][$j]->id == $this->request->session()->read("FighterSelected.id"))){
                          echo "<td class='case view'>";
                          if(file_exists(WWW_ROOT .'/img/avatars/'.$selectedFighter->id.'.jpg')){
                            echo $this->Html->image('avatars/'.$selectedFighter->id.'.jpg',
                            array(
                              'width' => 30)
                            );
                          } else{ echo $this->Html->image('avatars/default.png', array(
                              'width' => 30)); }

                          echo "</td>";

                        }
                        elseif($visible && !isset($indexedFighters[$i][$j]))
                        echo "<td class='case view'>  </td>";

                        elseif($visible && isset($indexedFighters[$i][$j])){
                          echo "<td class='case view'>";
                          if(file_exists(WWW_ROOT .'/img/avatars/'.$indexedFighters[$i][$j]->id.'.jpg')){
                            echo $this->Html->image('avatars/'.$indexedFighters[$i][$j]->id.'.jpg',
                            array(
                              'width' => 30)
                            );
                          } else{ echo $this->Html->image('avatars/default.png', array(
                              'width' => 30)); }

                          echo "</td>";
                        }

                        else
                        echo "<td class='case vide'>  </td>";
                    }

                    echo '</tr>';
                }
            ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
