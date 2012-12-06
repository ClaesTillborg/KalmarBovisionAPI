KalmarBovisionAPI
=================


# Om API:et
Ett API skapat i studiesyfte för kursen PHP2 på [Linneuniversitetet](http://www.lnu.se). Här kan man hämta information om olika boendetyper från Kalmar län, Kalmar kommun eller Kalmar stad. Informationen i fråga kommer från Bovisions RSS-tjänst.

## Installation
API:et installeras genom att ladda ned samtliga filer och lägg dem i din projektmapp. Det följer en .htaccess och en index.php

I din index.php skall följade stå: 
```php
/**
  * API-dokumentet du kommer använda dig av.
  */
require_once("kalmarBovisionApi/KalmarBovisionApi.php");

/**
  * Skapa ett nytt API-objekt
  */
$myApi = new \kalmarBovisionApi\KalmarBovisionApi();

/**
  * Skriver ut en HTML-sida med API:ets dokumentation.
  */
echo $myApi->apiDocs();
```

Detta kommer ge dig din första sida med API-dokumentationerna.

## Tillägg
Testningen görs av [SimpleTest](http://www.simpletest.org/) som finns inkluderat i mappen.