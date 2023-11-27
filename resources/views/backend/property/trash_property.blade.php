@extends('admin.admin_dashboard')
@section('admin')

@push('css-style')

    <!-- Include Bootstrap Toggle CSS -->
{{--     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet"> --}}
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
                        <th>Code </th> 
                        <th>Status </th>  
                        <th>Action </th> 
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($bin_data as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ asset($item->property_thambnail) }}" style="width:70px; height:40px;"> </td> 
                        <td>{{ $item->property_name }}</td> 
                        <td>{{ $item->propertyType->type_name }}</td> 
                        <td>{{ $item->property_status }}</td> 
                        <td>{{ $item->city }}</td> 
                        <td>{{ $item->property_code }}</td> 
                        <td> 
                      @if($item->status == 1)
                <span class="badge rounded-pill bg-success">Active</span>
                      @else
               <span class="badge rounded-pill bg-danger">InActive</span>
                      @endif

                        </td> 
                        <td>

        <a href="{{-- {{ route('details.property',$item->id) }} --}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>

       <a class="btn btn-inverse-warning restore-data" data-property_id="{{ $item->id }}" title="Restore"><i style='font-size:22px' class='fas fa-trash-restore-alt'></i></a>

       <a class="btn btn-inverse-danger property-delete-parmanently" data-delete_parmanent_id="{{ $item->id }}" title="Delete"> delete forever  </a>
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
    <script>
    $(document).ready(function(){
        $('.restore-data').on('click', function(ev){
            ev.preventDefault();
            var data_id = $(this);
            var property_id = $(this).data('property_id');
            console.log(property_id);

            var url = "{{ route('restore.property',['pid'=>':property_id']) }}";
            url = url.replace(':property_id', property_id);
            console.log(url);
            console.log(data_id);

            Swal.fire({
                title: 'Are you sure?',
                text: 'Restore This Data?',
                icon: 'warning',
                color: '#000000',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            console.log(response);
                                Swal.fire({
                                    icon: "success",
                                    title: "Restored",
                                    text: response.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                data_id.parent().parent('tr').remove();
                                if (response.error) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Unable to restore",
                                    text: response.error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });

                              }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                title: "Oops...",
                                text:error,
                                icon: "error"
                            });
                        }
                    });

                }

            });

        });


        /* Property Deleted Parmanently Here */

        $('.property-delete-parmanently').on('click', function(eve){
    
            eve.preventDefault();
            var data_id = $(this);
            var propertyId = $(this).data('delete_parmanent_id');
            console.log(propertyId);

            var url = "{{ route('property.deleteParmanently',['id'=>':property_id']) }}";
            url = url.replace(':property_id', propertyId);
            console.log(url);
            console.log(data_id);

            Swal.fire({
                title: 'Are you sure That',
                text: 'To Parmanently Delete  This Property ?',
                icon: 'warning',
                color: '#000000',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Parmanently Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            console.log(response);
                                Swal.fire({
                                    icon: "success",
                                    title: "Parmanently Deleted",
                                    text: response.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                data_id.parent().parent('tr').remove();
                                if (response.error) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Unable to Parmanently Delete",
                                    text: response.error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });

                              }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                title: "Oops...",
                                text:error,
                                icon: "error"
                            });
                        }
                    });

                }

            });

        });


        })
    </script>

    @endpush





@endsection