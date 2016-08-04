 //******************************* Get location by Insurance
    function searchInsurances() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.057964, 125.585403),
        zoom: 13,
        animation: google.maps.Animation.DROP,
        icon: "marker/marker.png",
        mapTypeId: 'roadmap'
      });

      
      var selectedInsurance = $("#select2_insurances").val();
      

      var infoWindow = new google.maps.InfoWindow;
      var searchUrl = 'searchByInsurances_Map.php?insurances=' + selectedInsurance;
   
      // Change this depending on the name of your PHP file
      downloadUrl(searchUrl, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("distance");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[0] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });


      $.ajax({  
                     url:"searchByInsurances_Table.php",  
                     method:"post",  
                     data:{insuarray: selectedInsurance},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });  
    }