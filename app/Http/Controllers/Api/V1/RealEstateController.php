<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstateStoreRequest;
use App\Http\Requests\RealEstateUpdateRequest;
use App\Http\Resources\RealEstateResource;
use App\Models\RealEstate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class RealEstateController extends Controller
{
    //
    
    public function store(RealEstateStoreRequest $request)
    {
        $request->validated();
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
