<div class="fighters index large-9 medium-8 columns content">
    <h3><?= __('Messages') ?></h3>
    
    <ul>
        <li><?= $this->Html->link(__('Send a message'), ['action' => 'newMessage']) ?></li>
        <li><?= $this->Html->link(__('Yell to everyone'), ['action' => 'yell']) ?></li>
    </ul>
    
    <h4>Messages received</h4>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($myMessage as $message): ?>
            <form>
              <tr>
                  <td><?= h($message->date) ?></td>
                  <td><?= h($message->title) ?></td>
                  <td><?= h($message->message) ?></td>
                  <td><?= h($message->from) ?></td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h4>Messages sent</h4>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($myMessageSent as $message): ?>
            <form>
              <tr>
                  <td><?= h($message->date) ?></td>
                  <td><?= h($message->title) ?></td>
                  <td><?= h($message->message) ?></td>
                  <td><?= h($message->to) ?></td>
              </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
