@extends('layouts.app')

@section('title', 'Branches')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}" />
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/leaflet_geocoder.css') }}" />
    <script src="{{ asset('assets/js/leaflet_geocoder.js') }}"></script>
@endsection

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Branch</h2>
                            <a href="{{ route('branch.index') }}" class="btn btn-primary">
                                
                                <i class="fa-solid fa-backward fa-lg mx-1"></i> 
                                Back To Branches</a>
                        </div>

                        <form action="{{ route('branch.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Branch Name *</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Branch Address *</label>
                                        <input class="form-control" type="text" name="address" id="address"
                                            value="{{ old('address') }}">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="latitude" name="latitude" hidden>
                                    <input type="text" id="longtitude" name="longtitude" hidden>
                                    <div id="location" style="height: 400px;"></div>
                                    @error('longtitude')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary my-3" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                Create Branch</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection


    @section('js')

        <script>
            $(document).ready(function() {
                var map = L.map('location').setView([20, 0], 2);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                var marker;

                map.locate({
                    setView: true,
                    maxZoom: 16
                });

                function onLocationFound(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;

                    marker = L.marker([lat, lng]).addTo(map)
                        .bindPopup("📍 Your Location").openPopup();

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longtitude').value = lng;
                }

                function onLocationError(e) {
                    alert("Location access denied. You can manually select a location.");

                }


                map.on('locationfound', onLocationFound);
                map.on('locationerror', onLocationError);


                map.on('click', function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;

                    if (marker) {
                        map.removeLayer(marker);
                    }

                    marker = L.marker([lat, lng]).addTo(map)
                        .bindPopup(`📍 Selected Location: ${lat}, ${lng}`).openPopup();

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longtitude').value = lng;
                });


                var geocoder = L.Control.geocoder({
                    defaultMarkGeocode: false
                }).on('markgeocode', function(e) {
                    var latlng = e.geocode.center;

                    if (marker) {
                        map.removeLayer(marker);
                    }

                    marker = L.marker(latlng).addTo(map)
                        .bindPopup(`📍 Searched Location: ${e.geocode.name}`).openPopup();

                    map.setView(latlng, 14);
                    document.getElementById('latitude').value = latlng.lat;
                    document.getElementById('longtitude').value = latlng.lng;
                }).addTo(map);

            });
        </script>

    @endsection
