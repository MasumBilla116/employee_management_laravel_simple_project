 <!-- Modal -->
 <div class="modal fade" id="edit_employee" role="dialog">
     <form action="" method="post" id="edit_employee">

         @csrf
         <input type="hidden" name="user_id" id="edit_user" value="">
         <div class="modal-dialog">

             <!-- Modal content-->
             <div class="modal-content">
                 <div class="modal-header">

                     <h4 class="modal-title">Edit Employee</h4>
                 </div>

                 <div class="modal-body">
                     <div class="errorMessageContainer mx-3 "> </div>
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="edit_name">Name</label>
                                 <input type="text" name="name" class="form-control  w-100 text-dark" id="edit_name" placeholder="Enter Name"  value="">

                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="dob">Date of Birth</label>
                                 <input type="date" name="dob" class="form-control  w-100 text-dark"  id="edit_dob" placeholder="Enter date of birth"  value="">
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="gender">Gender</label>
                                 <select class="form-control  w-100 text-dark" id="edit_gender" name="gender">
                                     <option value="">Select Gender</option>
                                     <option value="male">Male</option>
                                     <option value="female">Female</option>
                                     <option value="other">Others</option>

                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="religion">Religion</label>
                                 <input type="text" name="religion" class="form-control" id="edit_religion" placeholder="Enter Religion">
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="phone">Phone</label>
                                 <input type="text" name="phone" class="form-control  w-100 text-dark" id="edit_phone" placeholder="Enter phone">
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="department">Department</label>
                                 <select class="form-control  w-100 text-dark" id="edit_department" name="department">
                                     <option  value="">select depertment</option>
                                     @foreach($department as $row)
                                        <option value="{{$row->dept_id}}">{{$row->dept_name}}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6"> 
                             <div class="form-group">
                                 <label for="designation">Designation</label>
                                 <select class="form-control  w-100 text-dark" id="edit_designation" name="designation">
                                     <option value="">select designation</option>
                                     @foreach($designation as $row)
                                        <option value="{{$row->designation_id}}">{{$row->designation}}</option>
                                    @endforeach

                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="emp_type">Employee type</label>
                                 <select class="form-control  w-100 text-dark"  id="edit_emp_type" name="emp_type">
                                     <option  value="">select employee type</option> 
                                     @foreach($employee_type as $row)
                                        <option value="{{$row->emp_type_id}}">{{$row->employee_type}}</option>
                                    @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="joining_date">Joining Date</label>
                                 <input type="date" name="joining_date" class="form-control  w-100 text-dark" id="edit_joining_date" placeholder="Enter Joining Date">
                             </div>
                         </div>
                         <div class="col-lg-6">

                             <div class="form-group">
                                 <label for="experience">Experience</label>
                                 <input type="text" name="experience" class="form-control w-100 text-dark" id="edit_experience" placeholder="Enter Experience">
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label for="salary">Salary</label>
                                 <input type="number" value="" name="salary" class="form-control w-100 text-dark" id="edit_salary" placeholder="Enter Salary">
                             </div>
                         </div> 
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label for="address">Address</label>
                                 <textarea  class="w-100 text-dark" name="address" id="edit_address" cols="42" rows="3" placeholder="Enter Address"></textarea>
                             </div>
                         </div> 
                     </div>  
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger modal-close" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Edit Employee</button>
                 </div>
             </div>

         </div>
     </form>
 </div>