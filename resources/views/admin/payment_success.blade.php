<!DOCTYPE html>
<html lang="en">

<head>
    <section></section>

    @include('admin.css')
    @section('page_title','employee_records') 
</head>

<body id="page-top">
    <div class="w-100 d-flex justify-content-center align-items-center" style="height:100vh;">
        <div> 
            <h1 class="text-info text-bold">Payment Success</h1>
            <a href="/employees/payment" class="btn btn-info mt-4">Go to payment</a>
        </div>
    </div>


    @include('admin.js')
    <script> 
    $(document).ready(function(){
        const id = localStorage.getItem("payment_id");
            $.ajax({
                url: `http://localhost:8000/payment/paid/${id}`,
                type: "get",
                success: function(res){
                    if(res.success === true)
                    {
                        swal("Payment Success","Your payment is successfull","success")
                    }
                    else{
                        swal("Failed","Your payment is failed","error")
                    }
                }
            });
            localStorage.clear();
    })
      
    </script>

</body>
</html>