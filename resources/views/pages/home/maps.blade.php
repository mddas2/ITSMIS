@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/leaflet/leaflet.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div id="kt_leaflet_3" style="height:500px;"></div>
@endsection
@section('scripts')
<script src="{{asset('plugins/custom/leaflet/leaflet.bundle.js')}}"></script>
<script type="text/javascript">
	var leaflet = L.map('kt_leaflet_3', {
			center: [28.3949, 84.1240],
			zoom: 7
		})

		// set leaflet tile layer
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(leaflet);


		// set custom SVG icon marker
		var leafletIcon1 = L.divIcon({
			html: `<span class="svg-icon svg-icon-danger svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
			bgPos: [10, 10],
			iconAnchor: [20, 37],
			popupAnchor: [0, -37],
			className: 'leaflet-marker'
		});

		var leafletIcon2 = L.divIcon({
			html: `<span class="svg-icon svg-icon-primary svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
			bgPos: [10, 10],
			iconAnchor: [20, 37],
			popupAnchor: [0, -37],
			className: 'leaflet-marker'
		});

		var leafletIcon3 = L.divIcon({
			html: `<span class="svg-icon svg-icon-warning svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
			bgPos: [10, 10],
			iconAnchor: [20, 37],
			popupAnchor: [0, -37],
			className: 'leaflet-marker'
		});

		var leafletIcon4 = L.divIcon({
			html: `<span class="svg-icon svg-icon-success svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
			bgPos: [10, 10],
			iconAnchor: [20, 37],
			popupAnchor: [0, -37],
			className: 'leaflet-marker'
		});

		// bind markers with popup
		var marker1 = L.marker([27.3372,87.3811], { icon: leafletIcon1 }).addTo(leaflet);
		var marker2 = L.marker([27.0135, 85.6846], { icon: leafletIcon2 }).addTo(leaflet);
		var marker3 = L.marker([27.6625, 85.4376], { icon: leafletIcon3 }).addTo(leaflet);
		var marker4 = L.marker([28.3591, 84.1013], { icon: leafletIcon4 }).addTo(leaflet);
		var marker5 = L.marker([27.9207,82.7347], { icon: leafletIcon1 }).addTo(leaflet);
		var marker6 = L.marker([29.3863, 82.3886], { icon: leafletIcon4 }).addTo(leaflet);
		var marker7 = L.marker([29.2988, 80.9871], { icon: leafletIcon2 }).addTo(leaflet);

		marker1.bindPopup("Province 1", { closeButton: false });
		marker2.bindPopup("Province 2", { closeButton: false });
		marker3.bindPopup("Bagmati Province", { closeButton: false });
		marker4.bindPopup("Gandaki Province", { closeButton: false });
		marker5.bindPopup("Lumbini Province", { closeButton: false });
		marker6.bindPopup("Karnali Province", { closeButton: false });
		marker7.bindPopup("Sudurpashchim Province", { closeButton: false });

		L.control.scale().addTo(leaflet);
</script>
<script src="{{asset('js/pages/features/maps/leaflet.js')}}"></script>
@endsection