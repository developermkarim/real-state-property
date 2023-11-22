<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\PropertyType;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.all_property',compact('property'));

    } // End Method

    public function AddProperty()
    {
        $propertytype = PropertyType::latest()->get();
        $activeAgent = User::where(['status'=>'active'])->where('role','agent')->latest()->get();
        $states = State::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('backend.property.add_property',compact('activeAgent','propertytype','states','amenities'));

    } // End Method


    public function StoreProperty(Request $request)
    {

       $amenities = implode(",", $request->amenities_id);

       $pcode = IdGenerator::generate(['table'=>'properties','field'=>'property_code','length'=>5,'prefix'=>'PC']);

       /* Save Url Of Image Path */
        $propertImage = ImageHelper::uploadAndOptimizeImage($request,$request->property_name,'property_name','upload/property/thambnail',null);

        $save_url = $propertImage['path'];

       $property_id = Property::insertGetId([

        'ptype_id' => $request->ptype_id,
        'amenities_id' => $amenities,
        'property_name' => $request->property_name,
        'property_slug' => strtolower(str_replace([' ','_','.'], '-', $request->property_name)),
        'property_code' => $pcode,
        'property_status' => $request->property_status,
        'lowest_price' => $request->lowest_price,
        'max_price' => $request->max_price,
        'short_descp' => $request->short_descp,
        'long_descp' => $request->long_descp,
        'bedrooms' => $request->bedrooms,
        'bathrooms' => $request->bathrooms,
        'garage' => $request->garage,
        'garage_size' => $request->garage_size,
        'property_size' => $request->property_size,
        'property_video' => $request->property_video,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'postal_code' => $request->postal_code,
        'neighborhood' => $request->neighborhood,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'featured' => $request->featured,
        'hot' => $request->hot,
        'agent_id' => $request->agent_id,
        'status' => 1,
        'property_thambnail' => $save_url,
        'created_at' => Carbon::now(),
       ]);

       $facilities_count = count($request->facility_name);
       $isFacility = false;
       $isMultiImage = false;
       // property_id	facility_name	distance	created_at	updated_at
      //  dd($request->distance);
       for ($i=0; $i < $facilities_count; $i++) {
        Facility::create([
            'property_id' => $property_id,
            'facility_name' => $request->facility_name[$i],
            'distance' => $request->distance[$i],
            'created_at' => Carbon::now(),
        ]);

        $isFacility = true;
       }

       foreach ($request->multi_img as $key => $image) {

        $main_image = strtolower(str_replace([' ','.','_'],'-',$request->property_name)) . '-' . now()->format('his') . $key . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(370,250)->save('upload/property/multi-image/' . $main_image);

        $multi_images_url = 'upload/property/multi-image/' . $main_image;

         MultiImage::create([
            'property_id' => $property_id,
            'photo_name' => $multi_images_url,
            'created_at' => Carbon::now(),
        ]);

        $isMultiImage = true;
       } // end foreach loop

       if ($isFacility == TRUE && $isMultiImage == true) {
         $nottification = [
            'message' => "New Property Added Successfully",
            'alert-type' => 'success'
         ];
       }

       return redirect('all/property')->with($nottification);
       // 	property_id	photo_name	created_at	updated_at

    } // end Methods

    public function EditProperty($id)
    {
        $properties = Property::find($id);
        $propertytype = PropertyType::latest()->get();
        $activeAgent = User::where(['status'=>'active'])->where('role','agent')->latest()->get();
        $states = State::latest()->get();
        $amenities = Amenities::latest()->get();
        $multi_images = MultiImage::where('property_id',$id)->get();
        $facilities = Facility::where('property_id',$properties->id)->select('facility_name','property_id','id')->get();

        // dd($facilities);

        return view('backend.property.edit_property',compact('properties','activeAgent','propertytype','states','amenities','multi_images','facilities'));
    }


    public function UpdateImage(Request $request)
    {
        $propertImage = Property::findOrFail($request->property_id);

        $storeImage = ImageHelper::uploadAndOptimizeImage($request,$request->property_name,'property_thambnail','upload/property/thambnail',$propertImage->property_thambnail);

        $isUpdatedImage = Property::where('id',$request->property_id)->update([
            'property_thambnail'=> $storeImage['path'],
        ]);
        if($isUpdatedImage){

            $nottification = [
                'message' => "New Property Added Successfully",
                'alert-type' => 'success'
             ];

           }

           return redirect()->back()->with($nottification);
    }

    public function UpdateMultiImage(Request $request)
    {
        $multi_images = $request->multi_img;
        if(!$request->hasFile('multi_img')){
            $nottification = [
                'message' => "Image Can't be Empty",
                'alert-type' => 'warning'
             ];

             return redirect()->back()->with($nottification);

           }else {

        foreach ($multi_images as $key_id => $image) {

            $each_multi_image = MultiImage::findOrFail($key_id);

            if (file_exists(public_path($each_multi_image->photo_name))) {
                @unlink(public_path($each_multi_image->photo_name));
            }

            $file_extenion = strtolower($image->extension());
            $filename = strtolower(str_replace([' ','_','.'],'-',$request->property_name)) . '-' . now()->format('his') . $key_id . '.' . $file_extenion;

            Image::make($image)->resize(750,520)->save(public_path('upload/property/multi-image/' . $filename));
            $fileStorage = 'upload/property/multi-image/' . $filename;
            $isUpdatedImage = MultiImage::where('id',$key_id)->update([
                'photo_name'=> $fileStorage,
            ]);
            if($isUpdatedImage){

                $nottification = [
                    'message' => "New Property Added Successfully",
                    'alert-type' => 'success'
                 ];

               }

        }


    }

        return redirect()->back()->with($nottification);

    }

}
