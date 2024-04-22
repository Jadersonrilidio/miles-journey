<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinyRequest;
use App\Http\Requests\UpdateDestinyRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\Destiny;
use App\ValueObjects\Price;
use Illuminate\Http\Request;

class DestinyController extends Controller
{
    use StorageHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locationName = $request->input('name');

        $destinies = Destiny::orderBy('created_at')
            ->when($locationName, function ($query, string $locationName) {
                $query->where('name', 'like', "%$locationName%");
            })
            ->get();

        return Response::ok($destinies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinyRequest $request)
    {
        $filename = $this->storeDestinyPhoto($request->file('photo'));

        $destiny = Destiny::create([
            'name' => $request->name,
            'price' => Price::USD($request->price),
            'photo' => $filename,
        ]);

        return Response::created($destiny);
    }

    /**
     * Display the specified resource.
     */
    public function show(Destiny $destiny)
    {
        return Response::ok($destiny);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinyRequest $request, Destiny $destiny)
    {
        $oldPhoto = $destiny->photo;

        $inputData = $this->assertDataForUpdate($request);

        if (!$destiny->update($inputData)) {
            $this->deleteDestinyPhoto($inputData['photo']);
        }

        if ($request->hasFile('photo')) {
            $this->deleteDestinyPhoto($oldPhoto);
        }

        return Response::ok($destiny, 'resource updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destiny $destiny)
    {
        if ($destiny->delete()) {
            $this->deleteDestinyPhoto($destiny->photo);
        }

        return Response::ok($destiny, 'resrouce deleted');
    }

    /**
     * 
     */
    private function assertDataForUpdate(UpdateDestinyRequest $request): array
    {
        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('price')) {
            $data['price'] = Price::USD($request->price);
        }

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storeDestinyPhoto($request->file('photo'));
        }

        return $data;
    }
}
