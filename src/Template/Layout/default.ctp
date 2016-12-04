<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->script(['jquery-3.1.1.min','bootstrap.min']);?>
    <?= $this->Html->css('mystyle');  ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-left">
          <li>
            <? echo $this->Html->image('logo.png', ['alt' => 'logo']);?>
          </li>
          <li class="">
              <a href="" class='game-title'>webarena</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">


            <? if(null==$this->request->session()->read('Players.email')){
              echo '<li>'.$this->Html->link(
                'Login',
                ['controller' => 'Arenas', 'action' => 'login']
              ).'<li>';
              echo '<li>'.$this->Html->link(
                'Subscribe',
                ['controller' => 'Arenas', 'action' => 'subscribe']
              ).'<li>';
              }else{
              echo '<li>'.$this->Html->link(
                'Home',
                ['controller' => 'Arenas', 'action' => 'index']
              ).'<li>';
              echo '<li>'.$this->Html->link(
                 'Fighters',
                 ['controller' => 'Arenas', 'action' => 'fighter']
              ).'<li>';
              echo '<li>'.$this->Html->link(
               'Arenas',
               ['controller' => 'Arenas', 'action' => 'sight']
             ).'<li>';
             echo '<li>'.$this->Html->link(
               'Chat',
               ['controller' => 'Arenas', 'action' => 'chat']
             ).'<li>';
             echo '<li>'.$this->Html->link(
               'Diary',
               ['controller' => 'Arenas', 'action' => 'diary']
             ).'<li>';
             echo '<li>'.$this->Html->link(
               'Logout',
               ['controller' => 'Arenas', 'action' => 'logout']
             ).'<li>';

            }
            ?>


          </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>



    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
