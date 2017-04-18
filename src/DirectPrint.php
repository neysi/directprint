<?php

namespace Neysi\DirectPrint;

class DirectPrint
{
    private static $availablePrinterOptions = [
        'collate',
        'fit-to-page',
        'job-hold-until',
        'job-priority',
        'job-sheets',
        'landscape',
        'media',
        'mirror',
        'number-up',
        'number-up-layout',
        'orientation-requested',
        'outputorder',
        'page-border',
        'page-ranges',
        'raw',
        'scaling',
        'sides',
    ];

    public static function getPrinters()
    {
        exec('lpstat -a | awk \'{print $1}\'', $out);

        return is_array($out) ? $out : [];
    }

    public function cancelAllJobs()
    {
        exec('cancel -a');
    }

    public function cancelJob($jobId)
    {
        exec('cancel -a ' . $jobId);
    }

    public function activeJobs()
    {
        exec('lpstat -o', $out);

        return $out;
    }

    public static function printFile($fileName, $printerName = 'default', $optionsArr = [])
    {
        if ($printerName === 'default') {
            $printerName = self::getDefaultPrinter();
        }

        $printerOptions = '';
        foreach ($optionsArr as $key => $value) {
            if (self::isValidPrinterOption($key)) {
                $printerOptions .= ' -o ' . $key . (!empty($value) ? '=' . $value : '');
            }
        }

        exec('lp' . $printerOptions . ' -d ' . $printerName . ' ' . $fileName, $out);

        // Get job id
        preg_match_all("!-([\d]+) \((.*)\)!", $out[0], $arr);

        return isset($arr[1]) ? $arr[1][0] : null;
    }

    public static function getDefaultPrinter()
    {
        exec('lpstat -d', $out);

        return preg_replace('/(.+): /', '', $out[0]);
    }

    protected static function isValidPrinterOption($option)
    {
        return is_string($option) && in_array($option, self::$availablePrinterOptions);
    }
}
