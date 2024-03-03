@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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

                <form id="excel" action="{{ route('admin.pickupman.excel.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="file" name="excel_file">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Import Excel</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('admin.pickupman.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a>
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
                <h4 class="card-title">Pickup Man Table</h4>
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
                                <th scope="col">Pickup Man Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Alt Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pickupmans as $pickupman)
                                <tr class="table-info">
                                    <td>{{ $pickupman->id }}</td>
                                    <td>{{ $pickupman->pickupman_name }}</td>
                                    <td>{{ $pickupman->phone }}</td>
                                    <td>{{ $pickupman->alt_phone }}</td>
                                    <td>{{ $pickupman->email }}</td>
                                    <td>{{ $pickupman->full_address }}</td>
                                    <td>{{ $pickupman->police_station }}</td>
                                    <td>{{ $pickupman->district }}</td>
                                    <td>{{ $pickupman->division }}</td>
                                    <td><img src="{{asset('pickupmen/profile_images')}}/{{$pickupman->profile_img}}" alt="Profile photo"></td>
                                    <td><img src="{{asset('pickupmen/nid_images')}}/{{$pickupman->nid_front}}" alt="NID Front"></td>
                                    <td><img src="{{asset('pickupmen/nid_images')}}/{{$pickupman->nid_back}}" alt="NID Back"></td>

                                    @if ($pickupman->is_active == 1)
                                        <td><span class="badge bg-label-danger me-1 text-black">Pending</span></td>
                                    @elseif ($pickupman->is_active == 3)
                                        <td><span class="badge bg-label-danger me-1 text-black">Cancelled</span></td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-black">Confirmed</span></td>
                                    @endif


                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($pickupman->is_active == 1)
                                                <form action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickupman->id }}">
                                                    <button class="btn btn-sm btn-success" type="submit"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('admin.pickupman_cancel_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickupman->id }}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>

                                                </form>
                                            @endif
                                            {{-- <a href="{{ route('pickup.show', $pickup->id) }}"
                                            class="btn btn-sm btn-info"> <i class="fas fa-eye"></i></a> --}}
                                            {{-- <a href="{{ route('pickup.edit', $pickupman->id) }}"
                                                class="btn btn-sm btn-success"> <i class="fas fa-pencil-alt"></i></a> --}}
                                            <form action="{{route('admin.pickupman_destroy')}}" method="get">
												@csrf
												<input type="hidden" name="id" value="{{$pickupman->id}}">
												<button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
						                    </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $pickupmans->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="searchResultsSection" class="table-responsive" style="display: none;">
                    <h4 class="card-title">Pickup Man Table</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pickup Man Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Alt Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
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
    </div> --}}

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
                    url: '{{ route('admin.searchPickup') }}',
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
@endsection
