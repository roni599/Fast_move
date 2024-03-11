@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <div class="card mb-3">
        <div class="card-body">
            <nav class="navbar navbar-light bg-light">
                <form id="searchForm">
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

                {{-- <form id="excel" action="{{ route('admin.product.excel.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="file" name="excel_file">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Import Excel</button>
                        </div>
                    </div>
                </form> --}}
                <a href="{{ route('admin.product.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a>
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
                                <th scope="col">Pickupman Name</th>
                                <th scope="col">Deliveryman Name</th>
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
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        @foreach ($deliveries as $delivery)
                            <tr class="table-info">
                                <td>{{ $delivery->id }}</td>
                                <td>{{ $delivery->user->merchant_name }}</td>
                                {{-- {{dd($delivery->pickupman)}} --}}
                                @if ($delivery->pickupman_id > 0)
                                    <td>{{ $delivery->pickupman->pickupman_name }}</td>
                                @else
                                    <td>No one pickup</td>
                                @endif
                                {{-- {{dd($delivery->deliveryman)}} --}}
                                @if ($delivery->deliveryman_id > 0)
                                    <td>{{ $delivery->deliveryman->deliveryman_name }}</td>
                                @else
                                    <td>No one delivered</td>
                                @endif
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
                                {{-- @if ($delivery->is_active == 1)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Pending</span></td> --}}
                                @if ($delivery->is_active == 2)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product On the way</span></td>
                                @elseif ($delivery->is_active == 3)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product Stock</span></td>
                                @elseif ($delivery->is_active == 4)
                                    <td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>
                                @elseif ($delivery->is_active == 5)
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Delivered</span></td>
                                @elseif($delivery->is_active == 6)
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Return</span></td>
                                @elseif ($delivery->is_active == 7)
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled</span></td>
                                @else
                                    <td><span class="badge bg-label-success me-1 text-dark">Product Pickupman <br> has not
                                            <br>
                                            reached yet</span></td>
                                @endif

                                <td>
                                    @if ($delivery->is_active == 2)
                                        <div class="d-flex justify-center align-items-center gap-2">
                                            {{-- <form action="{{ route('admin.product.delivery_confirmation') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}"> --}}
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            </form>
                                            <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="fa-solid fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($delivery->is_active == 'cancelled')
                                        <span class="badge bg-label-success me-1 text-dark">Not accepted</span>
                                    @elseif ($delivery->is_active == 4)
                                        {{-- <form action="{{ route('admin.product.delivery_checkout') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $delivery->id }}"> --}}
                                        {{-- <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fas fa-truck"></i>
                                            </button> --}}
                                        <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                        {{-- </form> --}}
                                    @elseif ($delivery->is_active == 5)
                                        {{-- <span class="badge bg-label-success me-1 text-dark">You have <br> No action <br> because product
                                            has <br>been delivered</span> --}}
                                        <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                    @elseif ($delivery->is_active == 3)
                                        {{-- <form action="{{ route('admin.product.delivery_delivered') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </form> --}}
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response <br> for
                                            deliveryman</span>
                                        {{-- @elseif ($delivery->is_active == 4)
                                        <form action="{{ route('admin.product.delivery_delivered') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                        </form> --}}
                                    @else
                                        <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($delivery->is_active == 4)
                                        <div class="d-flex justify-content-center gap-2">
                                            <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                            {{-- <a href="{{ route('admin.delivery.show', $delivery->id) }}"
                                            class="btn btn-sm btn-info"> <i class="fas fa-eye"></i></a> --}}
                                            {{-- <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-success" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                            </form> --}}
                                            {{-- <a href="{{ route('admin.delivery.edit') }}"
                                            class="btn btn-sm btn-success"> <i class="fas fa-pencil-alt"></i></a> --}}
                                            {{-- <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form> --}}
                                        </div>
                                    @elseif($delivery->is_active == 3)
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- <a href="{{ route('admin.delivery.show', $delivery->id) }}"
                                            class="btn btn-sm btn-info"> <i class="fas fa-eye"></i></a> --}}
                                            <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-success" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                            </form>
                                            {{-- <a href="{{ route('admin.delivery.edit') }}"
                                            class="btn btn-sm btn-success"> <i class="fas fa-pencil-alt"></i></a> --}}
                                            <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="badge bg-label-success me-1 text-dark">You have no action</span>
                                    @endif

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
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Pickupman Name</th>
                                <th scope="col">Deliveryman Name</th>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- for search button submit --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');

            searchForm.submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val().trim();
                console.log(searchInput);
                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}';

                if (searchInput === '') {
                    // If the input is empty, show existingTable and hide searchResultsSection
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.customers.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();
                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }
                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="21">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();

                if (searchInput === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- for given input and auto search without press search button --}}

    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            $('#searchInput').on('input', function(e) {
                e.preventDefault();

                var searchInput = $(this).val().trim();
                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}';

                if (searchInput === '') {
                    // If the input is empty, show existingTable and hide searchResultsSection
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.customers.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();

                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="21">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();

                if (searchInput === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}



    <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Function to handle form submission
            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (searchInputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}'; // Replace with your actual route

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInputValue,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.customers.length > 0) {
                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }
                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="21">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            }

            // Update the event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                submitForm();
                searchResultsSection.hide();
                existingTable.show();
            });

            // Add event listeners for the input to handle input and keyup events
            searchInput.on('input keyup', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                } else {
                    // Execute the search logic
                    submitForm();
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    // If backspace key is pressed and input is empty, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script>
@endsection
