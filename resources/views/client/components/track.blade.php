<div class="container-xxl domain mb-5" style="margin-top: 90px;">
    <div class="container px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-title position-relative text-center mx-auto mb-4 pb-4 wow fadeInUp"
                    data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3 fs-5">TRACK YOUR CONSIGNMENT</h1>
                    <p class="mb-1">Now you can easily track your consignment</p>
                </div>
                <div class="position-relative w-100 my-3 wow fadeInUp" data-wow-delay="0.3s">
                    {{-- <form action="{{ route('delivery.search') }}"  method="get" id="searchForm">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Enter your Tracking ID">
                        <button type="button"
                            class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Search</button>
                    </form> --}}
                    <form id="searchForm">
                        @csrf
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            name="tracking_id" placeholder="Enter your Tracking ID">
                        <button type="button"
                            class="btn btn-warning py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Search</button>
                    </form>
                </div>
                <div class="row g-3 wow fadeInUp justify-content-center" data-wow-delay="0.5s">
                    <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
                        <h5 class="fw-bold text-warning mb-1">24 Hours</h5>
                        <p class="mb-0">Regular Delivery</p>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
                        <h5 class="fw-bold text-warning mb-1">24 Hours</h5>
                        <p class="mb-0">Multiple Delivery</p>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-6 text-center">
                        <h5 class="fw-bold text-warning mb-1">5 Hours</h5>
                        <p class="mb-0">Express Delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

<section class="step-wizard">
    <ul class="step-wizard-list py-5">
        <li class="step-wizard-item">
            <span class="progress-count">1</span>
            <span class="progress-label">Pending</span>
        </li>
        <li class="step-wizard-item current-item">
            <span class="progress-count">2</span>
            <span class="progress-label">on the way</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">Checkout</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">4</span>
            <span class="progress-label">Success</span>
        </li>
    </ul>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.step-wizard').hide();
        $('#searchForm button').on('click', function() {
            var trackingId = $('#searchForm input[name="tracking_id"]').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('search.delivery') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tracking_id': trackingId
                },
                success: function(data) {
                    // var is_active = data.delivery.is_active;
                    var is_active = parseInt(data.delivery.is_active, 10);
                    progressCountValue = is_active + 1;
                    console.log(progressCountValue)

                    // Call the script to dynamically set the active step
                    updateActiveStep(progressCountValue);
                    $('.step-wizard').show();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });

        // Function to update the active step
        function updateActiveStep(progressCountValue) {
            
            // Remove 'current-item' class from all items
            $('.step-wizard-item').removeClass('current-item');

            // Add 'current-item' class to the items up to the one with the matching progress-count value
            $('.step-wizard-item').each(function() {
                var stepValue = parseInt($(this).find('.progress-count').text());

                if (stepValue == progressCountValue) {
                    $(this).addClass('current-item');
                }
            });
        }
    });
</script>

