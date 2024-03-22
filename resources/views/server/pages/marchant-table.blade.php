@extends('server.layouts.masterlayout')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}


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
        <div class="table-responsive">
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
                                {{-- <td><img src="{{$user->profile_img}}" alt="Profile Photo"></td> --}}
                                <td><img src="{{ asset('merchant/profile-photos') }}/{{ $user->profile_img }}"
                                        alt="Profile Photo"></td>
                                <td><img src="{{ asset('merchant/nid-photos') }}/{{ $user->nid_front }}" alt="NID Front">
                                </td>
                                <td><img src="{{ asset('merchant/nid-photos') }}/{{ $user->nid_back }}" alt="NID Back">
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $users->onEachSide(1)->links() }}
        </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 stretch-card" id="searchResultsSection" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search Results</h4>
                <div class="table-responsive">
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


    {{-- given or search button press the search is done --}}
    <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Function to handle form submission
            function submitForm() {
                var inputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.searchMerchant') }}';

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: inputValue,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.user && Array.isArray(response.user) &&
                            response.user.length > 0) {
                            $.each(response.user, function(index, user) {
                                resultsBody.append('<tr>' +
                                    '<td>' + user.id + '</td>' +
                                    '<td>' + user.business_name + '</td>' +
                                    '<td>' + user.merchant_name + '</td>' +
                                    '<td>' + user.phone + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' + user.pick_up_location + '</td>' +
                                    '<td><img src="{{ asset('merchant/profile-photos') }}/' +
                                    user.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('merchant/nid-photos') }}/' +
                                    user.nid_front + '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('merchant/nid-photos') }}/' +
                                    user.nid_back + '" alt="NID Back"></td>' +
                                    '</tr>');
                            });
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="9" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Add an event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                submitForm();
                existingTable.show();
                searchResultsSection.hide();
            });

            // Add an event listener for the input field
            searchInput.on('input', function() {
                var inputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    searchResultsSection.hide();
                    existingTable.show();

                } else {
                    // Execute the search logic
                    submitForm();
                    existingTable.show();
                    searchResultsSection.hide();
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
