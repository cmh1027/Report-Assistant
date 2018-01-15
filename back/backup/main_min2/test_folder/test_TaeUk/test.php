<?php
/*
	$ch = curl_init(); 

	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/customsearch/v1?q=3D&cx=001579166103861849215%3Acgdipvl_ujy&key=AIzaSyB8dUdgcef3D6PsO4sEUfDUTo1Kkk2_L6I"); 
	
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($ch, CURLOPT_SSLVERSION,3);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_POST, 1); 
	curl_setopt ($ch, CURLOPT_POSTFIELDS, "var1=str1&var2=str2");
	curl_setopt ($ch, CURLOPT_TIMEOUT, 30); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

	$output = curl_exec($ch); 

	curl_close($ch); 
	echo $output;
*/
?>

<script src="https://apis.google.com/js/api.js"></script>
<script>
  function loadClient() {
    gapi.client.setApiKey('AIzaSyB8dUdgcef3D6PsO4sEUfDUTo1Kkk2_L6I');
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/customsearch/v1/rest")
        .then(function() {
          console.log("GAPI client loaded for API");
        }, function(error) {
          console.error("Error loading GAPI client for API");
        });
  }
  // Make sure the client is loaded before calling this method.
  function execute() {
    return gapi.client.search.cse.list({
      "q": "3D",
      "cx": "001579166103861849215:cgdipvl_ujy"
    })
        .then(function(response) {
          // Handle the results here (response.result has the parsed body).
          console.log("Response", response['result']['items'][1]);
		  document.getElementById('test_in').value = (response['result']['items'][1]['snippet']);
        }, function(error) {
          console.error("Execute error", error);
        });
  }
  gapi.load("client");
</script>
<button onclick="loadClient()">load</button>
<button onclick="execute()">execute</button>

<input type='text' id="test_in" value="" >