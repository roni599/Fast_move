@extends('deliveryman.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <div class="card mb-3">
        <div class="card-body">
            <nav class="navbar navbar-light bg-light">
                <form id="searchForm" action="{{ route('admin.delivery.search') }}" method="get">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" name="admin_delivery_search" class="form-control mr-sm-2"
                                placeholder="Search" id="searchInput">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Search</button>
                        </div>
                    </div>
                </form>
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
                <h4 class="card-title">Delivery Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive bg-light">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">COD</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col">Update</th> --}}
                            </tr>
                        </thead>
                        @foreach ($products as $delivery)
                            <tr class="table-info">
                                <td>{{ $delivery->id }}</td>
                                <td>{{ $delivery->user->merchant_name }}</td>
                                <td>{{ $delivery->customer_name }}</td>
                                <td>{{ $delivery->customer_phone }}</td>
                                <td>{{ $delivery->full_address }}</td>
                                <td>{{ $delivery->police_station }}</td>
                                <td>{{ $delivery->district }}</td>
                                <td>{{ $delivery->divisions }}</td>
                                <td>{{ $delivery->product_category }}</td>
                                <td>{{ $delivery->delivery_type }}</td>
                                <td>{{ $delivery->cod_amount }}</td>
                                <td>{{ $delivery->order_tracking_id }}</td>
                                <td>{{ $delivery->invoice }}</td>
                                <td>{{ $delivery->note }}</td>
                                <td>{{ $delivery->exchange_status }}</td>
                                <td>{{ $delivery->delivery_charge }}</td>
                                @if ($delivery->is_active == 1)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product Pending</span></td>
                                @elseif ($delivery->is_active == 2)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product On the way</span></td>
                                @elseif ($delivery->is_active == 3)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product arrived <br> in the <br>
                                            ware house</span></td>
                                @elseif ($delivery->is_active == 4)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product picked <br> by delivery
                                            man</span></td>
                                @elseif ($delivery->is_active == 5)
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Delivered</span></td>
                                @elseif ($delivery->is_active == 6)
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Return</span></td>
                                @else
                                    <td><span class="badge bg-label-success me-1 text-dark">Product canceled</span></td>
                                @endif

                                <td>
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        @if ($delivery->is_active == 1)
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        @endif
                                        @if ($delivery->is_active == 2)
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        @endif
                                        @if ($delivery->is_active == 3)
                                            <form action="{{ route('admin.product.delivery_checkout') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-success" type="submit">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                            </form>
                                            {{-- @else
                                            <span class="badge bg-label-success me-1 text-dark">Product <br> has not <br>
                                                arrived yet <br>in the stock</span> --}}
                                        @endif
                                        @if ($delivery->is_active == 4)
                                            <form action="{{ route('deliveryman.product.delivered') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-success" type="submit">
                                                    <i class="fas fa-truck"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($delivery->is_active == 4)
                                            <form action="{{ route('deliveryman.product.return') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-success" type="submit">
                                                    <i class="fa-solid fa-right-left"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($delivery->is_active == 4)
                                            <form action="{{ route('deliveryman.product.cancel') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="fa-solid fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($delivery->is_active == 5)
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        @endif
                                        @if ($delivery->is_active == 6)
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        @endif
                                        @if ($delivery->is_active == 7)
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        @endif
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


    {{-- <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="searchResultsSection" class="table-responsive" style="display: none;">
                    <h4 class="card-title">Delivery Table</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Category Type</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Parcel</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        <tbody id="searchResultsBody">
                            <!-- Search results will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- <script>
        var routeUrls = {
            show: '{{ route('delivery.show', ':id') }}',
            edit: '{{ route('admin.delivery.edit', ':id') }}',
            destroy: '{{ route('admin.delivery.delete', ':id') }}',
        };
    </script> --}}

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

                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('admin.search') }}',
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

                                // Log fname and lname to the console

                                var fullName = delivery.user ? delivery.user.fname +
                                    ' ' + delivery.user.lname : '';
                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + fullName + '</td>' +
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
                                    '<td>' + actionButtons + '</td>' +
                                    actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            // No search results, handle this case if needed
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


    {{-- test --}}
    {{-- <script>
        $(document).ready(function () {
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
    
            $('#searchForm').submit(function (e) {
                e.preventDefault();
    
                var searchInput = $('#searchInput').val();
    
                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    url: '{{ route('admin.search') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchInput,
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
    
                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();
    
                        if (response.deliveries.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();
    
                            $.each(response.deliveries, function (index, delivery) {
                                var statusBadge = '';
                                if (delivery.is_active == 1) {
                                    statusBadge = '<span class="badge bg-label-danger me-1 text-dark">pending</span>';
                                } else if (delivery.is_active === 'canceled') {
                                    statusBadge = '<span class="badge bg-label-success me-1 text-dark">Canceled</span>';
                                } else {
                                    statusBadge = '<span class="badge bg-label-success me-1 text-dark">On the way</span>';
                                }
    
                                var actionButtons = '';
                                if (delivery.is_active == 1) {
                                    actionButtons = '<div class="d-flex justify-center align-items-center gap-2">' +
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-check"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '<form action="{{ route('marchant.cancel_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-times"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>';
                                } else if (delivery.is_active === 'canceled') {
                                    actionButtons = '<span class="badge bg-label-success me-1 text-dark">Not allowed</span>';
                                } else {
                                    actionButtons = '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id + '">' +
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
                            // No search results, handle this case if needed
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);
    
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html('<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>');
                        existingTable.show();
                    }
                });
            });
    
            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function () {
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
