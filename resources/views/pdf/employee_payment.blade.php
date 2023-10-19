<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee payment</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            page-break-after: auto;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
            white-space: nowrap;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 10px;
        }
    </style>

</head>

<body>
    <div style="text-align:center">
        <h2>Employee Payment</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Type</th>
                    <th>Salary</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total_salary=0; @endphp
                @foreach($users as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->designation}}</td>
                    <td>{{$row->employee_type}}</td>
                    <td>{{$row->salary}}</td>
                    <td>
                        @if($row->payment_status === "paid")
                        <div class="badge bg-success text-light">{{$row->payment_status}}</div>
                        @else
                        <div class="badge bg-warning  text-light">{{$row->payment_status}}</div>
                        @endif
                    </td>
                    <td>
                        <a href="https://buy.stripe.com/test_28o9Dw3LD4wE2WcfYY" class="btn btn-primary btn-sm payment_btn" data-id="{{$row->id}}">Payment</a>
                    </td>
                </tr>
                @php $total_salary += $row->salary @endphp
                @endforeach

                @php
                $total_salary = 0;
                $total_paid_salary = 0;
                $total_unpaid_salary = 0;
                @endphp

                @foreach($users as $row)
                <tr>

                </tr>

                @php
                $total_salary += $row->salary;

                // Check if the payment status is "paid" and update the respective total
                if($row->payment_status === "paid") {
                $total_paid_salary += $row->salary;
                } else {
                $total_unpaid_salary += $row->salary;
                }
                @endphp
                @endforeach
            </tbody>
            <tfoot style="border:none">
                <tr>
                    <th colspan="6" style="text-align:right;">Total Salary</th>
                    <th colspan="3">{{$total_salary}} /-</th>
                </tr>
                <tr>
                    <th colspan="6" style="text-align:right;">Total Paid Salary</th>
                    <th colspan="3">{{$total_paid_salary}} /-</th>
                </tr>
                <tr>
                    <th colspan="6" style="text-align:right">Total Unpaid Salary</th>
                    <th colspan="3">{{$total_unpaid_salary}} /-</th>
                </tr>
            </tfoot>

        </table>
    </div>

    @include('admin.js')
    <script>
        $(".payment_btn").on("click", function() {
            const id = $(this).attr('data-id');
            localStorage.setItem("payment_id", id);
        });

        $
    </script>
</body>

</html>