

$(document).ready(function(){
	var dropped = false;
    $("#dropdownbutton").click(function(){
        $("#myDropdown").slideToggle("fast");
        dropped = !dropped;
    });
    $("#dropdownbuttonback").click(function(){
    	$("#myDropdown").slideToggle("fast");
    	dropped = !dropped;
    });
    $(document).click(function(){
    	if (dropped === true){
    		$("#myDropdown").slideToggle("fast");
    		dropped = false;
    	}
    });
    $("#myDropdown").click(function(e){
  		e.stopPropagation(); 
	});
	$("#dropdownbutton").click(function(e){
  		e.stopPropagation(); 
	});
	
	$('#search-form').submit(function(event){
		event.preventDefault(); //prevents search from refreshing
		var searchstring = $('#search-query').val(); //grabs contents from search bar
		var priceMin = $("input[name='price_min']").val();
		var priceMax = $("input[name='price_max']").val();
		var numBeds = $("input[name='num_beds']").val();
		var numBaths = $("input[name='num_baths']").val();
		var numTenants = $("input[name='num_tenants']").val();
		var orderFilter = $("select[name='order_filter']").val();
		var searchQuery = [];
		var finalQuery = "";
		var metadataString = "";

		this.ajax = new Ajax();

		var postings = new Postings({
			templateSelector: '#main-postings-template',
        	targetSelector: '#main-postings'
		});	

		if (searchstring>0)
		{
			metadataString = searchstring;
		}
		else
		{
			if($.type(searchstring) === 'string')
			{
				if(searchstring !== ''){
					metadataString = searchstring.replace(/\s+/g, '_');
				}
			}
			else
				alert("NOT VALID INPUT");
		}


		if (priceMin === "" && priceMax !== "")
		{
			priceMin = 0;
		}
		if (priceMax === "" & priceMin !== "")
		{
			priceMax = 9999;
		}
		if (priceMax !== "" && priceMin !== ""){
			searchQuery.push("price BETWEEN '" + priceMin + "' AND '" + priceMax + "'");
		}

		if (numBeds !== "")
		{
			searchQuery.push("numBed = " + numBeds);
		}

		if (numBaths !== "")
		{
			searchQuery.push("numBath = " + numBaths);
		}

		if (numTenants !== "")
		{
			searchQuery.push("numTenants = " + numTenants);
		}


		if (searchQuery.length === 0 && orderFilter === "" && metadataString === ""){
			postings.fetch_all().done(function(payload) {
				if($.type(searchstring.val()) === 'string') {
					var newsearchstring = searchstring.val().replace(/\s+/g, '_');
					postings.search(newsearchstring).done(function(payload){
						postings.render();
					});
				}
				else
					alert("NOT VALID INPUT");
				postings.render();
			});
		}
		else {

			if (searchQuery.length === 0){
				searchQuery.push("price > 0");
			}

			finalQuery += searchQuery[0];
			for (var i = 1; i < searchQuery.length; i++){
				finalQuery += " AND " + searchQuery[i];
			}

			if (metadataString === ""){
				metadataString = "_";
			}
			var newSearchString = finalQuery.replace(/\s+/g, '_');
			var sqlPassArray = [newSearchString, metadataString, orderFilter];
			postings.search(sqlPassArray).done(function(payload){
				postings.renderPage("1");
			});
		}
		MainContainerController.show('main-postings');
	});
});

