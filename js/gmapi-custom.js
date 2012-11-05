var map;

      function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(35.516236, 24.018807000000038),
          zoom: 11,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });
      }

    function placeMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
    alert('Hello World!');
//    google.maps.event.addDomListener($('#suggest_list li'),'click',function(){
    google.maps.event.addDomListener(document.getElementById("from"),'click',function(){
        alert('Hello World!');
        /*var location = $('input[name="fromLatLon"]').val();
        placeMarker(location);*/
    });
