<script type="text/dust" id="home-page-template">
	
	<div class="home-page-title">
		<h1>{category}</h1>
	</div>
	
	{#postings}
	<div id="{id}" class="home-page-post" data-thumbnail-url="{images}">
		<div class="home-page-thumbnail"></div>
		<div class="home-page-description">
			<p><b>{title}</b><br />
				${price}<br />
				Bed: {numBed}      Bath: {numbBath}</p>
		</div>
	</div>
	{/postings}

</script>