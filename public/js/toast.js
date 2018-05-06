var baseUrl = "http://api.ecoterra.in/";

function successToast(delayTime,showTime,callbackMessage){
	setTimeout(function() {
		Materialize.toastSuccess('<span>'+callbackMessage+'</span>', showTime);
	}, delayTime);
}

function warningToast(delayTime,showTime,callbackMessage){
	setTimeout(function() {  
		Materialize.toastWarning('<span>'+callbackMessage+'</span>', showTime);
	}, delayTime);
}

function errorToast(delayTime,showTime,callbackMessage){
	setTimeout(function() {
		Materialize.toastError('<span>'+callbackMessage+'</span>', showTime);
	}, delayTime);
}