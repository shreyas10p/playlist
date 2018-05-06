@extends('templates.default')

@section('title', 'Dashboard')

@section('content')
<div class="col s12 m8 l9" style="">
	<!--Nav bar start -->
	<div class="navbar-fixed">
		<nav class="cyan" style="height: 50px;line-height: 50px;">
			<div class="nav-wrapper" style="padding-left: 15px">
				<label class="left" id="playlistName">
					{{$playlist[0]->playlistName}}
				</label>
				<ul class="right hide-on-med-and-down" style="margin-right:250px">
					<li><a class="modal-trigger cyan" href="#songModel">ADD SONG TO PLAYLIST</a>
					</li>
				</ul>

			</div>

		</nav>
	</div>
	<!--Nav bar end -->
	
	<!--Add Songs Mpdal start -->
	<div id="songModel" class="modal" style="z-index: 1003; display: none; opacity: 0; transform: scaleX(0.7); top: 361.318px;">
		<div class="modal-content">
			<form class="col s12" id="frmSong">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row">
					<div class="input-field col s12">
						<i class="mdi-action-view-headline prefix"></i>
						<input type="text" id="songName" name="songName">
						<label for="songName" class="">Song Name</label>
					</div>
					<div class="input-field col s12">
						<i class="mdi-action-view-headline prefix"></i>
						<input type="text" id="songUrl" name="songUrl">
						<label for="songUrl" class="">Song Url</label>
					</div>
					<div id="error-songUrl" class="error"></div>
				</div>
			</form>
		</div>

		<div class="modal-footer lighten-4">
			<a id="submitSong" class="waves-effect waves-green btn-flat">Add</a>
			<a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cancel</a>
		</div>
	</div>
	<!--Add Songs Mpdal end -->
	
	<!--Bootstrap Table start -->
	<div style="padding: 0 10px 0 10px;">
		<table data-toolbar="#toolbar" class="table table-striped table-bordered" data-unique-id="id" 	
		data-toggle="table" data-url=" http://shreyaspimpalkar.com/playlist/song/playlist/{{$playlist[0]->id}}" style="font-size: 14px" data-filter-control="true" id="songTable" >
		<thead>
			<tr>
				<th data-field="songName" data-sortable="true" data-filter-control="input">Song Name</th>
				<th data-field="songUrl" data-sortable="true" data-formatter="titleFormatter" data-filter-control="input">Song Url</th>
				<th data-field="created_at" data-sortable="true" data-filter-control="input">Created Date</th>
				<th data-formatter="actionFormatter">Actions</th>
			</tr>
		</thead>
	</table>
</div>
<!--Bootstrap table end -->
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		$("#submitSong").click(function(){
			song = $('#frmSong').serializeObject();
			song['playlistId']={{$playlist[0]->id}};
			var url = song['songUrl'];
			var regExpYT = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;

			if(url.match(regExpYT)){
				$('#songModel').closeModal();
				console.log("PLAYLIST : "+song);
				submitForm(song,"song/add","song","SONG added successfully","songTable");

			} else{
				$("#error-songUrl").html('not a valid Url');
			}

			$('input#songName').val("");
			$('input#songUrl').val("");

		});
	});
</script>
<script type="text/javascript" src="{{url('js/songs.js')}}"></script>
@stop