 let map;
 //Init Map with Current location
 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(
         (position) => {
             const pos = {
                 lat: position.coords.latitude,
                 lng: position.coords.longitude,
             };
             map = new google.maps.Map(document.getElementById("map"), {
                 center: pos,
                 zoom: 16,
                 mapTypeId: "roadmap",
             });
             // The marker, positioned at center
             const marker = new google.maps.Marker({
                 position: pos,
                 map: map,
             });
             new AutocompleteDirectionsHandler(map);
         }, () => {
             alert('You Must Allow Location To continue');
         }
     );
 } else {
     alert('You Broser Does not Support GPS');
 }

 // Search places

 class AutocompleteDirectionsHandler {

     constructor(map) {
             this.map = map;
             this.originPlaceId = "";
             this.destinationPlaceId = "";
             this.travelMode = google.maps.TravelMode.WALKING;
             this.directionsService = new google.maps.DirectionsService();
             this.directionsRenderer = new google.maps.DirectionsRenderer({
                 draggable: true,
             });

             this.directionsRenderer.setMap(map);
             this.directionsRenderer.addListener("directions_changed", () => {
                 this.computeTotalDistance(this.directionsRenderer.getDirections());
             });
             const originInput = document.getElementById("origin-input");
             const destinationInput = document.getElementById("destination-input");
             const modeSelector = document.getElementById("mode-selector");
             const originAutocomplete = new google.maps.places.Autocomplete(originInput);
             // Specify just the place data fields that you need.
             originAutocomplete.setFields(["place_id"]);
             const destinationAutocomplete = new google.maps.places.Autocomplete(
                 destinationInput
             );
             // Specify just the place data fields that you need.
             destinationAutocomplete.setFields(["place_id"]);
             this.setupClickListener(
                 "changemode-walking",
                 google.maps.TravelMode.WALKING
             );
             this.setupClickListener(
                 "changemode-transit",
                 google.maps.TravelMode.TRANSIT
             );
             this.setupClickListener(
                 "changemode-driving",
                 google.maps.TravelMode.DRIVING
             );
             this.setupPlaceChangedListener(originAutocomplete, "ORIG");
             this.setupPlaceChangedListener(destinationAutocomplete, "DEST");

         }
         // Sets a listener on a radio button to change the filter type on Places
         // Autocomplete.
     setupClickListener(id, mode) {
         const radioButton = document.getElementById(id);
         radioButton.addEventListener("click", () => {
             this.travelMode = mode;
             this.route();
         });
     }

     setupPlaceChangedListener(autocomplete, mode) {
         autocomplete.bindTo("bounds", this.map);
         autocomplete.addListener("place_changed", () => {
             const place = autocomplete.getPlace();

             if (!place.place_id) {
                 window.alert("Please select an option from the dropdown list.");
                 return;
             }

             if (mode === "ORIG") {
                 this.originPlaceId = place.place_id;
             } else {
                 this.destinationPlaceId = place.place_id;
             }
             this.route();
         });
     }

     route() {
         if (!this.originPlaceId || !this.destinationPlaceId) {
             return;
         }
         const me = this;
         this.directionsService.route({
                 origin: { placeId: this.originPlaceId },
                 destination: { placeId: this.destinationPlaceId },
                 travelMode: this.travelMode,

             },
             (response, status) => {
                 if (status === "OK") {
                     me.directionsRenderer.setDirections(response);

                 } else {
                     window.alert("Directions request failed due to " + status);
                 }

             }
         );

     }
     computeTotalDistance(result) {
         let total = 0;
         for (let i = 0; i < result.routes[0].legs[0].steps.length; i++) {
             console.log(result.routes[0].legs[0].steps[i].polyline)
         }
         const myroute = result.routes[0];

         if (!myroute) {
             return;
         }
         let distancepoints = [];
         for (let i = 0; i < myroute.legs.length; i++) {
             distancepoints[i] = myroute.legs[i].distance.value
             total += myroute.legs[i].distance.value;
         }
         total = total / 1000;
         console.log(total, "legs " + myroute.legs.length, "array " + distancepoints);

     }
 }