<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{

  public function test()
  {
    return "ok";
  }

  public function getBestFighter()
  {
    $figterlist=$this->Fighters->find('all');
    $levels=[];
    foreach($fighter as $fighterslist)
    {
      
    }

    return ;
  }

}

?>
