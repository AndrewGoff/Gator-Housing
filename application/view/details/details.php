<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="//sfsuswe.com/~iraleigh/css/bootstrap.min.css" rel="stylesheet">
    <link href="//sfsuswe.com/~iraleigh/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="//sfsuswe.com/~iraleigh/css/main.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container main-container">
	<div id="main-postings" class="main-postings">
		
	</div>
	<div id="edit" class="hidden">
		
	</div>
	<div id="registration" class="hidden">
		
	</div>
	<div id="login" class="hidden">
    </div>
</div>
<script type="text/dust" id="main-postings-template">
{#pagination}
	<nav aria-label="Postings page navigation">
	  <ul class="pagination">
	  	{?previousPageUrl}
	    <li class="page-btn {?active}active{/active}" data-page-url="{previousPageUrl}">
	      <a aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
	    {/previousPageUrl}
	    {#pages}
	    <li class="page-btn {?active}active{/active}" data-page-url="{pageUrl}"><a>{pageNum}</a></li>
	    {/pages}
	    {?nextPageUrl}
	    <li class="page-btn {?active}active{/active}" data-page-url="{nextPageUrl}">
	      <a aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	    {/nextPageUrl}
	  </ul>
	</nav>
{/pagination}
{#postings}
	<div class="posting row" data-thumbnail-url="{images}">
		<div class="thumbnail col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="content col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<h3>{title} - ${price}</h3>
			<p>{description}</p>
			<p>Desired Number of Tenants: {numTenants}</p>
		</div>
	</div>
{/postings}
</script>

    <!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
    <div class="footer">
        Find <a href="https://github.com/panique/mini">MINI on GitHub</a>.
        If you like the project, support it by <a href="http://tracking.rackspace.com/SH1ES">using Rackspace</a> as your hoster [affiliate link].
    </div>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script
			  src="https://code.jquery.com/jquery-1.11.1.min.js"
			  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE="
			  crossorigin="anonymous"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var APP = {}; //object to append initial global variables to
        APP.url = "C:\Users\Andrew\Desktop\New folder (2)";
    </script>

    <!-- our JavaScript -->
    <script src="C:\Users\Andrew\Desktop\New folder (2)\js\main.js"></script>
</body>
</html>
