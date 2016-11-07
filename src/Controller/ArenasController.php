<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
  public function index()
  {
    $this->set('myname', "Malek Marrakchi");
    $this->loadModel('Fighters');
    $figterlist=$this->Fighters->find('all');
    $this->set('retour', $this->Fighters->test());
    
  }
}

?>
