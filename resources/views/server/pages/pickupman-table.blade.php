@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

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


                {{-- <form id="excel" action="{{ route('admin.pickupman.excel.import') }}" method="post"
                    enctype="multipart/form-data">
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
                    <table class="table table-bordered" id="tableData">
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
                                    <td><img src="{{ asset('pickupmen/profile_images') }}/{{ $pickupman->profile_img }}"
                                            alt="Profile photo"></td>
                                    <td><img src="{{ asset('pickupmen/nid_images') }}/{{ $pickupman->nid_front }}"
                                            alt="NID Front"></td>
                                    <td><img src="{{ asset('pickupmen/nid_images') }}/{{ $pickupman->nid_back }}"
                                            alt="NID Back"></td>

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
                                                <form id="pickupmanConformation"
                                                    action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickupman->id }}">
                                                    <button class="btn btn-sm btn-success" type="submit"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </form>
                                                <form id="pickupmanCancelConformation"
                                                    action="{{ route('admin.pickupman_cancel_confirmation') }}"
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
                                            <form id="pickupmanDeleteConformation"
                                                action="{{ route('admin.pickupman_destroy') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pickupman->id }}">
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


    <div class="col-lg-12 stretch-card" id="searchResultsSection" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search Results</h4>
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
                        <tbody id="searchResultsBody">
                            <!-- Use JavaScript to populate this tbody with search results -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination for search results if needed -->
                <div id="searchResultsPagination">
                    <!-- Add pagination links here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- for search btton press --}}
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
                var searchRoute = '{{ route('admin.searchPickup') }}';

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
                        var resultsBody = $('#searchResultsBody');
                        if (response.pickupmen && Array.isArray(response.pickupmen) && response
                            .pickupmen.length > 0) {
                            $.each(response.pickupmen, function(index, pickupman) {
                                resultsBody.append('<tr>' +
                                    '<td>' + pickupman.id + '</td>' +
                                    '<td>' + pickupman.pickupman_name + '</td>' +
                                    '<td>' + pickupman.phone + '</td>' +
                                    '<td>' + pickupman.alt_phone + '</td>' +
                                    '<td>' + pickupman.email + '</td>' +
                                    '<td>' + pickupman.full_address + '</td>' +
                                    '<td>' + pickupman.police_station + '</td>' +
                                    '<td>' + pickupman.district + '</td>' +
                                    '<td>' + pickupman.division + '</td>' +
                                    '<td><img src="{{ asset('pickupmen/profile_images') }}/' +
                                    pickupman.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_front +
                                    '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_back +
                                    '" alt="NID Back"></td>' +
                                    '<td>' + getStatusBadge(pickupman.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(pickupman.is_active,
                                        pickupman.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                if (status === 1) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Pending</span>';
                                } else if (status === 3) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-black">Confirmed</span>';
                                }
                            }

                            function getActionButtons(status, pickupmanId) {
                                if (status === 1) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pickupman_cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    return `
                                        <form action="{{ route('admin.pickupman_destroy') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>`;
                                }
                            }

                        } else {
                            resultsBody.html(
                                '<tr><td colspan="14" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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
            var searchForm = $('#searchForm');

            // Add an event listener for the input field
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (searchInput === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.searchPickup') }}';

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
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.pickupmen && Array.isArray(response.pickupmen) && response
                            .pickupmen.length > 0) {
                            $.each(response.pickupmen, function(index, pickupman) {
                                resultsBody.append('<tr>' +
                                    '<td>' + pickupman.id + '</td>' +
                                    '<td>' + pickupman.pickupman_name + '</td>' +
                                    '<td>' + pickupman.phone + '</td>' +
                                    '<td>' + pickupman.alt_phone + '</td>' +
                                    '<td>' + pickupman.email + '</td>' +
                                    '<td>' + pickupman.full_address + '</td>' +
                                    '<td>' + pickupman.police_station + '</td>' +
                                    '<td>' + pickupman.district + '</td>' +
                                    '<td>' + pickupman.division + '</td>' +
                                    '<td><img src="{{ asset('pickupmen/profile_images') }}/' +
                                    pickupman.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_front +
                                    '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_back +
                                    '" alt="NID Back"></td>' +
                                    '<td>' + getStatusBadge(pickupman.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(pickupman.is_active,
                                        pickupman.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                if (status === 1) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Pending</span>';
                                } else if (status === 3) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-black">Confirmed</span>';
                                }
                            }

                            function getActionButtons(status, pickupmanId) {
                                if (status === 1) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pickupman_cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    return `
                                        <form action="{{ route('admin.pickupman_destroy') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${pickupmanId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>`;
                                }
                            }

                        } else {
                            resultsBody.html(
                                '<tr><td colspan="14" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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
        });
    </script> --}}

    {{-- dynamically input search and table render --}}
    {{-- <script>
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
                var searchRoute = '{{ route('admin.searchPickup') }}'; // Replace with your actual route

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

                        if (response.pickupmen.length > 0) {
                            $.each(response.pickupmen, function(index, pickupman) {
                                resultsBody.append('<tr>' +
                                    '<td>' + pickupman.id + '</td>' +
                                    '<td>' + pickupman.pickupman_name + '</td>' +
                                    '<td>' + pickupman.phone + '</td>' +
                                    '<td>' + pickupman.alt_phone + '</td>' +
                                    '<td>' + pickupman.email + '</td>' +
                                    '<td>' + pickupman.full_address + '</td>' +
                                    '<td>' + pickupman.police_station + '</td>' +
                                    '<td>' + pickupman.district + '</td>' +
                                    '<td>' + pickupman.division + '</td>' +
                                    '<td><img src="{{ asset('pickupmen/profile_images') }}/' +
                                    pickupman.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_front +
                                    '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('pickupmen/nid_images') }}/' +
                                    pickupman.nid_back +
                                    '" alt="NID Back"></td>' +
                                    '<td>' + getStatusBadge(pickupman.is_active) + '</td>' +
                                    '<td>' + getActionButtons(pickupman.is_active, pickupman
                                        .id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                if (status === 1) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Pending</span>';
                                } else if (status === 3) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-black">Confirmed</span>';
                                }
                            }

                            function getActionButtons(status, pickupmanId) {
                                if (status === 1) {
                                    return `
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="${pickupmanId}">
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.pickupman_cancel_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="${pickupmanId}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>`;
                                } else {
                                    return `
                                            <form action="{{ route('admin.pickupman_destroy') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="${pickupmanId}">
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>`;
                                }
                            }
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="14" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Add event listener for the input to handle input events
            searchInput.on('input', function() {
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

            // Add event listener for the keyup event to preserve existing styles when cleared
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    // If backspace key is pressed and input is empty, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- auto table search and table render --}}
    <script>
        $(document).ready(function() {
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                if (searchInputValue === '') {
                    $('#tableData').load(location.href + ' #tableData');
                    return;
                }
                $.ajax({
                    url: '{{ route('admin.searchPickup') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'admin_delivery_search': searchInputValue,
                    },
                    dataType: 'html',
                    success: function(response) {
                        $('#tableData').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        $('#tableData').load(location.href + ' #tableData');
                    }
                });
            }
            searchInput.on('input', function() {
                submitForm();
            });

            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });
        });
    </script>

    {{-- pickupman__conformation_by_the_admin --}}
    {{-- pickupman_cancel_conformation_by_the_admin --}}
    {{-- pickupman_delete_conformation_by_the_admin --}}

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#pickupmanConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href + ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#pickupmanCancelConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href +
                                ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#pickupmanDeleteConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'GET',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href + ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
        });
    </script>

@endsection
