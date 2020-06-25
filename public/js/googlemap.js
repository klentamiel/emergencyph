var map;
var geocoder;


function loadMap() {
	var cavite = {lat: 14.2142, lng: 120.9687};
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: cavite
	});

	var marker = new google.maps.Marker({
		position: cavite,
		map: map
	});

	// var cdata = JSON.parse(document.getElementById('data').innerHTML);
	// geocoder = new google.maps.Geocoder();
	// codeAddress(cdata);

	// var allData = JSON.parse(document.getElementById('allData').innerHTML);
	// showAllColleges(allData)
}

// function showAllColleges(allData) {
// 	var infoWind = new google.maps.InfoWindow;
// 	Array.prototype.forEach.call(allData,function(data){
// 		var content = document.createElement('div');
// 		var strong = document.createElement('strong');
// 		strong.textContent = data.address;
// 		content.appendChild(strong);

// 		var marker = new google.maps.Marker({
// 			position: new google.maps.LatLng(data.lat, data.lng),
// 			map: map
// 		});

// 		marker.addListener('click', function(){
// 			infoWind.setContent(content);
// 			infoWind.open(map, marker);
// 		})
// 	})
// }

// function codeAddress(cdata) {
// 	Array.prototype.forEach.call(cdata,function(data){
// 		var address = data.name + ' ' + data.address;
// 		geocoder.geocode( {'address': address}, function(results, status) {
// 			if (status == 'OK') {
// 				map.setCenter(results[0].geometry.location);
// 				var points = {};
// 				points.id = data.id;
// 				points.lat = map.getCenter().lat();
// 				points.lng = map.getCenter().lng();
// 				updateCollegeWithLatlng(points);
// 			} else {
// 				alert('Geocode was not succesful for the following reason: ' + status);
// 			}
// 		});
// 	});
// } 

// function updateCollegeWithLatlng(points) {
// 	$.ajax({
// 		url:"action.php",
// 		method:"post",
// 		data: points,
// 		success: function(res) {
// 			console.log(res)
// 		}
// 	})
// }