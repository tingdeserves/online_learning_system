<!-- learning resource geolocation html5 from w3schook and infs7202 slides.  W3School  https://www.w3schools.com/htmL/html5_geolocation.asp -->



<html>
  <head>
    <title>Simple Map</title>
    <!--<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>   -->
    <!-- above moved to header template 07/05/23 -->
    <style>

#map {
  /*width: 600px;*/
  height: 600px;
}

/*html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}*/
    </style>
  </head>
  <body>

  <div class="container">
    <div class="col-12">
      <h2 class="text-center mt-5" id="test">Hello!  <?php echo $username ?> :) </h2>

        <div class="my-3 text-center" id="overview">
            <div class="bd-heading  align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                
                <p id="demo" style="color:green"></p>  
                
                <h2 class="mt-5 text-center" id="loading_msg" style="color:green">Loading map . . .</h2>

                <div id="map"></div>


            </div>
          </div>
      </div>
  </div>




<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "AIzaSyC-z6QJoKh3ZgWWwgp27fKtBjxD9bQo4mI", v: "weekly"});</script>
</body>
</html>

<script>
const element = document.getElementById("demo");
element.addEventListener("DOMNodeInserted", hidden_loading_msg);

function hidden_loading_msg(){
  document.getElementById("loading_msg").style.display="none";
}

</script>




<script>
//Citing code
//The code snippet (1. Showing location using Google maps API) below has been adapted from
//I used Google Maps API documentation and changed it to show user's curent location and added a marker on the map
//https://developers.google.com/maps/documentation/javascript/examples/map-simple
var get_lat;
var get_lng;
var x = document.getElementById("demo");
document.getElementById("#demo").onload=getLocation();
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position){
      x.innerHTML = "Latitude: " + position.coords.latitude + 
      "<br>Longitude: " + position.coords.longitude;
      get_lat=position.coords.latitude;
      get_lng=position.coords.longitude;
      let map;
      async function initMap() {
        //@ts-ignore
        const { Map } = await google.maps.importLibrary("maps");

        map = new Map(document.getElementById("map"), {
          center: {lat: get_lat, lng: get_lng },
          zoom: 10,
        });

        const marker = new google.maps.Marker({ 
          // The below line is equivalent to writing:
          // position: new google.maps.LatLng(-34.397, 150.644)
          position: { lat: get_lat, lng: get_lng },
          map: map,
        });

      }
      initMap();
      
    });
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

//End code snippet  1. Showing location using Google maps API)
</script>



