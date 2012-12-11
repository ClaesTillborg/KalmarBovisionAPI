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
            <pre><code>
echo \$myApi->apiDocs();
            </code></pre>
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
		<title>Labb1</title>
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
          <header><h1>API-docs</h1></header>
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