@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
@endphp


<!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center mt-1 mb-3">
        <div class="col-md-12 col-sm-12 text-center"> 
            <h5> <i class="fa fa-cog"> {{__("LMS Configuration")}}</i></h5>
        </div>  
    </div>
    
</div>

<!-- Main content -->
<div class="container">
    <div id="smartwizard" >
         <ul class="nav">
             <li class="nav-item">
               <a class="nav-link" href="#step-1">
                 Create Library
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#step-2">
                 Create Administrator -Staff
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#step-3">
                 Create Administrator -Login
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#step-4">
               Finish
               </a>
             </li>
         </ul>

    <div class="tab-content">
       
        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
          <div class="card card-body">
             <div class="col-md-12">
             <div class="text-center text-indigo"> <h5>  <i class="fa fa-plus-circle">&nbsp;Create Library</i></h5> </div>
             <form method="post"  name="form_library" id="form_library" class="form_library"  novalidate>
             {{ csrf_field() }}
                 <div class="form-row">
                     <div class="form-group col-md-12">
                         <label for="lib_name">Library Name</label>
                         <input type="text" class="form-control mb-1" id="lib_name_si" name="lib_name_si" value="{{old('lib_name_si')}}" placeholder="Library Name in sinhala" >
                         <input type="text" class="form-control mb-1" id="lib_name_ta" name="lib_name_ta" value="{{old('lib_name_ta')}}" placeholder="Library Name in Tamil" >
                         <input type="text" class="form-control mb-1" id="lib_name_en" name="lib_name_en" value="{{old('lib_name_en')}}" placeholder="Library Name in English" >
                         
                     </div>
                     <div class="form-group col-md-12">
                         <label for="address1">Library Address1</label>
                         <input type="text" class="form-control mb-1" id="lib_address1_si" name="lib_address1_si" value="{{old('address1_si')}}" placeholder="Library Address1 in Sinhala">
                         <input type="text" class="form-control mb-1" id="lib_address1_ta" name="lib_address1_ta" value="{{old('address1_si')}}" placeholder="Library Address1 in Tamil" >
                         <input type="text" class="form-control mb-1" id="lib_address1_en" name="lib_address1_en" value="{{old('address1_si')}}" placeholder="Library Address1 in English" >
                         
                     </div>
                     <div class="form-group col-md-12">
                         <label for="address2">Library Address2</label>
                         <input type="text" class="form-control mb-1" id="lib_address2_si" name="lib_address2_si" value="{{old('address1_si')}}" placeholder="Library Address2 in Sinhala" >
                         <input type="text" class="form-control mb-1" id="lib_address2_ta" name="lib_address2_ta" value="{{old('address1_si')}}" placeholder="Library Address2 in Tamil" >
                         <input type="text" class="form-control mb-1" id="lib_address2_en" name="lib_address2_en" value="{{old('address1_si')}}" placeholder="Library Address2 in English" >
                         
                     </div>
                 
                </div>
                 <hr>
             
                 <div class="form-row">  
                     <div class="form-group col-md-6">
                         <label for="telephone">Telephone</label>
                         <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone No" value="{{old('telephone')}}">
                         <span class="text-danger">{{ $errors->first('telephone') }}</span>
                     </div>
                     <div class="form-group col-md-6">
                         <label for="fax">Fax</label>
                         <input type="text" class="form-control" id="fax" name="fax" placeholder="fax No" value="{{old('fax')}}" >
                         <span class="text-danger">{{ $errors->first('fax') }}</span>
                     </div>
                 </div>

                 <div class="form-row">  
                     <div class="form-group col-md-12">
                         <label for="lib_email">Email</label>
                         <textarea class="form-control" id="lib_email" name="lib_email" placeholder="Email" value="{{old('lib_email')}}" rows="3"></textarea>
                         <span class="text-danger">{{ $errors->first('lib_email') }}</span>
                     </div>
                 </div>
                 <div class="form-row">  
                     <div class="form-group col-md-12">
                         <label for="description">description</label>
                         <textarea class="form-control" id="description" name="description" placeholder="description" value="{{old('description')}}" rows="3"></textarea>
                         <span class="text-danger">{{ $errors->first('description') }}</span>
                     </div>
                 </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-warning btn-sm mr-2 btn_reset" id="btn_reset1"><i class="fa fa-times"></i> &nbsp;Clear</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 btn_previous" id="btn_previous1" ><i class="fa fa-chevron-circle-left"></i>&nbsp;Previous</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 btn_next" id="btn_next1" ><i class="fa fa-chevron-circle-right"></i> &nbsp;Next</button>
                </div>   
            </form>
            <br><br>          
            </div> 
        </div>
    </div>
    <!-- ================================================================================================================ -->

    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
        <div class="card card-body">
             <div class="col-md-12">
             <div class="text-center text-indigo"> <h5>  <i class="fa fa-plus-circle">&nbsp;Administrator Details</i></h5> </div>
             <form method="POST" name="form_admin_staff" id="form_admin_staff" class="form_admin_staff"  novalidate>
             {{ method_field('POST') }}
             {{ csrf_field() }}
                 <div class="form-group">
                    <div class="form-check form-check-inline" >
                        <label for="name">Title:</label> &nbsp;
                    </div>
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="title" value="Mr" >
                        <label class="form-check-label">Mr</label>
                    </div>
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="title" value="Mrs" >
                        <label class="form-check-label">Mrs</label>
                    </div>
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="title" value="Miss" >
                        <label class="form-check-label">Miss</label>
                        <div class="invalid-feedback" style="margin-left: 1em" >Please choose Title</div>
                    </div>  
                </div>

    
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" class="form-control mb-1" id="name_si" name="name_si" value="{{old('name_si')}}" placeholder="Name in Sinhala">
                <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="{{old('name_si')}}" placeholder="Name in Tamil">
                <input type="text" class="form-control mb-1" id="name_en" name="name_en" value="{{old('name_si')}}" placeholder="Name in English">
            </div>
            <div class="form-group">
                <label for="Address">Address1 :</label>
                <input type="text" class="form-control mb-1"id="Address1_si" name="Address1_si" placeholder="Address Line 1 in Sinhala" value="{{old('Address1_si')}}">
                <input type="text" class="form-control mb-1"id="Address1_ta" name="Address1_ta" placeholder="Address Line 1 in Tamil" value="{{old('Address1_ta')}}">
                <input type="text" class="form-control mb-1"id="Address1_en" name="Address1_en" placeholder="Address Line 1 in English" value="{{old('Address1_en')}}">
                <span class="text-danger">{{ $errors->first('Address1') }}</span>
            </div>
            <div class="form-group">
            <label for="Address">Address2 :</label>
                <input type="text" class="form-control mb-1"id="Address2_si" name="Address2_si" placeholder="Address Line 2 in Sinhala" value="{{old('Address2_si')}}">
                <input type="text" class="form-control mb-1"id="Address2_ta" name="Address2_ta" placeholder="Address Line 2 in Tamil" value="{{old('Address2_ta')}}">
                <input type="text" class="form-control mb-1"id="Address2_en"name="Address2_en" placeholder="Address Line 2 in English" value="{{old('Address2_en')}}">
                <span class="text-danger">{{ $errors->first('Address2') }}</span>
            </div>

            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">NIC :</label>
                    <input type="text" class="form-control"id="nic"  name="nic" placeholder="NIC" value="{{old('nic')}}" required>
                    <span class="text-danger">{{ $errors->first('nic') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile">Mobile No :</label>
                    <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Mobile No" value="{{old('Mobile')}}" required>
                    <span class="text-danger">{{ $errors->first('Mobile') }}</span>
                </div>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">Birth Day :</label>
                    <input type="date" class="form-control"id="birthday" name="birthday" placeholder="Birth Day" value="{{old('birthday')}}"required>
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                </div>
                <div class="form-group col-md-6">
                     <div class="form-group">
                        <label for="name">Gender:</label> &nbsp;<br>
                        <div class="form-check form-check-inline" >
                            <input type="radio" class="form-check-input" name="gender" value="Male" required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline" >
                            <input type="radio" class="form-check-input" name="gender" value="Female" required>
                            <label class="form-check-label">Female</label>
                            <div class="invalid-feedback" style="margin-left: 1em" >Please choose Gender</div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Description_staff">Description :</label>
                <textarea class="form-control" rows="5" id="Description_staff" name="Description_staff" placeholder="Description" value="{{old('Description_staff')}}"></textarea>
                <span class="text-danger">{{ $errors->first('Description_staff') }}</span>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="regdate">Registerd Date :</label>
                    <input type="date" class="form-control" id="registeredDate" name="registeredDate" placeholder="registered Date" value="{{old('registeredDate')}}"required>
                    <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>
            
            <div class="pull-right">
                <button type="button" class="btn btn-warning btn-sm mr-2 btn_reset" id="btn_reset2"><i class="fa fa-times"></i> &nbsp;Clear</button>
                <button type="button" class="btn btn-primary btn-sm mr-2 btn_previous" id="btn_previous2" ><i class="fa fa-chevron-circle-left"></i>&nbsp;Previous</button>
                <button type="button" class="btn btn-primary btn-sm mr-2 btn_next" id="btn_next2" ><i class="fa fa-chevron-circle-right"></i> &nbsp;Next</button>
            </div>   
            </form>
            <br><br>          
            </div> 
        </div>
 </div>
 <!-- ====================================================================================================================== -->
     <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
        <div class="card card-body">

             <div class="text-center text-indigo"> <h5>  <i class="fa fa-plus-circle">&nbsp;Administrator Details- login</i></h5> </div>
             <form method="post" name="form_admin_login" id="form_admin_login" class="form_admin_login"  novalidate>
             {{ method_field('POST') }}
             {{ csrf_field() }}
             
             <div class="form-group">
                <div class="form-group col-md-12">
                <label for="admin_name">Name :</label>
                <span id="admin_name"></span>
                </div>
            </div>    
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label for="uname">User Name :</label>
                    <input type="text" class="form-control" name="uname" id="uname" placeholder="User Name" value="{{old('uname')}}" required>
                    <span class="text-danger">{{ $errors->first('uname') }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label for="email">Email :</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <div class="invalid-feedback">Enter Valid Email Address</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-12">
                    <label for="password">Password :</label>
                    <input id="password" type="password" class="form-control" name="password" required >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group">
               <div class="form-group col-md-12">
                    <label for="confirmpassword">Confirm Password :</label>
                     <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required >
                     <div style="margin-top: 3px;" id="CheckPasswordMatch" class="text-sm text-danger"></div>
                </div>
            </div>

                <div class="pull-right">
                    <button type="button" class="btn btn-warning btn-sm mr-2 btn_reset" id="btn_reset3"><i class="fa fa-times"></i> &nbsp;Clear</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 btn_previous" id="btn_previous3" ><i class="fa fa-chevron-circle-left"></i>&nbsp;Previous</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 btn_next" id="btn_next3" ><i class="fa fa-chevron-circle-right"></i> &nbsp;Next</button>
                </div>   
            </form>
            <br><br>          
            </div> 

     </div>
     <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
         <div class="card card-body">

             <div class="text-center text-indigo"> <h5>  <i class="fa fa-check-circle">&nbsp;Finish</i></h5> </div>
             <form name="form_finish" id="form_finish" class="form_finish"  novalidate>
             {{ csrf_field() }}
             
                <div class="row form-group">
                    <div class="col-md-12"><h5><b>Library Details</b></h5></div>
                    <div class="col-md-2 text-info"><label>Name</label></div>
                    <div class="col-md-10"><span id="show_lib_name"></span></div>
                    <div class="col-md-2 text-info"><label>Address1</label></div>
                    <div class="col-md-10"><span id="show_lib_address1"></span></div>
                    <div class="col-md-2 text-info"><label>Address2</label></div>
                    <div class="col-md-10"><span id="show_lib_address2"></span></div>
                    <div class="col-md-2 text-info"><label>Telephone</label></div>
                    <div class="col-md-10"><span id="show_lib_tel"></span></div>
                    <div class="col-md-2 text-info"><label>Fax</label></div>
                    <div class="col-md-10"><span id="show_lib_fax"></span></div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-md-12"><h5><b>Admin Details</b></h5></div>
                    <div class="col-md-2 text-info"><label>Name</label></div>
                    <div class="col-md-10"><span id="show_admin_name"></span></div>
                    <div class="col-md-2 text-info"><label>Address1</label></div>
                    <div class="col-md-10"><span id="show_admin_address1"></span></div>
                    <div class="col-md-2 text-info"><label>Address2</label></div>
                    <div class="col-md-10"><span id="show_admin_address2"></span></div>
                    <div class="col-md-2 text-info"><label>NIC</label></div>
                    <div class="col-md-10"><span id="show_admin_nic"></span></div>
                    <div class="col-md-2 text-info"><label>Birthday</label></div>
                    <div class="col-md-10"><span id="show_admin_bday"></span></div>
                    <div class="col-md-2 text-info"><label>Mobile NO</label></div>
                    <div class="col-md-10"><span id="show_admin_mobile"></span></div>
                    <div class="col-md-2 text-info"><label>Email</label></div>
                    <div class="col-md-10"><span id="show_admin_email"></span></div>
                </div>

                <div class="pull-right">
                    <button type="button" class="btn btn-warning btn-sm mr-2 btn_reset" id="btn_reset_form"><i class="fa fa-window-restore"></i> &nbsp;Reset</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 btn_previous" id="btn_previous4" ><i class="fa fa-chevron-circle-left"></i>&nbsp;Previous</button>
                    <button type="button" class="btn btn-success btn-sm mr-2 toastrDefaultError toastsDefaultSuccess btn_submit" id="btn_submit" ><i class="fa fa-check"></i> &nbsp;Submit</button>
                </div>   
            </form>
            <br><br>          
            </div> 
     </div>
 </div>
</div>
       
    
</div>





@endsection

@section('script')

<script>

$(document).ready(function () {
   
    $('#smartwizard').smartWizard({
    selected: 0, // Initial selected step, 0 = first step
    theme: 'arrows', // theme for the wizard, related css need to include for other than default theme
    justified: true, // Nav menu justification. true/false
    darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
    autoAdjustHeight: true, // Automatically adjust content height
  
        backButtonSupport: true, // Enable the back button support
        
        transition: {
            animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '400', // Transion animation speed
            easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right, center
            showNextButton: false, // show/hide a Next button
            showPreviousButton: false // show/hide a Previous button
        },
        
    });

    // ----------------------------------------------------------------
    @if($locale=="si")
        $("#lib_name_si").prop('required',true);
        $("#lib_address1_si").prop('required',true);
        $("#lib_address2_si").prop('required',true);
        $("#name_si").prop('required',true);
        $("#Address1_si").prop('required',true);
        $("#Address2_si").prop('required',true);
    @elseif($locale=="ta")
        $("#lib_name_ta").prop('required',true);
        $("#lib_address1_ta").prop('required',true);
        $("#lib_address2_ta").prop('required',true);
        $("#name_ta").prop('required',true);
        $("#Address1_ta").prop('required',true);
        $("#Address2_ta").prop('required',true);
    @elseif($locale=="en")
        $("#lib_name_en").prop('required',true);
        $("#lib_address1_en").prop('required',true);
        $("#lib_address2_en").prop('required',true);
        $("#name_en").prop('required',true);
        $("#Address1_en").prop('required',true);
        $("#Address2_en").prop('required',true);
    @endif
    
});



$("#btn_next1").click(function () {
    var forms = document.getElementsByClassName('form_library');
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.classList.add('was-validated');  
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    else{$('#smartwizard').smartWizard("next");} 
    });
});

$("#btn_next2").click(function () {
    var forms = document.getElementsByClassName('form_admin_staff');
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.classList.add('was-validated');  
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    else{
        $('#smartwizard').smartWizard("next");
        var adminname=$('#name_si').val();
        $('#admin_name').html(adminname);
        } 
    });
});

