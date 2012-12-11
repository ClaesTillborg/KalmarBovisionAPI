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
+ ResidentTypeArray

###Coverage(\kalmarBovisionApi\model\Coverage)
Används för omfattningen av din sökning och innehåller alternativen:
+ county = Kalmar län(API:et har denna som default)
+ commune = Kalmar kommun
+ city = Kalmar stad

```php
/**
 * ex. Använder stad
 */
 $myCoverage = \kalmarBovisionApi\model\Coverage::city;
```

### ResidentType(\kalmarBovisionApi\model\ResidentType)
Används för att välja boendetyper på din sökning och innehåller följande alternativ:
+ all = alla
+ villa = villa
+ holidayHouse = fritidshus
+ farm = lantbruk
+ apartment = bostadsrätt
+ rentedApartment = hyresrätt
+ sublet = 2:a hand
+ land = tomt
+ parking = parkering/garage
+ student = studentbostad

```php
/**
 * Filtrerar på alla sorter
 */
 $myResidentType = \kalmarBovisionApi\model\ResidentType::all;
```

### ResidentTypeArray
Det är detta objekt du använder dig av för att sparar undan Boendetyper för din sökning. Den Instansieras från API-klassen och kommer då ha alla som default.

```php
/**
 * Först instansieras objektet...
 */
$myTypeArray = $myApi->getResidentTypeArray();

/**
 * ...fylls på med boendetypen studentbostad och 2:a handslägenheter
 */
$myTypeArray->addType(\kalmarBovisionApi\model\ResidentType::student);
$myTypeArray->addType(\kalmarBovisionApi\model\ResidentType::sublet);
```
Denna array kan nu fyllas på med ytterligare boendetyper eller skickas vidare

**OBS! Om boende typen "all" läggs till kommer listan att tömmas och bara innehålla den typen.**

Man kan även nollställa sin lista genom:
```php
/**
 * Sätter din array till "all"
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

**OBS! denna array går inte att använda i API:ets sökningsfunktioner.**

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
 * Hämtar den array-klass som används vid typbestämd sökning. Denna är satt på "all" från början.
 */
$myTypeArray = $myApi->getResidentTypeArray();

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
Hur sökningen än går till kommer en array med PHP-objekt att returneras.

### Egenskaper
+ **title**(string) - Boendetyp och område
+ **link**(string) - Länk till den Bovisions sida med mer information om objektet
+ **desc**(string) - Information som ändras mellan boendetyperna.
            + **Gemensam information**(Adress, Antal Rum, Beskrivning, Ändrad).
            + **Annan information**(Pris, Hyra/avgift).
+ **author**(string) - anger vilken firma som står för
+ **date**(DateTime) - Publiseringsdatumet("Ändrad" i egenskapen desc är samma på de objekt som inte ändrats)

Dessa egenskaper är publika och nås genom objektet.
```php
/**
 * Hämtar titeln
 */
$title = $myResident->_title;
```

### Funktioner
Det finns även funktioner för att få ut egenskaperna.
```php
/**
 * Hämtar titeln
 */
$title = $myResident->getTitle();
```


## Tillägg
Testningen görs av [SimpleTest](http://www.simpletest.org/) som finns inkluderat i mappen.