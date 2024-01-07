{{-- <div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 600px;">
            <h1 class="mb-3">Calculate Delivery Charge</h1>
            <p class="mb-1">We provide efficient and affordable charge services.</p>
        </div>
        <div class="row gy-5 gx-4">
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="FromId">From</label>
                    <select id="FromId" name="from_location" class="form-control">
                        @foreach ($deliveryCharge as $calculates)
                        <option>
                            {{$calculates->from_location}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="destinationId">Destination</label> <select id="destinationId"
                        name="destination" class="form-control">
                        @foreach ($deliveryCharge as $calculates)
                            <option>
                                {{$calculates->destination}}
                            </option>
                        @endforeach
                    </select></div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Category</label>
                    <select id="categoryId" name="category" class="form-control">
                        @foreach ($deliveryCharge as $calculates)
                        <option>
                            {{$calculates->category}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Service</label> <select id="serviceId" name="service"
                        class="form-control">
                        @foreach ($deliveryCharge as $calculates)
                        <option>
                            {{$calculates->service}}
                        </option>
                        @endforeach
                    </select></div>
            </div>
            <div class="col-md-2 col-12">
                <div class="form-group">
                    <label for="weightId">Weight (KG)</label>
                    <input type="text" id="weightId" name="weight" value="1"
                        placeholder="Parcel's Weight" class="form-control">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 tt">
            <input type="text" id="valueId" class="form-control w-25 py-3 text-dark inputsearch"
                value="50TK">
        </div>
        <div class="text-center mt-4">
            <span class="d-block mt-2">* ১% ক্যাশ অন ডেলিভারি ও রিস্ক ম্যানেজমেন্ট চার্জ প্রযোজ্য </span>
            <span class="d-block mt-2">* পার্সেল সাইজের কারণে ডেলিভারি মাশুল পরিবর্তিত হতে পারে </span>
            <span class="d-block mt-2">* উক্ত চার্জসমূহ ভ্যাট ও ট্যাক্স ব্যাতিত </span>
            <span class="d-block mt-2">* অনাকাঙ্ক্ষিত কারণবশত ডেলিভারি সময়ের পরিবর্তন হতে পারে</span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

{{-- without spin loading icon --}}
{{-- <script>
    $(document).ready(function() {
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            console.log('Weight Value:', weightValue);
            if (weightValue || weightValue === 0) {
                updateDeliveryCharge();
            }
        });
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);
        $('select, input').change(function() {
            updateDeliveryCharge();
        });
        function updateDeliveryCharge() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    } else {
                        console.error('Invalid response format');
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
</script> --}}

{{-- with the spin loading icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
{{-- <script>
    $(document).ready(function() {
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        $('select, input').on('change', function() {
            showLoadingIcon();
            setTimeout(function() {
                updateDeliveryCharge();
                hideLoadingIcon();
            }, 1000);
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
        // Initial state: disable and make readonly the input field
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        // Handle input event for weight field
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        // Handle change event of form fields and make AJAX request
        $('select, input').on('change', function() {
            if ($(this).attr('id') !== 'categoryId') {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            }
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            // let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    // 'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }
    });
</script> --}}


{{-- new code from ekRoni --}}

<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 600px;">
            <h1 class="mb-3">Calculate Delivery Charge</h1>
            <p class="mb-1">We provide efficient and affordable charge services.</p>
        </div>
        <div class="row gy-5 gx-4">
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="FromId">From</label>
                    <select id="fromLocation" name="from_location" class="form-control">
                        <option value="Dhaka">Dhaka</option>
                        @foreach ($fromLocations as $location)
                            <option value="{{ $location->from_location }}">{{ $location->from_location }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="form-group">
                    <label for="destinationId">Destination</label>
                    <select id="destination" name="destination" class="form-control">
                        <option value="Dhaka">Dhaka</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value="Regular">Regular</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group">
                    <label for="serviceId">Service</label>
                    <select id="serviceId" name="service" class="form-control">
                        <option value="1">Regular</option>
                        <option value="2">Same Day</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-12">
                <div class="form-group">
                    <label for="weightId">Weight (KG)</label>
                    <input type="text" id="weightId" name="weight" value="1" placeholder="Parcel's Weight"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 tt">
            <input type="text" id="valueId" class="form-control w-25 py-3 text-dark inputsearch" value="50TK">
        </div>
        <div class="text-center mt-4">
            <span class="d-block mt-2">* ১% ক্যাশ অন ডেলিভারি ও রিস্ক ম্যানেজমেন্ট চার্জ প্রযোজ্য </span>
            <span class="d-block mt-2">* পার্সেল সাইজের কারণে ডেলিভারি মাশুল পরিবর্তিত হতে পারে </span>
            <span class="d-block mt-2">* উক্ত চার্জসমূহ ভ্যাট ও ট্যাক্স ব্যাতিত </span>
            <span class="d-block mt-2">* অনাকাঙ্ক্ষিত কারণবশত ডেলিভারি সময়ের পরিবর্তন হতে পারে</span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

{{-- without spin loading icon --}}
{{-- <script>
    $(document).ready(function() {
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            console.log('Weight Value:', weightValue);
            if (weightValue || weightValue === 0) {
                updateDeliveryCharge();
            }
        });
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);
        $('select, input').change(function() {
            updateDeliveryCharge();
        });
        function updateDeliveryCharge() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    } else {
                        console.error('Invalid response format');
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
</script> --}}

{{-- with the spin loading icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
{{-- <script>
    $(document).ready(function() {
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        $('select, input').on('change', function() {
            showLoadingIcon();
            setTimeout(function() {
                updateDeliveryCharge();
                hideLoadingIcon();
            }, 1000);
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#fromLocation').val();
            let destination = $('#destination').val();
            let category = $('#category').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            console.log(fromLocation,destination,category,service)
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }
    });
</script> --}}
{{-- test 2 --}}
{{-- <script>
    $(document).ready(function() {
        // Initial state: disable and make readonly the input field
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        // Handle input event for weight field
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        // Handle change event of form fields and make AJAX request
        $('select, input').on('change', function() {
            if ($(this).attr('id') !== 'categoryId') {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            }
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#fromLocation').val();
            let destination = $('#destination').val();
            // let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    // 'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }
    });
</script> --}}

{{-- test3 and final code with loading spin --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initial state: disable and make readonly the input field
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        // Handle input event for weight field
        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        // Handle change event of form fields and make AJAX request
        $('#fromLocation, #destination, #serviceId').on('change', function() {
            showLoadingIcon();
            setTimeout(function() {
                updateDeliveryCharge();
                hideLoadingIcon();
            }, 1000);
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#fromLocation').val();
            let destination = $('#destination').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }
    });
</script>

{{-- get the calculator value from database respect to from_location input value --}}
<script>
    $(document).ready(function() {
        var fromLocation;
        var destination;
        var selectedCategory;
        $('#fromLocation').change('change', function() {
            fromLocation = $(this).val(); // Update the variable with the selected value
            console.log("Updated fromLocation value:", fromLocation);

            // Clear and populate the destination dropdown
            $.ajax({
                url: '/get-destinations',
                type: 'GET',
                data: {
                    from_location: fromLocation
                },
                success: function(data) {
                    var destinationDropdown = $('#destination');
                    destinationDropdown.empty();
                    // destinationDropdown.append(
                    //     '<option value="" selected>Select Destination</option>');
                    $.each(data, function(index, destination) {
                        destinationDropdown.append('<option value="' + destination
                            .destination + '">' + destination.destination +
                            '</option>');
                    });

                    // Clear and populate the category dropdown
                    $('#category').empty();
                    $('#category').append(
                        '<option value="" selected>Select Category</option>');
                }
            });
        });

        $('#destination').on('click', function() {
            var destination = $(this).val();
            console.log("Updated destination value:", destination);
            // Clear and populate the category dropdown
            $.ajax({
                url: '/get-categories',
                type: 'GET',
                data: {
                    destination: destination
                },
                success: function(data) {
                    var categoryDropdown = $('#category');
                    categoryDropdown.empty();
                    // categoryDropdown.append(
                    //     '<option value="" selected>Select Category</option>');

                    $.each(data, function(index, category) {
                        categoryDropdown.append('<option value="' + category
                            .category + '">' + category.category + '</option>');
                    });
                }
            });
        });

        // Click event for the selected option in the category dropdown
        $('#category').on('click', function() {
            var selectedCategory = $(this).val();
            console.log("Selected Category:", selectedCategory);
        });
    });
</script>
