<!DOCTYPE html>
<html lang="en">

<head>
    <section></section>

    @include('admin.css')
    @section('page_title','employee_records')
     <!-- datepicker styles -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <style>
        .error {
            font-size: 14px;
            color: red;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 my-4 text-gray-800 text-center">Employee Salary Payment</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <form id="filter_form" action="{{ route('employee.payment.pdf')}}" mathod="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group mb-4">
                                            <div class="datepicker date input-group">
                                                <input type="text" placeholder="From Date" name="from_date" class="form-control" id="from_date">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group mb-4">
                                            <div class="datepicker date input-group">
                                                <input type="text" placeholder="To Date" name="to_date" class="form-control" id="to_date">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <select class="form-control  w-100 text-dark" name="designation">
                                                <option value="">select designation</option>
                                                @foreach($designation as $row)
                                                <option value="{{$row->designation_id}}">{{$row->designation}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input type="number" value="" name="salary" class="form-control w-100 text-dark" placeholder="Enter Salary">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-around">
                                            <button type="submit" id="filter" class="btn btn-primary font-weight-bold ">
                                                Filter
                                            </button>
                                            <button type="submit" class="btn btn-primary font-weight-bold  ">
                                                <i class="fas fa fa-file-pdf"></i>
                                            </button>
                                            <button type="reset" id="filter" class="btn btn-primary font-weight-bold ">
                                                <i class="fas fa fa-history"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Religion</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Type</th>
                                            <th>Experience</th>
                                            <th>Salary</th>
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            @include('admin.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->





    <!-- Bootstrap core JavaScript-->
    @include('admin.js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        // start datatable js
        var datatable = $("#dataTable").DataTable({
            ajax: {
                url: '{{ route("admin.employees.payment.datatable") }}',
                dataSrc: 'data',
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'religion'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'dept_name'
                },
                {
                    data: 'designation'
                },
                {
                    data: 'employee_type'
                },
                {
                    data: 'experience'
                },
                {
                    data: 'salary'
                },
                {
                    data: 'payment_status'
                },
                {
                    data: 'status'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (data.payment_status === "paid") {
                            return `<button type="button" class="btn btn-success btn-sm" disabled>Payment</button>`;
                        } else {
                            return `<a href="https://buy.stripe.com/test_28o9Dw3LD4wE2WcfYY"  class="btn btn-primary btn-sm payment_btn" data-id='${data.id}'>Payment</a>`;
                        }

                    }
                }
            ],
            order: [
                [1, 'desc']
            ],

        });
        // end datatable js

        //filter employee table
        $("#filter").on("click", function(e) {
            e.preventDefault();
            const data = $("#filter_form").serialize();
            datatable.ajax.url("{{ route('admin.employees.payment.datatable') }}?" + data).load();
        })

        // datepicker
        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy-mm-dd"
        });


        //get payment id

        $(document).on("click", ".payment_btn", function() {
            const id = $(this).attr('data-id');
            localStorage.setItem("payment_id", id);
        });
    </script>

</body>

</html>