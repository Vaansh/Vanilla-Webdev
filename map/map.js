const input = document.querySelector("#val")
const add = document.querySelector("#add")
const latt = document.querySelector("#lat")
const long = document.querySelector("#lon")
const dist = document.getElementById("distance")

//Making map and tiles
const ConcordiaLat = 45.495675
const ConcordiaLong = -73.578667
const mymap = L.map("mapid").setView([ConcordiaLat, ConcordiaLong], 14)

L.tileLayer(
  "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
  {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: "mapbox/streets-v11",
    tileSize: 512,
    zoomOffset: -1,
    accessToken:
      "pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
  }
).addTo(mymap)

//Marker.
L.circle([ConcordiaLat, ConcordiaLong], {
  color: "rgba(29, 98, 189, 0.993)",
  fillColor: "rgba(60, 255, 245, 0.808)",
  fillOpacity: 0.5,
  radius: 80,
}).addTo(mymap)

L.circle([ConcordiaLat, ConcordiaLong], {
  color: "rgba(29, 98, 189, 0.993)",
  fillColor: "rgba(60, 255, 245, 0.808)",
  fillOpacity: 0.5,
  radius: 1000,
}).addTo(mymap)

function getadd() {
  var addr = add.value
  console.log(addr)
  //AJAX CODE to get Lat Long from the address
  var xmlhttp = new XMLHttpRequest()
  var url =
    "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var myArr = JSON.parse(this.responseText)

      //myArr is an array of the matching addresses
      //You can extract the lat long attributes
      let lat = myArr[0].lat
      let lon = myArr[0].lon
      latt.value = lat
      long.value = lon

      //Create markers from the info.
      let from = L.latLng(ConcordiaLat, ConcordiaLong)
      let to = L.latLng(lat, lon)

      L.circle([lat, lon], {
        color: "black",
        fillColor: "black",
        fillOpacity: 0.5,
        radius: 50,
      }).addTo(mymap)

      //Use Polyline to draw line on map
      //create a red polyline from an array of LatLng points
      let latlngs = [
        [ConcordiaLat, ConcordiaLong],
        [lat, lon],
      ]
      let polyline = L.polyline(latlngs, { color: "black" }).addTo(mymap)

      // zoom the map to the polyline
      mymap.fitBounds(polyline.getBounds())

      //Compute Distance using
      let distancebetween = from.distanceTo(to).toFixed(0) / 1000
      console.log(distancebetween)
      dist.innerHTML = `Your distance from Concordia University is ${distancebetween} km`
    }
  }
  xmlhttp.open("GET", url, true)
  xmlhttp.send()
}
