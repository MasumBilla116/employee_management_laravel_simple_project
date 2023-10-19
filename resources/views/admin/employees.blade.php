<!DOCTYPE html>
<html lang="en">

<head>
    <section></section>

    @include('admin.css')
    @section('page_title','employee_records')
    <style>
        .error {
            font-size: 14px;
            color: red;
        }
    </style>
    <!-- datepicker styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
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
                    <h1 class="h3 mb-2 text-gray-800 text-center">Employee Records</h1>

                    <a class="btn btn-primary mb-3" style="margin-bottom: 10px;" data-toggle="modal" data-target="#myModal">Add Employee</a><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <form id="filter_form" action="{{ route('employee.table.pdf')}}" mathod="post">
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
                                            <th>Joining Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.add_employee_model')
                    @include('admin.employee_edit_model')

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
                url: '{{ route("admin.datatable") }}',
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
                    data: 'joining_date'
                },
                {
                    data: 'status'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex justify-content-center align-items-center">' +
                            '<button type="button" class="btn btn-primary btn-sm mr-2 edit_btn" data-toggle="modal" data-target="#edit_employee" data-id="' + row.id + '">' +
                            '<i class="fas fa fa-edit"></i> </button>' +
                            '<button type="button" class="btn btn-danger btn-sm delete_item" data-id="' + row.id + '"> <i class="fas fa fa-trash"></i> </button> </div>';
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
            datatable.ajax.url("{{ route('admin.datatable') }}?" + data).load();
        })

        // datepicker
        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        /**
         * ----------------------------------------
         * add new employee  form validation
         * ---------------------------------------
         */
        $("#add_employee").validate({
            // Specify validation rules
            rules: {
                name: "required",
                dob: "required",
                gender: "required",
                religion: "required",
                phone: "required",
                department: "required",
                designation: "required",
                emp_type: "required",
                joining_date: "required",
                experience: "required",
                salary: "required",
                email: "required",
                password: "required",
                address: "required",
            },
        });

        /**
         * --------------------------------------
         * Add a new employee
         * --------------------------------------
         * **/
        $("#add_employee").on("submit", function(e) {
            e.preventDefault();
            const formData = $(this).serializeArray(); // form data serialize
            const targetTable = $(this).data("target-table");
            $.ajax({
                url: "/store/employee",
                type: 'post',
                data: formData,
                success: function(res) {
                    if (res.status === "error") {
                        swal("Warning", `${res.message}`, "warning");
                    } else {

                        $("#add_employee").trigger("reset"); // reset form
                        $(".modal-close").trigger("click"); // close modal
                        swal("Successfull", `${res.message}`, "success");
                        datatable.ajax.reload(); // reload datatable
                    }
                }
            })
        });

        /**
         * --------------------------------------
         * delete a employee
         * --------------------------------------
         * **/

        $(document).on("click", ".delete_item", function(e) {
            e.preventDefault();
            const id = $(this).attr("data-id"); // get user id
            swal({
                title: "Are you sure? Delete this item",
                text: "You will not be able to recover this data!",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) { // if alert is ok
                    $.ajax({ // delete user 
                        url: `http://localhost:8000/delete/employee/${id}`,
                        type: 'get',
                    });
                    swal({
                        title: 'Delete Success',
                        text: 'Candidates are successfully deleted!',
                        icon: 'success'
                    }).then(() => {
                        datatable.ajax.reload(); // reload datatable
                    })

                } else {
                    swal("Cancelled", "Your imaginary file is safe", "error");
                }
            })
        })


        /**
         * --------------------------------------
         * Edit a employee open modal
         * --------------------------------------
         * **/
        $(document).on("click", ".edit_btn", function(e) { // modal btn
            e.preventDefault();
            const id = $(this).attr('data-id'); // user id
            console.log("user: ", id)
            $.ajax({
                url: `/edit/employee_info/${id}`,
                type: 'get',
                success: function(res) {
                    $("#edit_user").val(res.data.id);
                    $("#edit_name").val(res.data.name);
                    $("#edit_dob").val(res.data.DoB);
                    $("#edit_religion").val(res.data.religion);
                    $("#edit_phone").val(res.data.phone);
                    $("#edit_joining_date").val(res.data.joining_date);
                    $("#edit_experience").val(res.data.experience);
                    $("#edit_salary").val(res.data.salary);
                    $("#edit_address").val(res.data.address);
                    $("#edit_gender").val(res.data.gender);
                    $("#edit_department").val(res.data.department_id);
                    $("#edit_designation").val(res.data.designation_id);
                    $("#edit_emp_type").val(res.data.emp_type_id);
                }
            });

            /**
             * ----------------------------------------
             * update employee ajax
             * ---------------------------------------
             */
            $(document).on("submit", "#edit_employee", function(e) {
                e.preventDefault();
                const formData = $(this).serializeArray(); // form data serialize
                $.ajax({
                    url: "/update/employee_info",
                    type: 'post',
                    data: formData,
                    success: function(res) {
                        if (res.status === "error") {
                            swal("Warning", `${res.message}`, "warning");
                        } else {
                            $("#edit_employee").trigger("reset"); // reset edit modal form
                            $(".modal-close").trigger("click"); // close modal
                            swal("Successfull", `${res.message}`, "success");
                            datatable.ajax.reload(); // reload datatable
                        }
                    }
                })
            });
        });


        
    </script>

</body>

</html>