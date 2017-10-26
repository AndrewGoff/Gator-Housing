<script type="text/dust" id="edit-posting-detail-template">
	
{#posting}
<form action="action_page.php">
  Posting Title:<br>
  <input type="text" name="postingTitle">
  <br>
  Price:<br>
  <input type="text" name="price">
  Number of Bedrooms:<br>
  <input type="text" name="numBedRooms">
  <br>
  Number of Bathrooms:<br>
  <input type="text" name="numBathRooms">
  <br>
  Number of Tenants:<br>
  <input type="text" name="numTenants">
  <br>
  Location:<br>
  <input type="text" name="location">
  <br><br>
  <input type="submit" value="Submit">
</form>
{/posting}

</script>