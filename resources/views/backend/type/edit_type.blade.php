@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->

      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
         <div class="card">
          <div class="card-body">

        <h6 class="card-title">Add Property Type </h6>

        <form method="POST" id="property_type" action="{{ route('update.type') }}" class="forms-sample">
            @csrf

            <input type="hidden" name="property_id" value="{{ $types->id }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Type Name   </label>
                                    <input type="text" value="{{ $types->type_name }}" name="type_name" class="form-control @error('type_name') is-invalid @enderror">
                          @error('type_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Type Icon   </label>
                                        <input type="text" value="{{ $types->type_icon }}" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror " >
                              @error('type_icon')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
            </div>

            <button type="submit" class="btn btn-primary me-2">Update Changes</button>

        </form>

          </div>
        </div>

        </div>
      </div>
      <!-- middle wrapper end -->
      <!-- right wrapper start -->

      <!-- right wrapper end -->
    </div>

        </div>

        <script type="text/javascript">
        $(document).ready(function(){
            $('#property_type').validate({
                rule:{
                    type_name:{
                        required:true,
                    },
                    type_icon:{
                        required:true,
                    }
                },
                message:{
                    type_name:{
                        required:"Please Update The Property Type"
                    },
                    type_icon:{
                        required:"Please Update The Property Type Icon"
                    }
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
                })
            })

        </script>
@endsection
