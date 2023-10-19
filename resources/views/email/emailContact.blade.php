<!DOCTYPE html>
<html lang="en">

<head>
    <section></section>

    @include('admin.css')

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

                    <h2>Send Email</h2>
                    <form action="{{route('send.email')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="to">To:</label>
                            <input type="email" class="form-control" id="to" name="to" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>




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
    @if(session("send_mail") === "success")
    @php Session::forget('send_mail'); @endphp
    <script>
            swal("Email Send Success","This mail is send successfully","success");
    </script>
    @endif

</body>

</html>