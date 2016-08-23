 //******************************* Get location by Schedule

function getSelectedChbox(frm) {
        var selchbox = [];        // array that will store the value of selected checkboxes

        // gets all the input tags in frm, and their number
        var inpfields = frm.getElementsByTagName('input');
        var nr_inpfields = inpfields.length;

        // traverse the inpfields elements, and adds the value of selected (checked) checkbox in selchbox
        for(var i=0; i<nr_inpfields; i++) {
          if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
        }

        return selchbox;
      }

      function clickme(){
        document.getElementById('btntest').onclick = function(){
          var selchb = getSelectedChbox(this.form);  
          //ADD VALIDATION IF VARIABLE IS BLANK

          var close = $("#closetime").val();
          var open = $("#opentime").val();


         var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(7.057964, 125.585403),
            zoom: 13,
            animation: google.maps.Animation.DROP,
            icon: "marker/marker.png",
            mapTypeId: 'roadmap'
          });

          
        
          var infoWindow = new google.maps.InfoWindow;
          var searchUrl = 'searchBySchedule_Map.php?schedule='+ selchb.toString() + '&op='+ open + '&cl=' + close ;
       
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

          alert(selchb);
            $.ajax({  
                     url:"searchBySchedule_Table.php",  
                     method:"post",  
                     data:{schedule: selchb, op: open, cl:close},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });
            
        }
      }
  