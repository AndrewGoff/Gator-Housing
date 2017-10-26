<script type="text/dust" id="postings-template">
{#postings}
<div class="posting" data-thumbnail-url="{images}">
	<div class="thumbnail"></div>
	<h3>{title} - ${price}</h3>
	<p>{description}</p>
	<p>Desired Number of Tenants: {numTenants}</p>
	<p>ZIP: {zip}<p>
</div>
{/postings}
</script>
