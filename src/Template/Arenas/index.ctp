<center>
  <h1>Welcome into the game WebArena, <?php echo $myname;?></h1>
  <br />
  <h4>Game Description</h4>
  <br />
  <p>
    -- game description --
  </p>
  <br />
  <?php
    $session = $this->request->session();

    if($this->request->session()->read('Players.id') == null){
      echo $this->Html->link(
      'Let\'s Start !',
      '/Arenas/login',
      ['class' => 'button']);
    }
   ?>
</center>
