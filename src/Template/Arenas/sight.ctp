<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="fighters col-md-6 ">
  <div class='container'>
    <div class='row'>
        <h1 class='page-header'>Fighters around you</h1>

        <div class='well inline-info'>
          <p>
            <? if(file_exists(WWW_ROOT .'/img/avatars/'.$selectedFighter->id.'.jpg')){
              echo $this->Html->image('avatars/'.$selectedFighter->id.'.jpg',
              array(
                'width' => 40)
              );
              } else{ echo $this->Html->image('avatars/default.jpg', array(
                'width' => 40)); } ?>
          </p>
          <p>Your fighter : <?= $selectedFighter->name; ?></p>
          <p><? if($selectedGuild) {echo'Your fighter\'s guild is : '.$selectedGuild->name;
          } else {echo "Your fighter does not have a guild.";} ?></p>
        </div>
      </div>

      <div class='margin-top-20p col-md-4 well'>
        <center>
          <table class="arrow ">
            <tr>
              <td>
              </td>
              <td>
                <?= $this->Html->image("fh.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'moveUp'))); ?>
              </td>
              <td>
              </td>
            </tr>
            <tr>
              <td>
                <?= $this->Html->image("fg.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'moveLeft'))); ?>
              </td>
              <td>
                <?= $this->Html->image('sword.png', ['width' => 40]); ?>
              </td>
              <td>
                <?= $this->Html->image("fd.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'moveRight'))); ?>
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>
                <?= $this->Html->image("fb.jpg",
                      array(
                        'width' => 40,
                        'url' => array('controller' => 'arenas', 'action' => 'moveDown'))); ?>
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

                if(($selectedFighter->coordinate_x - $selectedFighter->skill_sight <= $i && $selectedFighter->coordinate_x + $selectedFighter->skill_sight >= $i && $selectedFighter->coordinate_y == $j)
                  || ($selectedFighter->coordinate_y - $selectedFighter->skill_sight <= $j && $selectedFighter->coordinate_y + $selectedFighter->skill_sight >= $j && $selectedFighter->coordinate_x == $i)){
                    $visible = true;
                }

                if(isset($indexedFighters[$i][$j]) && ($indexedFighters[$i][$j]->id == $this->request->session()->read("FighterSelected.id")))
                  echo "<td class='case'> Y </td>";
                elseif(($selectedFighter->coordinate_x - $selectedFighter->skill_sight <= $i && $selectedFighter->coordinate_x + $selectedFighter->skill_sight >= $i && $selectedFighter->coordinate_y == $j && !isset($indexedFighters[$i][$j]))
                  || ($selectedFighter->coordinate_y - $selectedFighter->skill_sight <= $j && $selectedFighter->coordinate_y + $selectedFighter->skill_sight >= $j && $selectedFighter->coordinate_x == $i && !isset($indexedFighters[$i][$j])))
                    echo "<td class='case'> O </td>";
                elseif($visible && isset($indexedFighters[$i][$j]))
                    echo "<td class='case'> X </td>";
                else
                  echo "<td class='case'> - </td>";
            }
            echo '</tr>';
          }
            ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
