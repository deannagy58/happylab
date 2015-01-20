







/*

function uploadCrazyImage(imageElement) {

  var ajax = new ajax;

  var formElement = imageElement.getParem

  

  ajax.http($requestMethod, $uri, uploadCrazyImageCallback, formElement, isAsync);

}



function uploadCrazyImageCallback(response) {





}



window.onerror = function(message line file something) {

$response = ajax.http(index.php?fuseaction=home.jsError)

document.body.innerHTML = response;





}









function ajax() {

  

  this.http = function(requestMethod, uri, callback, data, isAsync) {

    var request;

    var pointa = {x:0, y:0, z:0};

    var pointB = {x:0, y:0, z:0};

    

    point.x = 1

    point.y = 2;

    point.z = 0;



    try {

	  request = ''; //Firefox

	} catch(tryIE) {

	  try {

	    // try ie 6

	  } catch(tryOtherIE) {

	    try {

		  // try other ie

		} catch(givingUp) {

		  alert('Failed to initialize AJAX');

		}

	  }

	} 



    request.open(requestMethod, uri, isAsync);

    request.send(null);

    request.onreadystatechange = function() {

      switch request.status

      case 200

      var decodeSuccess = false;

      

      try to de

      catch decode = false

      

      if decode then eval(callback)(JSON)

      else alert(failed to decode)

      braek;

      case 404

      case ???

      default

      braek;

    }

  }

  decode = true

}



*/



var http_request = false;

var row = 1;

var barcode;

var callback;  /// = displayLocation;





function makeRequest(url, handler, params) 

{



  callback = handler;

  http_request = false;



  if (window.XMLHttpRequest) { // Mozilla, Safari,...

    http_request = new XMLHttpRequest();

    if (http_request.overrideMimeType) {

      http_request.overrideMimeType('text/xml');

    }

  } else if (window.ActiveXObject) { // IE
    alert("makeRequest: IE");

    try {

      http_request = new ActiveXObject("Msxml2.XMLHTTP");

    } catch (e) {

      try {

        http_request = new ActiveXObject("Microsoft.XMLHTTP");

      } catch (e) {}

    }

  }



  if (!http_request){

    alert('Giving up :( Cannot create an XMLHTTP instance');

    return false;

  }



  http_request.onreadystatechange = checkState;

  // make request
//////////////////////////////////////////////         alert("makeRequest: "+url+"\n"+params);

  http_request.open('GET', url+'?'+params, true);

  http_request.send(null);



  return false;



}



// process request results

function checkState(){

///  alert("in checkState\n"+

///       "state="+http_request.readyState+"\n"+

///       "status="+http_request.status );

  if (http_request.readyState == 4){

    if (http_request.status == 200){

      callback(http_request.responseText); // displayLocation(http_request.responseText);

    } else {

      alert('Bad Request: '+http_request.status);

    }

  }

}







