<!--Create Modal -->
<div class="modal fade bd-example-modal-lg" id="data_create" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Create Guarantor</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('member_guarantor.store') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
            <div class="modal-body">
            <div class="form-group col-md-6">
                <div class="form-check form-check-inline" >
                    <label for="name">Title:</label> &nbsp;
                </div>
                @foreach($tdata as $item)
                <div class="form-check form-check-inline" >
                    <input type="radio" class="form-check-input" name="title" value="{{$item->id}}" required>
                    <label class="form-check-label">{{$item->$title}}</label>
                </div>
                @endforeach
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
                    <input type="text" class="form-control" name="nic" placeholder="NIC" value="{{old('nic')}}"required>
                    <span class="text-danger">{{ $errors->first('nic') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile">Mobile No :</label>
                    <input type="text" class="form-control" name="Mobile" placeholder="Mobile No" value="{{old('Mobile')}}"required>
                    <span class="text-danger">{{ $errors->first('Mobile') }}</span>
                </div>
            </div>

            <div class=" row form-group">

                <div class="form-group col-md-12">
                    <label for="name">Gender:</label> <br>
                    <div class="bg-light p-2">
                        <div class="form-check form-check-inline" >
                            @foreach($gedata as $item)
                            <div class="form-check form-check-inline" >
                                <input type="radio" class="form-check-input" name="gender" value="{{$item->id}}" required>
                                <label class="form-check-label">{{$item->$gender}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Description_staff">Description :</label>
                <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description" value=""></textarea>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
          

        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Save</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Create model -->