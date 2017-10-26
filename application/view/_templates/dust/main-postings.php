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
	<div class="num-results"> Displaying {numResultsOnPage} of {numResults} Results </div>
{/pagination}
{#postings}
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="{id}" class="posting row" data-thumbnail-url="{images}">
				<div class="posting-thumbnail col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
				<div class="content col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<h3>{title} - ${price}</h3>
					<p>{description}</p>
					<p>Desired Number of Tenants: {numTenants}</p>
					<p>City: {city}</p>
					<p>ZIP: {zip}</p>
				</div>
				<div class="one-click-buttons btn-group" role="group">
					<button id="{id}" type="button" class="details btn btn-warning">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Details
					</button>
<!-- 					<button id="{id}" type="button" class="favorite btn btn-warning">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favorite
					</button> -->
					<button id="{id}" type="button" class="contact btn btn-success">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contact
					</button>
				</div>
			</div>
		</div>
	</div>	
{/postings}
</script>
