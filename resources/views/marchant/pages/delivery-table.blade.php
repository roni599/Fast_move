
@extends('marchant.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <div class="card">
        <div class="card-body">
            <form id="searchForm">
                @csrf
                <div class="input-group mb-0">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" class="form-control form-control-lg" placeholder="Search by Phone"
                            id="searchInput">
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="d-flex justify-content-start gap-4 align-items-center">
                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
                                <option disabled selected>Select Division</option>
                                <option value="Barishal">Barishal</option>
                                <option value="Chattogram">Chattogram</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Sylhet">Sylhet</option>
                            </select>
                            @error('divisions')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();">

                            </select>
                            @error('district')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select Police Station</label>
                            <select name="police_station" class="form-control" id="polic_sta">

                            </select>
                            @error('police_station')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Delivery Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $delivery)
                                <tr class="table-info">
                                    <td>{{ $delivery->id }}</td>
                                    <td>{{ $delivery->customer_name }}</td>
                                    <td>{{ $delivery->customer_phone }}</td>
                                    <td>{{ $delivery->full_address }}</td>
                                    <td>{{ $delivery->police_station }}</td>
                                    <td>{{ $delivery->district }}</td>
                                    <td>{{ $delivery->divisions }}</td>
                                    <td>{{ $delivery->product_category }}</td>
                                    <td>{{ $delivery->delivery_type }}</td>
                                    <td>{{ $delivery->order_tracking_id }}</td>
                                    <td>{{ $delivery->invoice }}</td>
                                    <td>{{ $delivery->note }}</td>
                                    <td>{{ $delivery->exchange_status }}</td>
                                    <td>{{ $delivery->delivery_charge }}</td>

                                    @if ($delivery->is_active === '1')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Pending</span></td>
                                    @elseif ($delivery->is_active === '2')
                                        <td><span class="badge bg-label-danger me-1 text-dark">On the way</span></td>
                                    @elseif ($delivery->is_active === '3')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Checkout</span></td>
                                    @elseif ($delivery->is_active === 'cancelled')
                                        <td><span class="badge bg-label-success me-1 text-dark">Cancelled</span></td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-dark">Delivered</span></td>
                                    @endif

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('product.show', $delivery->id) }}"
                                                class="btn btn-sm btn-info"> <i class="fas fa-eye"></i></a>
                                            <a href="{{ route('product.edit', $delivery->id) }}"
                                                class="btn btn-sm btn-success"> <i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('product.destroy', $delivery->id) }}" method="post">
                                                @csrf
                                                @method ('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')"> <i
                                                        class="fas fa-trash-alt"></i> </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
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
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Category Type</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
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
    <script src="../marchant/js/address.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- declear route for input --}}
    <script>
        var routeUrls = {
            show: '{{ route('product.show', ':id') }}',
            edit: '{{ route('product.edit', ':id') }}',
            destroy: '{{ route('product.destroy', ':id') }}',
        }
    </script>

    {{-- for input --}}
    <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            // Initial setup: hide search results, show existing table
            existingTable.show();
            searchResultsSection.hide();

            $('#searchForm').submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val();
                

                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('delivery') }}',
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
                                var statusBadge = '';
                                if (delivery.is_active == '1') {
                                    statusBadge =
                                        '<span class="badge bg-label-danger me-1 text-dark">pending</span>';
                                }else if (delivery.is_active === '2') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">On the way</span>';
                                } else if (delivery.is_active === '3') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Checkout</span>';
                                }else if (delivery.is_active === 'canceled') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Cancelled</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Delivered</span>';
                                }
                                var actionButtons = '';
                                if (delivery.is_active == 1) {
                                    actionButtons =
                                        '<div class="d-flex justify-center align-items-center gap-2">' +
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-check"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '<form action="{{ route('marchant.cancel_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        ' <i class="fa-solid fa-times"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>';
                                } else if (delivery.is_active === 'canceled') {
                                    actionButtons =
                                        '<span class="badge bg-label-success me-1 text-dark">Not allowed</span>';
                                } else {
                                    actionButtons =
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fas fa-truck"></i>' +
                                        '</button>' +
                                        '</form>';
                                }
                                var actionButtons2 = `
                                    <td>
                                    <div class="d-flex justify-content-center gap-2">
                                    <a href="${routeUrls.show.replace(':id', delivery.id)}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="${routeUrls.edit.replace(':id', delivery.id)}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="${routeUrls.destroy.replace(':id', delivery.id)}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    </div>
                                    </td>
                                    `;

                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.name + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.address + '</td>' +
                                    '<td>' + delivery.police_station + '</td>' +
                                    '<td>' + delivery.district + '</td>' +
                                    '<td>' + delivery.divisions + '</td>' +
                                    '<td>' + delivery.category_type + '</td>' +
                                    '<td>' + delivery.delivery_type + '</td>' +
                                    '<td>' + delivery.order_tracking_id + '</td>' +
                                    '<td>' + delivery.invoice + '</td>' +
                                    '<td>' + delivery.note + '</td>' +
                                    '<td>' + statusBadge + '</td>' +
                                    '<td>' + actionButtons + '</td>' +
                                    actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            // No search results, you can handle this case if needed
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
    </script>

    {{-- for option --}}
    <script>
        $(document).ready(function() {
            // Initial setup: hide search results, show existing table
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            existingTable.show();
            searchResultsSection.hide();

            // Function to load data based on divisions and districts
            function loadDataBasedOnDivisionsAndDistricts() {
                var searchoptionId = $('#divisions').val();
                var searchoptionId2 = $('#distr').val();
                var searchoptionId3 = $('#polic_sta').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('optionsearch') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchoptionId,
                        search2: searchoptionId2,
                        search3: searchoptionId3,
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        console.log('Ajax Response:', response); // Add this line for debugging

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.deliveries.length > 0) {
                            $.each(response.deliveries, function(index, delivery) {
                                var statusBadge = '';
                                if (delivery.is_active == 1) {
                                    statusBadge =
                                        '<span class="badge bg-label-danger me-1 text-dark">pending</span>';
                                } else if (delivery.is_active === 'canceled') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Canceled</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">On the way</span>';
                                }

                                var actionButtons = '';
                                if (delivery.is_active == 1) {
                                    actionButtons =
                                        '<div class="d-flex justify-center align-items-center gap-2">' +
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-check"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '<form action="{{ route('marchant.cancel_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-times"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>';
                                } else if (delivery.is_active === 'canceled') {
                                    actionButtons =
                                        '<span class="badge bg-label-success me-1 text-dark">Not allowed</span>';
                                } else {
                                    actionButtons =
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fas fa-truck"></i>' +
                                        '</button>' +
                                        '</form>';
                                }

                                var actionButtons2 = `
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="${routeUrls.show.replace(':id', delivery.id)}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="${routeUrls.edit.replace(':id', delivery.id)}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="${routeUrls.destroy.replace(':id', delivery.id)}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                `;

                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.name + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.address + '</td>' +
                                    '<td>' + delivery.police_station + '</td>' +
                                    '<td>' + delivery.district + '</td>' +
                                    '<td>' + delivery.divisions + '</td>' +
                                    '<td>' + delivery.category_type + '</td>' +
                                    '<td>' + delivery.delivery_type + '</td>' +
                                    '<td>' + delivery.order_tracking_id + '</td>' +
                                    '<td>' + delivery.invoice + '</td>' +
                                    '<td>' + delivery.note + '</td>' +
                                    '<td>' + delivery.exchange_parcel + '</td>' +
                                    '<td>' + statusBadge + '</td>' +
                                    actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            // No search results, display a message or handle it as needed
                            resultsBody.html(
                                '<tr><td colspan="15" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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
            }

            // Attach the event listener to all three select elements
            $('#divisions, #distr, #polic_sta').on('change', loadDataBasedOnDivisionsAndDistricts);
        });
    </script>
@endsection
