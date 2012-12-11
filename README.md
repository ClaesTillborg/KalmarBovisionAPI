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
```

Detta kommer ge dig din första sida med API-dokumentationerna.
```php
/**
  * Skriver ut en HTML-sida med API:ets dokumentation.
  */
echo $myApi->apiDocs();
```

## Klasser
Det finns två enum-klasser som kommer att användas vid hämtning och filtrering av data i detta API och en Array-klass.
Enum
+ Coverage
+ ResidentType

Array-klass
+ ResidentTypeArray = Array-hanterare

###Coverage(\kalmarBovisionApi\model\Coverage)
Används för omfattningen av din sökning och innehåller alternativen:
+ county = Kalmar län(API:et har denna som default).
+ commune = Kalmar kommun.
+ city = Kalmar stad.
```php
/**
 * ex. Använder stad
 */
 $myCoverage = \kalmarBovisionApi\model\Coverage::city;
```

### ResidentType(\kalmarBovisionApi\model\ResidentType)
Används för att välja boendetyper på din sökning och innehåller följande alternativ:
+ all
+ villa
+ holidayHouse
+ farm
+ apartment
+ rentedApartment
+ sublet
+ land
+ parking
+ student

```php
/**
 * Filtrerar på alla sorter
 */
 $myResidentType = \kalmarBovisionApi\model\ResidentType::all;
```

### ResidentTypeArray
Detta är det objekt du sparar undan dina Boendetype för din sökning. Den Instansieras från API-klassen och kommer då ha alla som default.

```php
/**
 * Först instansieras objektet...
 */
$myTypeArray = $myApi->getResidentTypeArray();

/**
 * ...fylls på med boendetypen studentlägenheter
 */
$myTypeArray->addType(\kalmarBovisionApi\model\ResidentType::student);
```
Denna array kan nu fyllas på med ytterligare boendetyper eller skickas vidare

OBS! Om boende typen "all" läggs till kommer array:en att tömmas och bara innehålla den typen.

Man kan även nollställa sit objekt genom:
```php
/**
 * Nollställer din array
 */
$myTypeArray->setToDefault();
```

Hämtningsmetoderna kräver att detta objekt skickas in som parameter men array:en går att få tag i med:
```php
/**
 * Hämtar din array
 */
$arraycopy = $myTypeArray->getTypeArray();
```

OBS! denna array går inte att använda i API:ets sökningsfunktioner.

## Metoder
Det finns två sätt att söka bostäder; efter boendetyp eller alla. Dessa sökmetoder är delade i två versioner; registrerade och en där även ändrade typer finns med.

De sökmetoder som finns att använda är:
+ getRegisteredResidents()
+ getRegisteredResidentsByType(ResidentTypeArray)
+ getChangedResidents()
+ getChangedResidentsByType(ResidentTypeArray)

Omfattningen av din sökning kommer att vara satt på Kalmar län som default.
För att ändra sökarean:
+ setCoverage(\kalmarBovisionApi\model\Coverage);

För att hämta den array som ska användas vid sökning:
+ getResidentTypeArray()

```php
/**
 * Hämtar en array med bara nyregistrerade boenden
 */
$myApi->getRegisteredResidents();

/**
 * Gör en typbestämd sökning
 */
$myApi->getRegisteredResidentsByType($myTypeArray);

/**
 * Hämtar en array med både ändrade och registrerade boenden
 */
$myApi->getChangedResidents();

/**
 * Gör en typbestämd sökning
 */
$myApi->getChangedResidentsByType($myTypeArray);

/**
 * Ändrar sökarean till stad
 */
$myApi->setCoverage(\kalmarBovisionApi\model\Coverage::city);
```

## Resident-objekt




## Tillägg
Testningen görs av [SimpleTest](http://www.simpletest.org/) som finns inkluderat i mappen.