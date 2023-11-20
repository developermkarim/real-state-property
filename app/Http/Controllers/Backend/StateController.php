<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Http\Requests\StateRequest;
use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;

class StateController extends Controller
{
    public function allState()
    {
        $state = State::all();
        return view('backend.state.all_state', compact('state'));
    }

    public function addState()
    {
       return view('backend.state.add_state');
    }

    public function storeState(Request $request)
    {
            $stateImage = ImageHelper::uploadAndOptimizeImage($request,$request->state_name,'state_image','upload/state',null);

        $state = State::create([
            'state_name' => $request->state_name,
            'state_image' => $stateImage['image'],
        ]);

        $state->save();
     //   dd($state);

        $nottification = array('message' => 'State Saved Successfully','alert-type'=>"success");
        return redirect('all/state')->with($nottification);
    }

    public function editState($id)
    {
        $state = State::find($id);
        return view('backend.state.edit_state', compact('state'));
    }

    public function updateState(Request $request)
    {
        $state = State::findOrFail($request->id);
        $stateImage = ImageHelper::uploadAndOptimizeImage($request,$request->state_name,'state_image','upload/state',$state->state_image);

        
        State::findOrFail($request->id)->update([
            'state_name' => $request->state_name,
            'state_image' => $stateImage['image'],
        ]);

        $nottification = array('message' => 'State Updated Successfully','alert-type'=>"info");
        return redirect('all/state')->with($nottification);

    }

    public function deleteState($id)
    {
        $state = State::findOrFail($id);
        $stateImage = ImageHelper::DeleteImage('upload/state',$state->state_image);

        $state->delete();

        $nottification = array('message' => 'State Deleted Successfully','alert-type'=>"success");

        return redirect()->back()->with($nottification);

    }

    private function uploadAndOptimizeImage2($imageFile, $storagePath, $resizeWidth = 300, $resizeHeight = 200)
    {
        // Generate a unique filename
        $filename = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        // Optimize the stored image
        $img = Image::make($imageFile);
        $img->fit($resizeWidth, $resizeHeight);
        $optimizedImage = $img->stream();

        // Store the optimized image in the specified storage path
        $fullImagePath = "{$storagePath}/{$filename}";
        Storage::put($fullImagePath, $optimizedImage->__toString());

        // Return the full path to the stored image
        return $filename;
    }
}
