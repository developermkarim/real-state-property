@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

@push('css-style')

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush


<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
	  <a href="{{ route('add.agent') }}" class="btn btn-inverse-info"> Add Agent    </a>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Agent All </h6>

                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Image </th>
                        <th>Name </th>
                        <th>Role </th>
                        <th>Status </th>
                        <th>Change </th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($allagent as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ (!empty($item->photo)) ? url('upload/agent_images/'.$item->photo) : url('upload/no_image.jpg') }}" style="width:70px; height:40px;"> </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->role }}</td>
                        <td>
                     {{--  @if($item->status == 'active') --}}

                <span id="agent-change-status" class="agent-change-status{{ $item->id }} badge rounded-pill @if($item->status == 'active') bg-success @elseif($item->status == 'inactive') bg-danger @endif ">{{ $item->status == 'active' ? 'active' : 'inactive' }}</span>

             {{--   <span class="badge rounded-pill bg-danger">InActive</span>
 --}}
                    </td>
                <td>

{{--   <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"  data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $item->status ? 'checked' : '' }} > --}}

                <div class="form-check form-switch mb-2">
                    <input  type="checkbox" data-agent-data="{{ $item->id }}" @checked($item->status == 'active')  class="form-check-input agent-status" id="formSwitch1">
                </div>

                    </td>
                        <td>

       <a href="{{ route('edit.agent', $item->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>

       <a data-agent-id="{{ $item->id }}" class="btn btn-inverse-danger delete-agent" title="Delete"> <i data-feather="trash-2"></i>  </a>
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
            <script>
$(document).ready(function(){

    $('.delete-agent').on('click', function(ev){
        ev.preventDefault()

        var id_data = $(this);
        var agentId = $(this).data('agent-id');

        console.log(agentId);

        var url = "{{ route('delete.agent',['id'=>':agent_id']) }}";
        url = url.replace(':agent_id', agentId);
        console.log(url);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            showClass: {
                popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
                `
            },
            hideClass: {
                popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
                `
            }
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        console.log(response);
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
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the file.',
                            'error'
                        );
                    }
                });

            }
        });
    });

});
</script>

    <script>

        $(document).ready(function(){
            $('.agent-status').on('change', function(ev){

                var agentId = $(this).data('agent-data');
                var agent_status_change = $('.agent-change-status' + agentId);

                console.log(agentId);

                var url = "{{ route('agent.status',[':id'=>'agent_id']) }}";
                url = url.replace(':id', agentId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data:{
                        agent_id:agentId,
                        _token:"{{ csrf_token() }}"
                    },
                    success: function (response) {
                        console.log(response);
                        if(response.status === 'active'){
                            agent_status_change.text('active');
                            agent_status_change.addClass('bg-success');
                            agent_status_change.removeClass('bg-danger');

                        }else if(response.status === 'inactive'){
                            agent_status_change.text('inactive');
                            agent_status_change.addClass('bg-danger');
                            agent_status_change.removeClass('bg-success');
                        };

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

                            id_data.parent().parent('tr').remove();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the file.',
                            'error'
                        );
                    }
                });

            })
        });

</script>
    @endpush

@endsection
