@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <div class="card">
        <div class="card-body">
            {{-- <form action="{{ url('/calculator/search') }}" method="get">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" name="search" class="form-control form-control-lg"
                            placeholder="Search by From ID or Destination">
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append ms-2">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </div>
            </form> --}}
            <form id="searchForm">
                <div class="input-group mb-0">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" class="form-control mr-sm-2" placeholder="Search by From ID or Destination"
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
    </div>

    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Calculate Delivery Charge Table</h4>
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
                                <th scope="col">From</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Delivery Cost</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calculates as $calculate)
                                <tr class="table-info">
                                    <td>{{ $calculate->id }}</td>
                                    <td>{{ $calculate->from_location }}</td>
                                    <td>{{ $calculate->destination }}</td>
                                    <td>{{ $calculate->category }}</td>
                                    <td>{{ $calculate->delivery_type }}</td>
                                    <td>{{ $calculate->cost }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('deliverycharge.show', $calculate->id) }}"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i></a>
                                            <a href="{{ route('deliverycharge.edit', $calculate->id) }}"
                                                class="btn btn-success">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('deliverycharge.destroy', $calculate->id) }}"
                                                method="post">
                                                @csrf
                                                @method ('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')"> <i
                                                        class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    {{-- <td>
                                        <a href="{{ route('calculator.show', $calculate->id) }}" class="btn btn-info">
                                            Show
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('calculator.edit', $calculate->id) }}" class="btn btn-success"
                                            style="margin-left: 10px;">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('calculator.destroy', $calculate->id) }}" method="post"
                                            style="margin-left: 10px;">
                                            @csrf
                                            @method ('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $calculates->onEachSide(1)->links() }}
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
                                <th scope="col">From</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Delivery Cost</th>
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
    <script>
        var deliveryChargeId = {{ $calculate->id }};
    </script>
    <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');
            var resultsBody = $('#searchResultsBody');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();
                if (searchInputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.calculatorSearch') }}';

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
                        resultsBody.empty();

                        if (response.results && Array.isArray(response.results) && response
                            .results.length > 0) {
                            $.each(response.results, function(index, results) {
                                resultsBody.append('<tr>' +
                                    '<td>' + results.id + '</td>' +
                                    '<td>' + results.from_location + '</td>' +
                                    '<td>' + results.destination + '</td>' +
                                    '<td>' + results.category + '</td>' +
                                    '<td>' + results.delivery_type + '</td>' +
                                    '<td>' + results.cost + '</td>' +
                                    '<td>' + results.weight + '</td>' +
                                    getActionButtons(results.id) +
                                    '</tr>');
                            });

                            function getActionButtons(resultsId) {
                                return '<td>' +
                                    '<div class="d-flex justify-content-center gap-2">' +
                                    getViewButton(resultsId) +
                                    getEditButton(resultsId) +
                                    getDeleteButton(resultsId) +
                                    '</div>' +
                                    '</td>';
                            }

                            function getViewButton(resultsId) {
                                return '<a href="{{ route('deliverycharge.show', '') }}/' +
                                resultsId + '" class="btn btn-info">' +
                                    '<i class="fas fa-eye"></i>' +
                                    '</a>';
                            }

                            function getEditButton(resultsId) {
                                return '<a href="{{ route('deliverycharge.edit', '') }}/' +
                                resultsId +
                                    '" class="btn btn-success">' +
                                    '<i class="fas fa-pencil-alt"></i>' +
                                    '</a>';
                            }

                            function getDeleteButton(resultsId) {
                                return '<form action="{{ route('deliverycharge.destroy', '') }}/' +
                                resultsId + '" method="post">' +
                                    '@csrf' +
                                    '@method('DELETE')' +
                                    '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">' +
                                    '<i class="fas fa-trash-alt"></i>' +
                                    '</button>' +
                                    '</form>';
                            }
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        resultsBody.html(
                            '<tr><td colspan="6" class="text-center fw-bold">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            }
            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });

            searchInput.on('input', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    searchResultsSection.hide();
                    existingTable.show();
                } else {
                    submitForm();
                }
            });
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script>
@endsection
