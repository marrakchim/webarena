
<div class='container'>
  <div class='row'>
    <h1 class='page-header'>Actions diary</h1>
    <div class="fighters ">
      <h4 class='margin-top-30px'>Events in sight less than 24 hours</h4>

        <div class='table-responsive'>
          <table class='table' cellpadding="0" cellspacing="0">
              <thead>
                  <tr>
                      <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('coordinate_x') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('coordinate_y') ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($events as $event): ?>
                  <tr>
                      <td><?= h($event->date) ?></td>
                      <td><?= h($event->name) ?></td>
                      <td><?= $this->Number->format($event->coordinate_x) ?></td>
                      <td><?= $this->Number->format($event->coordinate_y) ?></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
