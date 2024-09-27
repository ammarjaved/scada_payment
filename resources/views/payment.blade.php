@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="row mb-2" style="flex-wrap:nowrap">
        <div class="col-sm-6">
            <h3>Payment Details</h3>
        </div>
        <div class="col-sm-6 text-right">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Payment Details</li>
            </ol>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="container bg-white shadow my-4" style="border-radius: 10px">
            @if($data->isEmpty())
                <p class="p-4">No payment records found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Payment Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Date</th>
                            <th>Vendor Name</th>
                            <th>Project</th>
                            <th>Action</th> <!-- New Action Column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->pmt_name }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ $payment->pmt_date }}</td>
                                <td>{{ $payment->vendor_name }}</td>
                                <td>{{ $payment->project }}</td>
                                <td>
                                    <!-- Slider Button -->
                                    <label class="switch">
                                        <input type="checkbox" onchange="togglePayment({{ $payment->id }})" {{ $payment->status == 'Active' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    function togglePayment(paymentId) {
        // Add your AJAX or form submission logic here to handle the toggle action
        alert("Toggle payment status for ID: " + paymentId);
        // Example AJAX request (modify as needed)
        /*
        $.ajax({
            url: '/payments/toggle/' + paymentId, // Adjust the URL as necessary
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Add CSRF token for protection
            },
            success: function(response) {
                // Handle success (e.g., update UI or notify user)
            },
            error: function(xhr) {
                // Handle error
            }
        });
        */
    }
</script>

<style>
    /* Slider Button Styles */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@endsection
