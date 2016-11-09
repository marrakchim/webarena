<head><?php $this->assign('title', 'Diary');?></head>

<h2>Diary</h2>

<p>Events in sight less than 24 hours</p>

<div>
    <table cellpadding="0" cellspacing="0">
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