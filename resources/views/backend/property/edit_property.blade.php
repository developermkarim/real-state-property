@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">


    <div class="row profile-body">
        <!-- left wrapper start -->

        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property </h6>
                        <form method="POST" action="{{ route('update.property') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $properties->id }}" name="property_id">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Property Name </label>
                                        <input type="text" name="property_name" value="{{ $properties->property_name }}"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Property Status</label>
                                        <select name="property_status" class="form-select"
                                            id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Status</option>
                                            <option @selected($properties->property_status == 'rent') value="rent">For
                                                Rent</option>
                                            <option @selected($properties->property_status == 'buy') value="buy">For Buy
                                            </option>
                                        </select>
                                    </div>
                                </div><!-- Col -->


                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lowest Price </label>
                                        <input value="{{ $properties->lowest_price }}" type="text" name="lowest_price"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->


                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Max Price </label>
                                        <input type="text" value="{{ $properties->max_price }}" name="max_price"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->


                            </div><!-- Row -->



                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">BedRooms</label>
                                        <input type="text" value="{{ $properties->bedrooms }}" name="bedrooms"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bathrooms</label>
                                        <input type="text" value="{{ $properties->bathrooms }}" name="bathrooms"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage</label>
                                        <input type="text" value="{{ $properties->garage }}" name="garage"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" value="{{ $properties->garage_size }}" name="garage_size"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->

                            </div><!-- Row -->


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" value="{{ $properties->address }}" name="address"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" value="{{ $properties->city }}" name="city"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" value="{{ $properties->state }}" name="state"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code </label>
                                        <input type="text" value="{{ $properties->postal_code }}" name="postal_code"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->

                            </div><!-- Row -->


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" value="{{ $properties->property_size }}" name="property_size"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" value="{{ $properties->property_video }}"
                                            name="property_video" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" value="{{ $properties->neighborhood }}" name="neighborhood"
                                            class="form-control">
                                    </div>
                                </div><!-- Col -->


                            </div><!-- Row -->




                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" value="{{ $properties->latitude }}" name="latitude"
                                            class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get Latitude from address</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" value="{{ $properties->longitude }}" name="longitude"
                                            class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get Longitude from address</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->



                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type </label>
                                        <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach($propertytype as $ptype)
                                            <option @selected($properties->id == $ptype->property_id )
                                                value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <?php
                // $amen = '';
                $prev_amenities = explode(',',$properties->amenities_id);
              //  print_r($prev_amenities);
                ?>
                                        <label class="form-label">Property Amenities </label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">

                                            @foreach($amenities as $ameni)
                                            @php
                                            // Check if the current ameniti_id is selected for the property
                                            $selected = in_array($ameni->id, $prev_amenities);
                                            @endphp
                                            <option value="{{ $ameni->id }}" {{ $selected ? 'selected' : '' }}>
                                                {{ $ameni->amenitis_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Agent </label>
                                        <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Agent</option>
                                            @foreach($activeAgent as $agent)
                                            <option @selected($properties->agent_id == $agent->id)
                                                value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->


                            </div><!-- Row -->


                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_descp"
                                        value="{{ $properties->short_descp }}" id="exampleFormControlTextarea1"
                                        rows="3"></textarea>

                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>

                                    <textarea class="form-control" value="{{ $properties->long_descp }}"
                                        name="long_descp" id="tinymceExample" rows="10"></textarea>

                                </div>
                            </div><!-- Col -->

                            <hr>

                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" @checked($properties->featured == true) name="featured"
                                    value="1" class="form-check-input" id="checkInline1">
                                    <label class="form-check-label" for="checkInline1">
                                        Features Property
                                    </label>
                                </div>


                                <div class="form-check form-check-inline">
                                    <input type="checkbox" {{ $properties->hot == 1 ? 'checked' : '' }} name="hot"
                                        value="1" class="form-check-input" id="checkInline">

                                    <label class="form-check-label" for="checkInline">
                                        Hot Property
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Save Changes </button>


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
            

                        <!--  /// Facility Update //// -->

<div class="page-content" style="margin-top: -35px;">

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Facility </h6>


                        <form method="post" action="{{ route('update.property.facilities') }}" id="myForm">
                            @csrf

                            <input type="hidden" name="property_id" value="{{ $properties->id }}">

                            @foreach($facilities as $item)
                            <div class="row add_item">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                        <div class="container mt-2">
                                            <div class="row">

                                                <div class="form-group col-md-4">
                                                    <label for="facility_name">Facilities</label>
                                                    <select name="facility_name[]" id="facility_name"
                                                        class="form-control">
                                                        <option>Select Facility</option>
                                                        <option value="Hospital"
                                                            {{ $item->facility_name == 'Hospital' ? 'selected' : ''  }}>
                                                            Hospital</option>
                                                        <option value="SuperMarket"
                                                            {{ $item->facility_name == 'SuperMarket' ? 'selected' : ''  }}>
                                                            Super Market</option>
                                                        <option value="School"
                                                            {{ $item->facility_name == 'School' ? 'selected' : ''  }}>
                                                            School</option>
                                                        <option value="Entertainment"
                                                            {{ $item->facility_name == 'Entertainment' ? 'selected' : ''  }}>
                                                            Entertainment</option>
                                                        <option value="Pharmacy"
                                                            {{ $item->facility_name == 'Pharmacy' ? 'selected' : ''  }}>
                                                            Pharmacy</option>
                                                        <option value="Airport"
                                                            {{ $item->facility_name == 'Airport' ? 'selected' : ''  }}>
                                                            Airport</option>
                                                        <option value="Railways"
                                                            {{ $item->facility_name == 'Railways' ? 'selected' : ''  }}>
                                                            Railways</option>
                                                        <option value="Bus Stop"
                                                            {{ $item->facility_name == 'Bus Stop' ? 'selected' : ''  }}>
                                                            Bus Stop</option>
                                                        <option value="Beach"
                                                            {{ $item->facility_name == 'Beach' ? 'selected' : ''  }}>
                                                            Beach</option>
                                                        <option value="Mall"
                                                            {{ $item->facility_name == 'Mall' ? 'selected' : ''  }}>Mall
                                                        </option>
                                                        <option value="Bank"
                                                            {{ $item->facility_name == 'Bank' ? 'selected' : ''  }}>Bank
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="distance">Distance</label>
                                                    <input type="text" name="distance[]" id="distance"
                                                        class="form-control" value="{{ $item->distance }}">
                                                </div>
                                                <div class="form-group col-md-4" style="padding-top: 20px">
                                                    <span class="btn btn-success btn-sm addeventmore"><i
                                                            class="fa fa-plus-circle">Add</i></span>
                                                    <span class="btn btn-danger btn-sm removeeventmore"><i
                                                            class="fa fa-minus-circle">Remove</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <br> <br>
                            <button type="submit" class="btn btn-primary">Save Changes </button>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--  ///End Facility Update //// -->
            
               <!--  /// Property Main Thambnail Image Update //// -->

<!--  /// Property Main Thambnail Image Update //// -->

<div class="page-content" style="margin-top: -35px;">

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Main Thambnail Image </h6>

                        <form action="{{ route('update.image') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" value="{{ $properties->id }}" name="property_id">

                            <input type="hidden" value="{{ $properties->property_name }}" name="property_name">


                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Main Thambnail </label>
                                    <input type="file" name="property_thambnail" class="form-control"
                                        onChange="mainThamUrl(this)">

                                    <img src="{{ asset($properties->property_thambnail) }}" width="80" height="80"
                                        id="mainThmb">

                                </div>
                            </div><!-- Col -->
                            <button type="submit" class="btn btn-primary"> Save Changes </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--    /// End  Property Main Thambnail Image Update //// -->


<div class="page-content" style="margin-top: -35px;">

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Multi Image </h6>
                        <form action="{{ route('update.multi.image') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" value="{{ $properties->id }}" name="property_id">
                            <input type="hidden" value="{{ $properties->property_name }}" name="property_name">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Change Image </th>
                                            <th>Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach($properties['multi_images'] as $img)
                                        <td>{{ ++$loop->index }}</td>
                                        <td class="py-1">
                                            <img src="{{ asset($img->photo_name) }}" alt="image"
                                                style="width:60px; height:60px;" id="multiImages{{ $img->id }}">
                                        </td>

                                        <td>
                                    <input type="file" class="form-control" name="multi_img[{{ $img->id }}]"  onChange="multiImage(this,{{ $img->id }})">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary px-4" value="Update Image">

                                            <a data-id="{{ $img->id }}"
                                                class="btn btn-inverse-danger delete-multi-image"> Delete </a>
                                        </td>
                                        </tr>
                                        {{-- <div class="row" id="preview_img"> </div> --}}

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </form>

                        <hr>
                      
                        <form action="{{ route('new.multi.image', $properties->id) }}" method="post"
                            enctype="multipart/form-data">
                           
                            @csrf
                            <input type="hidden" value="{{ $properties->id }}" name="property_id">
                            <input type="hidden" value="{{ $properties->name }}" name="property_name">

                            <table class="table">
                                <thead>
                                   <tr> <th> <h6 class="card-title text-white mt-4">Upload New Mult Image </h6></th> </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="file" name="new_multi_img[]" multiple="" class="form-control"
                                                id="multiImg">
                                        </td>

                                        <td>
                                            <input type="submit" class="btn btn-info px-4" value="Add Image">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" id="preview_new_img"> </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--  /// End Property Multi Image Update //// -->



<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="facility_name">Facilities</label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                            <option value="">Select Facility</option>
                            <option value="Hospital">Hospital</option>
                            <option value="SuperMarket">Super Market</option>
                            <option value="School">School</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Pharmacy">Pharmacy</option>
                            <option value="Airport">Airport</option>
                            <option value="Railways">Railways</option>
                            <option value="Bus Stop">Bus Stop</option>
                            <option value="Beach">Beach</option>
                            <option value="Mall">Mall</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance[]" id="distance" class="form-control"
                            placeholder="Distance (Km)">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i
                                class="fa fa-minus-circle">Remove</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----For Section-------->
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;
        $(document).on('click', '.addeventmore', function () {
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest('.add_item').append(whole_extra_item_add);
            counter++;
        });

        $(document).on('click', '.removeeventmore', function () {
            $(this).closest('#whole_extra_item_delete').remove();
            counter = -1;
        });

    });

