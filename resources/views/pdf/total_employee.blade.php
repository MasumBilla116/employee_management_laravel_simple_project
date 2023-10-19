<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee pdf</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        page-break-after: auto; 
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
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
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                
                
            </tr>
        </thead> 
        <tbody>
            @php $total_salary=0; @endphp
                @foreach($users as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->religion}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->designation}}</td>
                    <td>{{$row->employee_type}}</td>
                    <td>{{$row->experience}}</td>
                    <td>{{$row->salary}}</td>
                    <td>{{$row->joining_date}}</td>
                   
                    
                </tr>
                @php $total_salary += $row->salary @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr> 
                <th colspan="8" class="text-right">Total Salary</th>
                <th colspan="4" style="text-align:right">{{$total_salary}} /-</th>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>