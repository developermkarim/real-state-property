@extends('admin.admin_dashboard')
@section('admin')

@push('css-style')

    <!-- Include Bootstrap Toggle CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
.swal2-popup.swal2-toast {
  padding: 1.0em !important;
  background: #111146 !important;
}

.toggle-handle {
    background: #dbdbdc;
}
    </style>
@endpush


<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
	  <a href="{{ route('add.property') }}" class="btn btn-inverse-info"> Add Property    </a>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Property All </h6>

                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Image </th>
                        <th>Name </th>
                        <th>P Type </th>
                        <th>Status Type </th>
                        <th>City </th>
                        <th>Status </th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($property as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ asset($item->property_thambnail) }}" style="width:70px; height:40px;"> </td>
                        <td>{{ $item->property_name }}</td>
                        <td>{{ $item->ptype_id }}</td>
                        <td>{{ $item->property_status }}</td>
                        <td>{{ $item->city }}</td>

                        <td>
                      <input
                            data-property_id="{{ $item->id }}"
                            class="toggle-class"
                            type="checkbox"
                            data-onstyle="success"
                            data-offstyle="danger"
                            data-toggle="toggle"
                            data-on="Active"
                            data-off="Inactive"
                            {{ $item->status == '1' ? 'checked' : '' }} >
                        </td>

                        <td>

       <a href="{{ route('property.show', $item->id) }}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>

       <a href="{{ route('edit.property',$item->id) }}" class="btn btn-inverse-warning restore-data" data-property_id="{{ $item->id }}" title="Restore"> <i data-feather="edit"></i> </a>
       
       <a data-property_id="{{ $item->id }}" id="delete-record" class="btn btn-inverse-danger delete-record"> Bin <i data-feather="trash"></i></a>

 
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		  </div>
		</div>
	</div>

@push('js-script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.toggle-class').on('change',function(ev){
                ev.preventDefault();

                var property_id = $(this).data('property_id');
                console.log(property_id);
                var url = "{{ route('status.property',['property_id'=> ':property_id']) }}";
                url = url.replace(':property_id' , property_id);

                console.log(url);

                $.ajax({
                    url:url,
                    method:'GET',
                    success:function(response){
                        console.log(response);
                        if (response.hasOwnProperty('success')) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                            }
                            });
                            Toast.fire({
                            icon: "success",
                            title: response.success
                            });

                    }else if(response.hasOwnProperty('error')){
                    var errorMessage = response.error;
                    alert(errorMessage);
                    }
                }

                })
            })


        /* Delete Record With Ajax */
        $('.delete-record').on('click', function (ev) {
            ev.preventDefault();
            var deleteData = $(this);
            var property_id = $(this).data('property_id');

            console.log(property_id);

            var url = "{{ route('property.thrash',['pid'=>':property_id']) }}";
            url = url.replace(':property_id', property_id);
            console.log(url);
            console.log(deleteData);

            Swal.fire({
                title: 'Are you sure?',
                text: 'Move to Bin This Data?',
                icon: 'warning',
                color: '#000000',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Trash it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            console.log(response);
                                Swal.fire({
                                    icon: "success",
                                    title: "Move To Trash",
                                    text: response.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                 deleteData.parent().parent('tr').remove();
                                if (response.error) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Unable to Trash",
                                    text: response.error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });

                              }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText.message);
                            Swal.fire({
                                title: "Oops...",
                                text:message,
                                icon: "error"
                            });
                        }
                    });

                }

            });

        })
    })
</script>

@endpush

@endsection
