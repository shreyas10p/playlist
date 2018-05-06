
	function actionFormatter(value, row, index) {
		return [
		'<a id="deleteActivity" style="color:#d50000" href="javascript:void(0)" onclick="deletePlaylist('+row.id+')">',
		'<i title="Delete" class="mdi-action-delete small" style="font-size: 1.5rem;"></i>',
		'</a> ',
		'&nbsp;&nbsp;|&nbsp;&nbsp;',
		'<a style="color:#3333ff " href="#" onclick="modalOpen('+row.id+')">',
		'<i title="Edit" class="mdi-content-create small" style="font-size: 1.5rem;"></i>',
		'</a> '
		].join('');

	}


	function titleFormatter(value, row, index) {
		console.log(row.id);
		return "<a href='playlist/show/"+row.id+"'>"+ value +"</a>";;
	}

	function deletePlaylist(id){
		var _token = $('input[name="_token"]').val();
		console.log(_token);
		submitPost(_token,'playlist/delete/'+id,"playlistTable");

	}

	function modalOpen(id){
		$("#playlistModel").openModal();
		getData(null,'playlist/id/'+id,fillModal);
	}

	function fillModal(data){
		$('label').addClass("active");
		console.log(data);
		$('input#playlistId').val(data[0].id);
		$("input#tags").tagsinput('removeAll');
		$('#name').val(data[0].playlistName);
		var tagsInput = data[0].tags;
		var tagsArray =tagsInput.split(',');
		// console.log(tagsArray);
		for (var i = 0;i<tagsArray.length;i++){

			$("input#tags").tagsinput('add', tagsArray[i]);
			// t1.add(tagsArray[i]);	

		}
	}