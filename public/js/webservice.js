var baseUrl = "http://shreyaspimpalkar.com/playlist/";

function httpPost(formId, serviceUrl, callbackToast, callbackMessage, tableId){
	$("#"+formId).submit(function(event){
		event.preventDefault();
		formData = $("#"+formId).serializeObject();
		submitForm(formData, serviceUrl, callbackToast, callbackMessage, tableId);
		
	});
}

function httpPostNoForm(params, serviceUrl, callbackToast, callbackMessage, tableId){
	submitForm(params, serviceUrl, callbackToast, callbackMessage);
	if(tableId) {
		$('#'+tableId).bootstrapTable('refresh');
	}
}

function httpPostWithParam(formId, serviceUrl, formData, callbackToast, callbackMessage) {
	$("#"+formId).submit(function(event){
		event.preventDefault();
		submitForm(formData, serviceUrl, callbackToast, callbackMessage);
	});
}

function submitForm(formData, serviceUrl, callbackToast, callbackMessage, tableId){
	$.ajax({
		contentType: 'application/json',
		data: JSON.stringify(formData),
		dataType: 'json',
		success: function(data){
			console.log(data);
			if(callbackToast){
				setTimeout(function() {
					Materialize.toastSuccess('<span>'+data.message+'</span>', 1500);
				}, 2000);
				if(tableId) {
					$('#'+tableId).bootstrapTable('refresh');
				}
			}
		},
		error: function(){
			console.log("error occured while fetching response");
		},
		type: 'POST',
		url: baseUrl+serviceUrl
	});
}

function submitPost(token,serviceUrl,tableId){
	$.ajax({
		contentType: 'application/json',
		data:  {
      	"_token": token
    	}, 
		dataType: 'json',
		success: function(data){
			console.log(data);
				setTimeout(function() {
					Materialize.toastSuccess('<span>'+data.message+'</span>', 1500);
				}, 2000);
				if(tableId) {
					$('#'+tableId).bootstrapTable('refresh');
				}
			
		},
		error: function(){
			console.log("error occured while fetching response");
		},
		type: 'POST',
		url: baseUrl+serviceUrl
	});
}


function httpGet(params,serviceUrl,callback){
	getData(params, serviceUrl, callback);
}
 

function getData(params, serviceUrl, callback) {
 	$.ajax({
    contentType: 'application/json',
    data: params,
    dataType: 'json',
    success: function(data){
    	callback(data);
    },
    error: function(){
      console.log("error occured while fetching response");
    },
    type: 'GET',
    url: baseUrl+serviceUrl
  });
}


