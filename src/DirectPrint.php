<?php

/**
 *
 */
namespace Neysi\DirectPrint;
class DirectPrint
{

  public static function getPrinters()
  {
    exec('lpstat -a | awk \'{print $1}\'',$out);

    return is_array($out) ? $out : [];
  }

  public function cancelAllJobs()
  {
      exec('cancel -a');
  }

  public function cancelSpecificJob($jobID)
  {
      exec('cancel -a '.$jobID);
  }

  public function activeJobs()
  {
      exec('lpstat -o',$out);
      return $out;
  }

  public static function printFile($fileName, $printerName='default')
  {
     if($printerName=='default'){
       $printerName = self::getDefaultPrinter();
     }
    exec('lp -d '.$printerName.' '. $fileName,$out);

    //Get Print ID
    preg_match_all("!-([\d]+) \((.*)\)!",$out[0],$arr);

    return isset($arr[1]) ? $arr[1][0] : null;

  }

  public static function getDefaultPrinter()
  {
      exec('lpstat -d', $out);

      return preg_replace('/(.+): /', '', $out[0]) ;

  }

}
