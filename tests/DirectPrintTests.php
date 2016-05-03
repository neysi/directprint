<?php

use Neysi\DirectPrint\DirectPrint;

class DirectPrintTest extends PHPUnit_Framework_TestCase
{

  public function testNothing()
  {
    $this->assertTrue(true);
  }


  public function testGetPrinters()
  {
    $printers = DirectPrint::getPrinters();

    return ( $printers ) > 0;
  }

}
