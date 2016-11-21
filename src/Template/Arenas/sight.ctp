<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="fighters index large-9 medium-8 columns content">
    <h3><?= __('Fighters Around You !') ?></h3>
<?php
// genere une version indexee des objets
$indexedFighters=array();
foreach ($fightersAround as  $f)
  $indexedFighters[$f->coordinate_x][$f->coordinate_y]=$f;
  ?>

    <table>
      <tbody>

        <?php
        // construit le plateau en vérifiant pour chaque case le tableau indexe
        for($i=0;$i<15;$i++)
        {
          echo '<tr>';
          for($j=0;$j<10;$j++)
          {
            if(isset($indexedFighters[$i][$j]))
              //echo "<td> ".$indexedFighters[$i][$j]->name." </td>";
              echo "<td> X </td>";
            else
              echo "<td> O </td>";
          }
          echo '</tr>';
        }
          ?>

      </tbody>
    </table>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
