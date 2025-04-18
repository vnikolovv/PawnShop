@extends('layouts.main')

@section('maincontent')
<div class="container mt-5">
        <h1 class="text-center text-golden">Contact us</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <h3 class="text-golden">Information</h3>
                <p><strong>Location:</strong> ulitsa Stoyan Mihailovski, Ruse, Bulgaria</p>
                <p><strong>Contact phone:</strong> +359 123 456 789</p>
                <p><strong>Contact email:</strong> info@pawnshop.bg</p>
            </div>
            <div class="col-md-6">
                <h3 class="text-golden">Our location on the map</h3>
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([43.8231361,25.973349], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([43.8231361,25.973349]).addTo(map)
            .bindPopup('Ulitsa Stoyan Mihailovski, Ruse, Bulgaria')
            .openPopup();
    </script>

@endsection