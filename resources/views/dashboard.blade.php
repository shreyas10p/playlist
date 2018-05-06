@extends('templates.default')

@section('title', 'Dashboard')

@section('content')
<div class="col s12 m8 l9" style="">
	<!--Nav bar start -->
	<div class="navbar-fixed">
		<nav class="cyan" style="height: 50px;line-height: 50px;">
			<div class="nav-wrapper" style="padding-left: 15px">
				<label class="left">
					PLAYLIST
				</label>
				<ul class="right hide-on-med-and-down" style="margin-right:250px">
					<li><a id="createButton" class="modal-trigger cyan" href="#playlistModel">CREATE</a>
					</li>
				</ul>

			</div>
		</nav>
	</div>
	<!--Nav bar end -->

	<!--Add Playlist Modal start -->
	<div id="playlistModel" class="modal" style="z-index: 1003; display: none; opacity: 0; transform: scaleX(0.7); top: 361.318px;">
		<div class="modal-content">
			<form class="col s12" id="frmPlaylist">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="playlistId" id="playlistId" value="">
				<div class="row">
					<div class="input-field col s12">
						<i class="mdi-action-view-headline prefix"></i>
						<input type="text" id="name" name="name" class="form-control">
						<label for="name" class="active">PlaylistName</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="tags" name="tags" class="form-control" type="text">
						<label for="tags" class="active">Tags</label> 
						<small id="tagHelp" class="form-text text-muted">Type tag name and press enter</small>          
					</div>
				</div>
			</form>
		</div>

		<div class="modal-footer lighten-4">
			<a id="submitPlaylist" class="waves-effect waves-green btn-flat modal-action modal-close">Add</a>
			<a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cancel</a>
		</div>
	</div>
	<!--Add Playlist Modal end -->
	
	<!-- Bootstarp Table start -->
	<div style="padding: 0 10px 0 10px;">
		<table data-toolbar="#toolbar" class="table table-striped table-bordered" data-unique-id="id" 	
		data-toggle="table" data-url=" http://shreyaspimpalkar.com/playlist/playlist/user/{{ Session::get('userId')}}" style="font-size: 14px" data-filter-control="true" 
		id="playlistTable">
		<thead>
			<tr>
				<!-- <th data-field="id" data-sortable="true">ID</th>
			-->				<th data-field="playlistName" data-sortable="true" data-formatter="titleFormatter" data-filter-control="input">Playlist Name</th>
			<th data-field="tags" data-sortable="true" data-filter-control="input">tags</th>
			<th data-field="created_at" data-sortable="true" data-filter-control="input">Created Date</th>
			<th data-field="id" data-formatter="actionFormatter">Actions</th>
		</tr>
	</thead>
</table>
</div>
<!-- Bootstarp Table end -->
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		$('label').addClass("active");
		$('input#tags').tagsinput({
			maxTags: 10
		});
		$("#submitPlaylist").click(function(){
			var tags = $('#tags').val();
			playlist = $('#frmPlaylist').serializeObject();
			playlist['userId']={{Session::get('userId')}};
			console.dir("PLAYLIST : "+playlist);
			submitForm(playlist,"playlist/create","playlist","PLAYLIST sent successfully","playlistTable");
			$("input#tags").tagsinput('removeAll');
			$('input#name').val('');

		});

		$("#createButton").click(function(){
			$('input#playlistId').val("0");
			$("input#tags").tagsinput('removeAll');
			$('input#name').val('');

		});
	});
</script>
<script type="text/javascript" src="{{url('js/playlist.js')}}"></script>

@stop