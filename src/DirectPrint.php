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

  public function cancelJob($jobID)
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

    //Get job id
    preg_match_all("!-([\d]+) \((.*)\)!",$out[0],$arr);

    if (isset($arr[1])){
          $id = $printerName .'-'. $arr[1][0];
    }else{
          $id = null;
    }

    return $id;

  }

  public static function getDefaultPrinter()
  {
      exec('lpstat -d', $out);

      return preg_replace('/(.+): /', '', $out[0]) ;

  }

}
