<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinyRequest;
use App\Http\Requests\UpdateDestinyRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\Destiny;
use App\Services\OpenAIService;
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
    public function store(StoreDestinyRequest $request, OpenAIService $openai)
    {
        $filename_1 = $this->storeDestinyPhoto($request->file('photo_1'));
        $filename_2 = $request->hasFile('photo_2') ? $this->storeDestinyPhoto($request->file('photo_2')) : null;

        $description = $request->description ?? $openai->createDestinyDescription($request->name);

        $destiny = Destiny::create([
            'name' => $request->name,
            'price' => Price::USD($request->price),
            'photo_1' => $filename_1,
            'photo_2' => $filename_2,
            'meta' => $request->meta,
            'description' => $description,
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
        $oldPhoto1 = $destiny->photo_1;
        $oldPhoto2 = $destiny->photo_2 ?? null;

        $inputData = $this->assertDataForUpdate($request);

        if (!$destiny->update($inputData)) {
            $this->deleteDestinyPhoto($inputData['photo_1']);
            if ($inputData['photo_2']) {
                $this->deleteDestinyPhoto($inputData['photo_2']);
            }

            Response::badRequest();
        }

        if ($request->hasFile('photo_1')) {
            $this->deleteDestinyPhoto($oldPhoto1);
        }

        if ($request->hasFile('photo_2') and $oldPhoto2) {
            $this->deleteDestinyPhoto($oldPhoto2);
        }

        return Response::ok($destiny, 'resource updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destiny $destiny)
    {
        if ($destiny->delete()) {
            $this->deleteDestinyPhoto($destiny->photo_1);
            if ($destiny->photo_2) {
                $this->deleteDestinyPhoto($destiny->photo_2);
            }
        }

        return Response::ok($destiny, 'resource deleted');
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

        if ($request->hasFile('photo_1')) {
            $data['photo_1'] = $this->storeDestinyPhoto($request->file('photo_1'));
        }

        if ($request->hasFile('photo_2')) {
            $data['photo_2'] = $this->storeDestinyPhoto($request->file('photo_2'));
        }

        if ($request->filled('meta')) {
            $data['meta'] = $request->meta;
        }

        if ($request->filled('description')) {
            $data['description'] = $request->description;
        }

        return $data;
    }
}
