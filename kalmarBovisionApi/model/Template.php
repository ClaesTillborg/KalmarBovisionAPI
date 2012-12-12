<?php

namespace kalmarBovisionApi\model;

class Template {

	function __construct() {

	}

    /**
     * Returns the documentation on the API
     *
     * @return string HTML-Docs
     */
    public function getDocs() {
        return <<<EOT
    <div class="docs">
<section class="about">
	<h2>Om API:et</h2>
	<p>Ett API skapat i studiesyfte för kursen PHP2 på [Linneuniversitetet](http://www.lnu.se). Här kan man hämta information om olika boendetyper från Kalmar län, Kalmar kommun eller Kalmar stad. Informationen i fråga kommer från Bovisions RSS-tjänst.</p>
</section>

<section class="install">
	<h2>Installation</h2>
	<p>API:et installeras genom att samtliga filer laddas ned och läggs i projektmappen. Det följer en .htaccess och en index.php</p>

	<p>I din index.php skall följade stå:</p>
<pre><code>
/**
  * API-dokumentet du kommer använda dig av.
  */
require_once("kalmarBovisionApi/KalmarBovisionApi.php");

/**
  * Skapa ett nytt API-objekt
  */
\$myApi = new \kalmarBovisionApi\KalmarBovisionApi();
</code></pre>

	<p>Detta kommer ge dig din första sida med API-dokumentationerna.</p>
<pre><code>
/**
  * Skriver ut en HTML-sida med API:ets dokumentation.
  */
echo \$myApi->apiDocs();
</code></pre>
</section>

<section class="classes">
	<h2>Klasser</h2>

	<p>Det finns två enum-klasser som kommer att användas vid hämtning och filtrering av data i detta API och en Array-klass.</p>

	<h3>Enum</h3>
	<ul>
		<li>Coverage</li>
		<li>ResidentType</li>
	</ul>

	<h3>Array-klass</h3>
	<ul>
		<li>ResidentTypeArray</li>
	</ul>

	<h3>Coverage(\kalmarBovisionApi\model\Coverage)</h3>
	<p>Används för omfattningen av din sökning och innehåller alternativen:</p>
	<ul>
		<li>county - Kalmar län(API:et har denna som default)</li>
		<li>commune - Kalmar kommun</li>
		<li>city - Kalmar stad</li>
	</ul>
<pre><code>
/**
 * ex. Använder stad
 */
 \$myCoverage = \kalmarBovisionApi\model\Coverage::city;
</code></pre>

	<h3>ResidentType(\kalmarBovisionApi\model\ResidentType)</h3>
	<p>Används för att välja boendetyper på din sökning och innehåller följande alternativ:</p>
	<ul>
		<li>all - alla</li>
		<li>villa - villa</li>
		<li>holidayHouse - fritidshus</li>
		<li>farm - lantbruk</li>
		<li>apartment - bostadsrätt</li>
		<li>rentedApartment - hyresrätt</li>
		<li>sublet - 2:a hand</li>
		<li>land - tomt</li>
		<li>parking - parkering/garage</li>
		<li>student - studentbostad</li>
	</ul>
<pre><code>
/**
 * Filtrerar på alla sorter
 */
 \$myResidentType = \kalmarBovisionApi\model\ResidentType::all;
</code></pre>

	<h3>ResidentTypeArray</h3>
	<p>Det är detta objekt du använder dig av för att sparar undan Boendetyper för din sökning. Den Instansieras från API-klassen och kommer då ha alla som default.</p>
<pre><code>
/**
 * Först instansieras objektet...
 */
\$myTypeArray = \$myApi->getResidentTypeArray();

/**
 * ...fylls på med boendetypen studentbostad och 2:a handslägenheter
 */
\$myTypeArray->addType(\kalmarBovisionApi\model\ResidentType::student);
\$myTypeArray->addType(\kalmarBovisionApi\model\ResidentType::sublet);
</code></pre>
	<p>Denna array kan nu fyllas på med ytterligare boendetyper eller skickas vidare
	<br>
	<strong>OBS! Om boende typen "all" läggs till kommer listan att tömmas och bara innehålla den typen.</strong></p>

	<p>Man kan även nollställa sin lista genom:</p>
<pre><code>
/**
 * Sätter din array till "all"
 */
\$myTypeArray->setToDefault();
</code></pre>

<p>Hämtningsmetoderna kräver att detta objekt skickas in som parameter men array:en går att få tag i med:</p>
<pre><code>
/**
 * Hämtar din array
 */
\$arraycopy = \$myTypeArray->getTypeArray();
</code></pre>
	<p><strong>OBS! denna array går inte att använda i API:ets sökningsfunktioner.</strong></p>
</section>

<section class="methods">
	<h2>Metoder</h2>
	<p>Det finns två sätt att söka bostäder; efter boendetyp eller alla. Dessa sökmetoder är delade i två versioner; registrerade och en där även ändrade typer finns med.</p>

	<p>De sökmetoder som finns att använda är:</p>
	<ul>
		<li>getRegisteredResidents()</li>
		<li>getRegisteredResidentsByType(ResidentTypeArray)</li>
		<li>getChangedResidents()</li>
		<li>getChangedResidentsByType(ResidentTypeArray)</li>
	</ul>

	<p>Omfattningen av din sökning kommer att vara satt på Kalmar län som default.</p>

	<p>För att ändra sökarean:</p>
	<ul>
		<li>setCoverage(\kalmarBovisionApi\model\Coverage)</li>
	</ul>

	<p>För att hämta den array som ska användas vid sökning:</p>
	<ul>
		<li>getResidentTypeArray()</li>
	</ul>
<pre><code>
/**
 * Hämtar den array-klass som används vid typbestämd sökning. Denna är satt på "all" från början.
 */
\$myTypeArray = \$myApi->getResidentTypeArray();

/**
 * Hämtar en array med bara nyregistrerade boenden
 */
\$myApi->getRegisteredResidents();

/**
 * Gör en typbestämd sökning
 */
\$myApi->getRegisteredResidentsByType(\$myTypeArray);

/**
 * Hämtar en array med både ändrade och registrerade boenden
 */
\$myApi->getChangedResidents();

/**
 * Gör en typbestämd sökning
 */
 \$myApi->getChangedResidentsByType(\$myTypeArray);

/**
 * Ändrar sökarean till stad
 */
\$myApi->setCoverage(\kalmarBovisionApi\model\Coverage::city);
</code></pre>
</section>

<section class="resident-object">
	<h2>Resident-objekt</h2>
	<p>Hur sökningen än går till kommer en array med PHP-objekt att returneras.</p>

	<h3>Egenskaper</h3>
	<ul>
		<li><strong>title</strong>(string) - Boendetyp och område</li>
		<li><strong>link</strong>(string) - Länk till den Bovisions sida med mer information om objektet</li>
		<li><strong>desc</strong>(string) - Information som ändras mellan boendetyperna.
			<ul>
				<li><strong>Gemensam information</strong>(Adress, Antal Rum, Beskrivning, Ändrad).</li>
				<li><strong>Annan information</strong>(Pris, Hyra/avgift).</li>
			</ul>
		</li>
		<li><strong>author</strong>(string) - anger vilken firma som står för.</li>
		<li><strong>date</strong>(DateTime) - Publiseringsdatumet("Ändrad" i egenskapen desc är samma på de objekt som inte ändrats).</li>
	</ul>
	<p>Dessa egenskaper är publika och nås genom objektet.</p>
<pre><code>
/**
 * Hämtar titeln
 */
\$title = \$myResident->_title;
</code></pre>
	<h3>Funktioner</h3>
	<p>Det finns även funktioner för att få ut egenskaperna.</p>
<pre><code>
/**
 * Hämtar titeln
 */
\$title = \$myResident->getTitle();
</code></pre>
</section>

<section class="addons">
	<h2>Tillägg</h2>
	<p>Testningen görs av [SimpleTest](http://www.simpletest.org/) som finns inkluderat i mappen.</p>
</section>
            </div>
EOT;
    }

    /**
     * Takes a body and creates a HTML5 page
     *
     * @param string $body body of page
     * @return string page with body
     */
    public function createHTMLPage($body) {
		return <<<EOT
<!DOCTYPE html>
<html lang="sv">
	<head>
		<!-- Basic Page Needs
	  ================================================== -->
	  <meta charset="utf-8">
		<title>KalmarBovisionAPI-Docs</title>
		<meta name="author" content="Claes Tillborg">

		<!-- Mobile Specific Metas
	  ================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!--  CSS
	  ================================================== -->
		<link rel="stylesheet" type="text/css" href="kalmarBovisionApi/assets/css/base.css">
		<link rel="stylesheet" type="text/css" href="kalmarBovisionApi/assets/css/skeleton.css">
		<link rel="stylesheet" type="text/css" href="kalmarBovisionApi/assets/css/layout.css">

	  <!-- Googlefonts
	  ================================================== -->
	  <link href='http://fonts.googleapis.com/css?family=Corben:bold' rel='stylesheet' type='text/css'>
	  <link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'>

		<!-- Skeleton Favicons
	  ================================================== -->
		<link rel="icon" type="image/x-icon" href="kalmarBovisionApi/assets/img/icons/myfavicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="kalmarBovisionApi/assets/img/icons/myfavicon.ico">
		<link rel="apple-touch-icon" href="kalmarBovisionApi/assets/img/icons/my-apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="kalmarBovisionApi/assets/img/icons/my-apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="kalmarBovisionApi/assets/img/icons/my-apple-touch-icon-114x114.png">
  </head>
  <body>
    <div class="wrapper">
        <div class="container">
          <header><h1>KalmarBovisionAPI-Docs</h1></header>
          <div class="main">
          $body
          </div>
          <footer><p>Copywright Claes&nbsp;Tillborg</p></footer>
        </div>
    </div>
  </body>
</html>
EOT;
	}
}