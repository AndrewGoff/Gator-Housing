<script type="text/dust" id="posting-detail-template">
  <!-- include Bootstrap CDN for carousel glyphicon to work properly -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  

	<nav class="posting-detail-navbar navbar navbar-default">
		<div class="container-fluid">
			<div class="row">
				<div class="backbutton">
					<button type="button" class="btn btn-default navbar-btn posting-detail-reset-button navbar-left">
						<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Back
					</button>
					<p class="navbar-text navbar-left"><b>{title} - ${price}</b></p>
				</div>
			</div>
		</nav>

		<div class="row">
			<div class="col-xs-7">
				<div class="posting-detail-carousel">
					<div class="container-fluid">
						<h2>{title}</h2>
							<div id="posting-detail-image-carousel-slide" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
						      {#imageIds}
							      <li data-target="#posting-detail-image-carousel-slide" data-slide-to="{index}" {?isThumbnail}class="active"{/isThumbnail}></li>
						      {/imageIds}
						    </ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									{#imageIds}
						      	<div class="item posting-detail-image {?isThumbnail}active{/isThumbnail}" data-posting-id="{id}">
							      </div>
						      {/imageIds}
								</div>

								<!-- Left and right controls -->
								<a class="left carousel-control" href="#posting-detail-image-carousel-slide" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#posting-detail-image-carousel-slide" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
					</div>		

					<div class="pull-right">
						<div class="button-group posting-detail-buttons btn-group" role="group">
							<!-- <button id="{id}" type="button" class="favorite btn btn-warning">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favorite
							</button> -->
							<button id="{id}" type="button" class="contact btn btn-success">
								<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contact
							</button>
						</div>
					</div>

					<div class="posting-detail-list panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">{title} - ${price}</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								<li class="list-group-item"><b>Description:</b> {description}</li>
								<li class="list-group-item"><b>Posted:</b> {date}</li>
								<li class="list-group-item"><b>Number of Bedrooms:</b> {numBed}</li>
								<li class="list-group-item"><b>Number of Bathrooms:</b> {numBath}</li>
								<li class="list-group-item"><b>Number of Tenants:</b> {numTenants}</li>
								<li class="list-group-item"><b>Location:</b> {city} - {zip}</li>

							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-5">
					<div class="map">
						<h3>Transit Directions</h3>
						<iframe class="neighborhood-map" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyBNSSuICv6MPc13PfZ1Yu0KyDSsDG5eLJw
						&origin={city}%2C%20CA%20{zip}
						&destination=1600%20Holloway%20Ave%2C%20San%20Francisco%2C%20CA%2094132
						&mode=transit
						&zoom=12">
					</iframe>
					</div>
			</div>
		</div>
	</script>