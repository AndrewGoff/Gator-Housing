<script type="text/dust" id="edit-posting-modal-template">
  <div class="modal-body" id="form-data">
    <div id="posting-input-field-container">
      <h3>Basic Information</h3>
      <div class="input-group">
        <span class="input-group-addon" id="posting-title">Title</span>
        <input name="title" type="text" class="form-control" placeholder="Beautiful Apartment" aria-describedby="posting-title" value="{title}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-price">$</span>
        <input name="price" type="text" class="form-control" placeholder="1000" aria-describedby="posting-price" value="{price}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-description">Description</span>
        <input name="description" type="text" class="form-control" placeholder="Very close to SFSU" aria-describedby="posting-description" value="{description}" >
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-num-tenants">Preferred Number of Tenants</span>
        <input name="numTenants" type="text" class="form-control" placeholder="2" aria-describedby="posting-num-tenants" value="{numTenants}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-num-bed">Preferred Number of Bedrooms</span>
        <input name="numBed" type="text" class="form-control" placeholder="2" aria-describedby="posting-num-bed" value="{numBed}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-num-bath">Preferred Number of Bathrooms</span>
        <input name="numBath" type="text" class="form-control" placeholder="1" aria-describedby="posting-num-bath" value="{numBath}">
      </div>
      <h3>Address</h3>
      <div class="input-group">
        <span class="input-group-addon" id="posting-street-num">Street Number</span>
        <input name="streetNum" type="text" class="form-control" placeholder="2230" aria-describedby="posting-street-num" value="{streetNum}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-street-name">Street Name</span>
        <input name="streetName" type="text" class="form-control" placeholder="20th Ave" aria-describedby="posting-street-name" value="{streetName}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-city">City</span>
        <input name="city" type="text" class="form-control" placeholder="San Francisco" aria-describedby="posting-city" value="{city}">
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="posting-zip">Zip</span>
        <input name="zip" type="text" class="form-control" placeholder="94116" aria-describedby="posting-zip" value="{zip}">
      </div>
      <input class="hidden" name="id" value="{id}">
    </div>
    <div id="posting-upload-file-container" class="hidden">
      <div class="panel panel-default" id="posting-upload-file-panel">
        <!-- Default panel contents -->
        <div class="panel-heading">
          Messages
        </div>
        <form action="javascript:void(0)" id="posting-upload-file-form">
          <div class="panel-body">
            <label class="btn btn-default">
              Select a File to Upload<input type="file" id="posting-upload-file" style="display: none;">
            </label>
            <input type="text" id="postingId" value="" style="display: none;">
            <p class="lead" id="posting-upload-file-name"></p>
            <button type="button" class="btn btn-default" id="posting-choose-file">
            Add
            </button>
          </div>
          <ul class="list-group" id="posting-upload-file-list">
          </ul>
          <div class="panel-footer">
            <button type="submit" class="btn btn-primary">
            Upload
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</script>