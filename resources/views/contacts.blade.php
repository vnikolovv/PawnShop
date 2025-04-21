@extends('layouts.main')

@section('maincontent')
    <div class="container mt-5">
        <h1 class="text-center text-golden">Contact us</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-6">
                <h3 class="text-golden">Information</h3>
                <p><strong>Location:</strong> ulitsa Stoyan Mihailovski, Ruse, Bulgaria</p>
                <p><strong>Contact phone:</strong> +359 123 456 789</p>
                <p><strong>Contact email:</strong> info@pawnshop.bg</p>

                <h3 class="text-golden mt-4">Contact Form</h3>
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-light">Email address</label>
                        <input type="email" class="form-control bg-dark text-light" id="email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label text-light">Subject</label>
                        <input type="text" class="form-control bg-dark text-light" id="subject" name="subject"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label text-light">Your Message</label>
                        <textarea class="form-control bg-dark text-light" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Submit Ticket</button>
                </form>
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
        var map = L.map('map').setView([43.8231361, 25.973349], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([43.8231361, 25.973349]).addTo(map)
            .bindPopup('Ulitsa Stoyan Mihailovski, Ruse, Bulgaria')
            .openPopup();
    </script>
@endsection
