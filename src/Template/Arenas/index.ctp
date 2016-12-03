
<center>
  <div><? echo $this->Html->image('welcome.png', ['alt' => 'Welcome']);
 ?></div>

<div class='game-description well'>
  <h3><span class="glyphicons glyphicons-gamepad"></span>ENTER THE FAMOUS WEBARENA!</h3>
  <p>Create your fighters and let them  </p>
  <p>fight your opponents!</p>
  <p>Attack the other fighters and gain experience</p>
  <p>to expand your view and level up!</p>
<div>

  <?php
    $session = $this->request->session();

    if($this->request->session()->read('Players.id') != null){
      echo $this->Html->link(
      'START ',
      '/Arenas/sight',
      ['class' => 'pixel-button']);
    }
    else{
      echo $this->Html->link(
      'LOGIN',
      '/Arenas/login',
      ['class' => 'pixel-button']);
    }
   ?>
</center>
