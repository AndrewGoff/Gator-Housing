<div class="modal fade" tabindex="-1" role="dialog" id="add-posting-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close add-posting-finish" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Posting</h4>
      </div>
      <div class="modal-body" id="form-data">
        <div id="posting-input-field-container">
          <h3>Basic Information</h3>
          <div class="input-group">
            <span class="input-group-addon" id="posting-title">Title</span>
            <input name="title" type="text" class="form-control" placeholder="Beautiful Apartment" aria-describedby="posting-title">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-price">$</span>
            <input name="price" type="text" class="form-control" placeholder="1000" aria-describedby="posting-price">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-description">Description</span>
            <input name="description" type="text" class="form-control" placeholder="Very close to SFSU" aria-describedby="posting-description">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-num-tenants">Preferred Number of Tenants</span>
            <input name="numTenants" type="text" class="form-control" placeholder="2" aria-describedby="posting-num-tenants">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-num-bed">Preferred Number of Bedrooms</span>
            <input name="numBed" type="text" class="form-control" placeholder="2" aria-describedby="posting-num-bed">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-num-bath">Preferred Number of Bathrooms</span>
            <input name="numBath" type="text" class="form-control" placeholder="1" aria-describedby="posting-num-bath">
          </div>
          <h3>Address</h3>
          <div class="input-group">
            <span class="input-group-addon" id="posting-street-num">Street Number</span>
            <input name="streetNum" type="text" class="form-control" placeholder="2230" aria-describedby="posting-street-num">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-street-name">Street Name</span>
            <input name="streetName" type="text" class="form-control" placeholder="20th Ave" aria-describedby="posting-street-name">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-city">City</span>
            <input name="city" type="text" class="form-control" placeholder="San Francisco" aria-describedby="posting-city">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="posting-zip">Zip</span>
            <input name="zip" type="text" class="form-control" placeholder="94116" aria-describedby="posting-zip">
          </div>
          <button type="button" class="btn btn-primary" id="add-posting">Add Posting</button>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default add-posting-finish" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-posting-finish" data-dismiss="modal">Done</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->