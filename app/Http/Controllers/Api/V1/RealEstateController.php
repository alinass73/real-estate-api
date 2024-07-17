<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstateStoreRequest;
use App\Http\Requests\RealEstateUpdateRequest;
use App\Http\Resources\RealEstateResource;
use App\Models\Image;
use App\Models\RealEstate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class RealEstateController extends Controller
{
    //
    
    // public function store(RealEstateStoreRequest $request)
    public function storee(Request $request)
    {
        $request->validate([
            'floor'=>'required'
        ]);
        $real_estate=RealEstate::create([
            'price'=>$request->price,
            'category'=>$request->category,
            'address'=>$request->address,
            'bedroom'=>$request->bedroom,
            'bathroom'=>$request->bathroom,
            'area'=>$request->area,
            'floor'=>$request->floor,
            'parking'=>$request->parking,
        ]);
        // return $request->hasFile('images');
        // return $request->all();
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            // return $images->get();
            $im=0;

            foreach ($images as $image) {
                $im=$im+1;
                $file_name= $request->file('images')->hashName();
                $imag[$im]=
                $real_estate->images()->create([
                    'path'=>$image->file('images')->storeAs('public/tasks/'.$real_estate->id,$file_name),
                ]);
                // $imageModel->path = $image->store('images', 'public');
                // $imageModel->real_estate_id = 5;
                // $imageModel->save();
                // $im=$im+1;
            }
            // return $;
        }
        return new RealEstateResource($real_estate);
    }
    
    public function store(RealEstateStoreRequest $request)
    {
        $request->validate([
            'floor' => 'required',
            'images' => 'required|array', // Validate that 'images' is an array
            'images.*' => 'image|mimes:jpeg,png|max:2048', // Validate each image file
        ]);

        $real_estate = RealEstate::create([
            'price' => $request->price,
            'category' => $request->category,
            'address' => $request->address,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'area' => $request->area,
            'floor' => $request->floor,
            'parking' => $request->parking,
        ]);

        foreach ($request->file('images') as $image) {
            $file_name = $image->hashName();
            $uploaded = $image->storeAs('public/realEstate/' . $real_estate->id, $file_name);
            if ($uploaded) {
                $real_estate->images()->create([
                    'path' => $uploaded,
                ]);
            }
        }

        return new RealEstateResource($real_estate);
    }



    public function show(RealEstate $real_estate)
    {
        return new RealEstateResource($real_estate);
    }
    
    public function update(RealEstateUpdateRequest $request,RealEstate $real_estate)
    {
        $request->validated();
        $real_estate->update($request->all());
        return new RealEstateResource($real_estate);
    }

    public function destroy(RealEstate $real_estate)
    {
        if($real_estate->delete())
            return response()->json(['message'=>'deleted']);
    }

    public function index()
    {
        $real_estate=RealEstate::paginate();
        return RealEstateResource::collection($real_estate);
    }
    
}
