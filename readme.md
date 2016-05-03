# PHP Direct Print
This library allows printing files directly from PHP.
Avoid print dialog preview in the web browser.

## Installation

### Include the library

####Composer
If you are using composer, then add `neysi/directprint` as a dependency:

```sh
composer require neysi/directprint
```
####Manual

If you have no composer, download the code and include `autoload.php`

```sh
git clone https://github.com/neysi/directprint.git

```

```php
<?php
require __DIR__ . '/vendor/neysi/directprint/autoload.php');

```

##Methods

###printFile($fileName,$printerName)

Print on the default printer:

```php
$id =  DirectPrint::printFile('invoice.pdf') ;
```

Print on the Canon  iP2800 Printer:
```php
$id = DirectPrint::printFile('invoice.pdf','Canon_iP2800_series') ;
```

###getDefaultPrinter()
```php
$printerName =  DirectPrint::getDefaultPrinter() ;
```

###getPrinters()
```php
$printers =  DirectPrint::getPrinters() ;
```
###activeJobs()
Displays print queue

###cancelAllJobs()
Cancel all of the print queue

###cancelSpecificJob($jobID)
Cancel a specific print job
