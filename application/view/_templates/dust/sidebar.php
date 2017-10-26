<script type="text/dust" id="sidebar-template">
	
	<div class="sidebar-title">
		<h1>{category}</h1>
	</div>
	
	{#postings}
	<div id="{id}" class="sidebar-post" data-thumbnail-url="{images}">
		<div class="sidebar-thumbnail"></div>
		<div class="sidebar-post-description">
			<p><b>{title}</b><br />
				${price}<br />
				Bed: {numBed}      Bath: {numbBath}</p>
		</div>
	</div>
	{/postings}

</script>

