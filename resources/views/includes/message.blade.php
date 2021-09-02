<div class="msg-div">
	@if(Session::has('message'))
	@if(Session::get('message')["result"] == "success")
	<p class="alert alert-success"><strong>{{Session::get('message')["msg"]}}</strong></p>
	@else
	<p class="alert alert-danger"><strong>{{Session::get('message')["msg"]}}</strong></p>
	@endif
	@endif
</div>