$("#btn_next3").click(function () {
    var forms = document.getElementsByClassName('form_admin_login');
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.classList.add('was-validated');
    if($('#password').val()==$('#confirmpassword').val())
    {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            showValues();
            $('#smartwizard').smartWizard("next");
            } 
    }
    else
    {
        $("#CheckPasswordMatch").html("Password does not match !");
    }
    });
});

$(".btn_previous").click(function () {
    $('#smartwizard').smartWizard("prev");
});

function showValues() {
    $('#show_lib_name').html( $('#lib_name_si').val()+" "+$('#lib_name_ta').val()+" "+$('#lib_name_en').val());
    $('#show_lib_address1').html( $('#lib_address1_si').val()+" "+$('#lib_address1_ta').val()+" "+$('#lib_address1_en').val());
    $('#show_lib_address2').html( $('#lib_address2_si').val()+" "+$('#lib_address2_ta').val()+" "+$('#lib_address2_en').val());
    $('#show_lib_tel').html( $('#telephone').val());
    $('#show_lib_fax').html( $('#fax').val());

    $('#show_admin_name').html( $('#name_si').val()+" "+$('#name_ta').val()+" "+$('#name_en').val());
    $('#show_admin_address1').html( $('#Address1_si').val()+" "+$('#Address1_ta').val()+" "+$('#Address1_en').val());
    $('#show_admin_address2').html( $('#Address2_si').val()+" "+$('#Address2_ta').val()+" "+$('#Address2_en').val());
    $('#show_admin_fax').html( $('#fax').val());
    $('#show_admin_email').html( $('#email').val());
    $('#show_admin_nic').html( $('#nic').val());
    $('#show_admin_mobile').html( $('#Mobile').val());
    $('#show_admin_bday').html( $('#birthday').val());
   
  }

//   ---------------submit-------------------
$("#btn_submit").click(function () {
    $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('create_lib')}}", 
            data: $('#form_library').serialize(),

            success:function(data){
                toastr.success('Library Created Successfully')  
            },
            error:function(data){
                toastr.error('Library Create faild')
            }
        })


        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('create_staff')}}", 
            data: $('#form_admin_staff').serialize(),

            success:function(data){
                toastr.success('Admin Details Created Successfully')  
            },
            error:function(data){
                toastr.error('Admin Details Create faild')
            }
        })

        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('create_user')}}", 
            data: $('#form_admin_login').serialize(),

            success:function(data){
                toastr.success('Admin Login Created Successfully')
                document.location = './login';
            },
            error:function(data){
                toastr.error('Admin Login Create faild')
            }
        })

   
});
// ------------------------------------------


</script>


@endsection
