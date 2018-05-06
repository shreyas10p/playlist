
	
	function actionFormatter(value, row, index) {
		return [
			'<a id="deleteActivity" style="color:#d50000" href="javascript:void(0)" onclick="deleteSong('+row.id+')">',
			'<i title="Delete" class="mdi-action-delete small" style="font-size: 1.5rem;"></i>',
			'</a> '
		].join('');

	}

	function deleteSong(id){
		var _token = $('input[name="_token"]').val();
		console.log(_token);
		submitPost(_token,"song/delete/"+id,"songTable");

	}

	function titleFormatter(value, row, index) {
		console.log(row.id);
		return "<a target='_blank' href='"+value+"'>"+ value +"</a>";
	}