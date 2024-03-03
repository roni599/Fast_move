@extends('server.layouts.masterlayout')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    {{-- <div class="card">
<div class="card-body">

    <form action="#" method="get">
        @csrf
        <div class="input-group mb-3">
            <div class="form-group-feedback form-group-feedback-left">
                <input type="search" name="search" class="form-control form-control-lg"
                    placeholder="Search by From ID or Destination">
                
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-search4 text-muted"></i>
                </div>
            </div>

            <div class="input-group-append ms-2">
                <button type="submit" class="btn btn-primary btn-lg">Search</button>
            </div>
        </div>


    </form>
</div>
</div> --}}


    <div class="card">
        <div class="card-body">
            <nav class="navbar">
                <form id="searchForm">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" name="admin_delivery_search" class="form-control mr-sm-2"
                                placeholder="Search" id="searchInput">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-primary my-2 my-sm-0">Search</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('admin.merchant.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a>
            </nav>
        </div>
        {{-- <div class="card-body">
            <div class="form-group  ms-1" style="margin-top: -30px">
                <select id="searchoptionId" name="search_option" class="form-control" style="width: 19rem">
                    <option disabled selected>Select your search option</option>
                    <option value="Rifat">Rifat</option>
                    <option value="phone">Phone</option>
                    <option value="delivery_type">Delivery Type</option>
                    <option value="address">Address</option>
                    <option value="id">Id</option>
                    <option value="category_type">Category Type</option>
                    <option value="district">District</option>
                    <option value="order_tracking_id">Order Tracking Id</option>
                    <option value="divisions">Divisions</option>
                </select>
            </div>
        </div> --}}
    </div>


    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Marchant's Table</h4>
                {{-- @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Business Name</th>
                            <th scope="col">Merchant Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Pick Up Location</th>
                            <th scope="col">Profile Photo</th>
                            <th scope="col">NID Front</th>
                            <th scope="col">NID Back</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="table-info">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->business_name }}</td>
                                <td>{{ $user->merchant_name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->pick_up_location }}</td>
                                {{-- {{dd($user->profile_img)}} --}}
                                <td><img src="{{$user->profile_img}}" alt="Profile Photo"></td>
                                <td><img src="{{$user->nid_front}}" alt="NID Front"></td>
                                <td><img src="{{$user->nid_back}}" alt="NID Back"></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="searchResultsSection" class="table-responsive" style="display: none;">
                    <h4 class="card-title">Delivery Table</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Business Name</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pick Up Location</th>
                            </tr>
                        </thead>
                        <tbody id="searchResultsBody">
                            <!-- Search results will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            // Initial setup: hide search results, show existing table
            existingTable.show();
            searchResultsSection.hide();

            // Set route URLs for dynamic actions
            var routeUrls = {
                show: '{{ route('delivery.show', ':id') }}',
                edit: '{{ route('admin.delivery.edit', ':id') }}',
                destroy: '{{ route('admin.delivery.delete', ':id') }}',
            };

            $('#searchForm').submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val();
                console.log(searchInput)
                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('admin.searchMerchant') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.deliveries.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();

                            $.each(response.deliveries, function(index, delivery) {
                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.business_name + '</td>' +
                                    '<td>' + delivery.fname + '</td>' +
                                    '<td>' + delivery.lname + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.email + '</td>' +
                                    '<td>' + delivery.pick_up_location + '</td>' +
                                    // '<td>' + delivery.district + '</td>' +
                                    // '<td>' + delivery.divisions + '</td>' +
                                    // '<td>' + delivery.category_type + '</td>' +
                                    // '<td>' + delivery.delivery_type + '</td>' +
                                    // '<td>' + delivery.order_tracking_id + '</td>' +
                                    // '<td>' + delivery.invoice + '</td>' +
                                    // '<td>' + delivery.note + '</td>' +
                                    // '<td>' + delivery.exchange_parcel + '</td>' +
                                    // '<td>' + statusBadge + '</td>' +
                                    // '<td>' + actionButtons + '</td>' +
                                    // actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="8" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val();

                if (searchInput === '') {
                    // If the input is cleared, hide search results, show existing table
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}



    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var resultsBody = $('#searchResultsBody'); // Declare resultsBody outside the success function

            // Initial setup: hide search results, show existing table
            existingTable.show();
            searchResultsSection.hide();

            // Set route URLs for dynamic actions
            var routeUrls = {
                show: '{{ route('delivery.show', ':id') }}',
                edit: '{{ route('admin.delivery.edit', ':id') }}',
                destroy: '{{ route('admin.delivery.delete', ':id') }}',
            };

            $('#searchForm').submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val();
                console.log(searchInput)

                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('admin.searchMerchant') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.deliveries.length > 0) {
                            resultsBody.empty();

                            $.each(response.deliveries, function(index, delivery) {
                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.business_name + '</td>' +
                                    '<td>' + delivery.fname + '</td>' +
                                    '<td>' + delivery.lname + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.email + '</td>' +
                                    '<td>' + delivery.pick_up_location + '</td>' +
                                    '</tr>');
                            });
                        } else {
                            // If there are no results, display a message
                            resultsBody.html('<tr><td colspan="8" class="text-center fw-bold">No data found for the selected inputs.</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);

                        // If there's an error, display an error message
                        resultsBody.html('<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>');
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val();

                if (searchInput === '') {
                    // If the input is cleared, hide search results, show existing table
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });

    </script> --}}
@endsection