<script type="text/dust" id="landlord-homepage-template">
	<div class="welcome-message">
		<h1>Welcome, {username}!</h1>
	</div>
	<div class="landlord-homepage">
		<div class="panel panel-default">
			<div class="panel-body text-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-posting-modal">
					Create New Posting
				</button>
			</div>
		</div>
		
		{#postings}
		<div class="panel panel-default">
			<div id="{id}" class="panel-body landlord-posting container" data-thumbnail-url="{thumbnail}">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 thubnail-container">
						<div class="thumbnail"></div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 posting-info-container">
						<div class="posting-title">{title}</div>
						<div class="btn-group action-btn-group">
							<button id="{id}" type="button" class="btn btn-default edit-posting-button">EDIT</button>
							<button type="button" class="btn btn-danger remove-posting-button">REMOVE</button>
						</div>
						<div class="panel panel-info">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
							  Messages
						  </div>

						  <table cellpadding="6" class="table table-hover">
						    <thead>
						      <tr>
						        <th>Sender</th>
						        <th>Email</th>
						        <th>Message</th>
						        <th>Date</th>
						      </tr>
						    </thead>
						    <tbody>
						    	{#messages}
						      <tr>
						      	{#user_info}
						        <td>{firstName} {lastName}</td>
						        <td>{email}</td>
						        {/user_info}
						        <td>{body}</td>
						        <td>{timestamp}</td>
						        <td><button id="{postingID},-,{senderID},-,{userID}" class="reply-button btn btn-info" type="button">Reply</button></td>
						      </tr>
						      {/messages}
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			</div>
		</div>
		{/postings}
	</div>
</script>