</script>
<!--========== End of add multiple class with ajax ==============-->


<script type="text/javascript">
 $(document).ready(function () {
    $('#myForm').validate({
        rules: {
            property_name: {
                required: true,
            },
            property_status: {
                required: true,
            },
            lowest_price: {
                required: true,
            },
            max_price: {
                required: true,
            },
            ptype_id: {
                required: true,
            },
            bedrooms: {
                required: true,
            },
            bathrooms: {
                required: true,
            },
            garage: {
                required: true,
            },
            garage_size: {
                required: true,
            },
            address: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            postal_code: {
                required: true,
            },
            property_size: {
                required: true,
            },
            latitude: {
                required: true,
            },
            longitude: {
                required: true,
            },
            property_video: {
                required: true,
            },
            neighborhood: {
                required: true,
            },
            short_descp: {
                required: true,
            },
            long_descp: {
                required: true,
            },
        },
        messages: {
            property_name: {
                required: 'Please enter the property name',
            },
            property_status: {
                required: 'Please select the property status',
            },
            lowest_price: {
                required: 'Please enter the lowest price',
            },
            max_price: {
                required: 'Please enter the maximum price',
            },
            ptype_id: {
                required: 'Please select the property type',
            },
            bedrooms: {
                required: 'Please enter the number of bedrooms',
            },
            bathrooms: {
                required: 'Please enter the number of bathrooms',
            },
            garage: {
                required: 'Please enter the garage information',
            },
            garage_size: {
                required: 'Please enter the garage size',
            },
            address: {
                required: 'Please enter the property address',
            },
            city: {
                required: 'Please enter the city',
            },
            state: {
                required: 'Please enter the state',
            },
            postal_code: {
                required: 'Please enter the postal code',
            },
            property_size: {
                required: 'Please enter the property size',
            },
            latitude: {
                required: 'Please enter the latitude',
            },
            longitude: {
                required: 'Please enter the longitude',
            },
            property_video: {
                required: 'Please enter the property video information',
            },
            neighborhood: {
                required: 'Please enter the neighborhood information',
            },
            short_descp: {
                required: 'Please enter a short description',
            },
            long_descp: {
                required: 'Please enter a long description',
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-3').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});

</script>


<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function multiImage(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#multiImages'+id).attr('src', e.target.result).width(60).height(60);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /*     function newMultiThamUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                  $('.multiThmb' + id).attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        } */

</script>


<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                        .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_new_img').append(
                                img); //append image to output element
                                $('.prev_img').hide();
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });


    $(document).on('click', '.delete-multi-image', function (e) {
        e.preventDefault();
        var id_tag = $(this);
        var delete_id = $(this).data('id'); // Use data() method
        console.log(delete_id);

        // var url = "{{ url('/delete/each-multi-image') }}" + '/' + delete_id;

        var url = "{{ route('delete.each.multi.image', ['id' => ':id']) }}";
        url = url.replace(':id', delete_id);

        console.log(url);

        Swal.fire({
            title: 'Are you sure?',
            text: 'Delete This Data?',
            icon: 'warning',
            color: '#000000',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response.success,
                            color: '#000000',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        id_tag.parent().parent('tr').remove();
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

</script>

@endsection
