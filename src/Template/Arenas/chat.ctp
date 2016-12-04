<div class="fighters index col-md-6 ">
  <div class='container'>
    <div class='row'>
        <h1 class='page-header'>Messages</h1>
        <div class='inline-info-space-between'>
          <?
          echo $this->Html->link(
              ('Send a message'),
              array('action' => 'newMessage'),
              array('class' => 'button btn btn-info')
          );
          ?>
          <?
          echo $this->Html->link(
              ('Yell to everyone'),
              array('action' => 'yell'),
              array('class' => 'button btn btn-info')
          );
          ?>
          <?
          echo $this->Html->link(
              ('New guild'),
              array('action' => 'guild_create'),
              array('class' => 'button btn btn-warning')
          );
          ?>
        </div>

        <h4 class='margin-top-30px'>Messages received</h4>
        <div class='table-responsive'>
          <table class='table' cellpadding="0" cellspacing="0">
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
                    <tr class='warning'>
                        <td><?= h($message->date) ?></td>
                        <td><?= h($message->title) ?></td>
                        <td><?= h($message->message) ?></td>
                        <td><?= h($message->from) ?></td>
                    </tr>
                  </form>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>

        <div class='table-responsive'>
          <h4 class='margin-top-30px'>Messages sent</h4>
          <table class='table' cellpadding="0" cellspacing="0">
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
                    <tr class='info'>
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

    </div>
  </div>
</div>

<div class="fighters index large-9 medium-8 columns content">





  </div>
