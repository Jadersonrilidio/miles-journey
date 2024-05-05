<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\Destination;
use App\Services\OpenAIService;
use App\ValueObjects\Price;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    use StorageHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $location = $request->query('name');

        $destinations = Destination::whenLocation($location)->get();

        return Response::ok($destinations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request, OpenAIService $openai)
    {
        $filename_1 = $this->storeDestinationPhoto($request->file('photo_1'));
        $filename_2 = $request->hasFile('photo_2') ? $this->storeDestinationPhoto($request->file('photo_2')) : null;

        $description = $request->description ?? $openai->createDestinationDescription($request->name);

        $destination = Destination::create([
            'name' => $request->name,
            'price' => Price::USD($request->price),
            'photo_1' => $filename_1,
            'photo_2' => $filename_2,
            'meta' => $request->meta,
            'description' => $description,
        ]);

        return Response::created($destination);
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return Response::ok($destination);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $oldPhoto1 = $destination->photo_1;
        $oldPhoto2 = $destination->photo_2 ?? null;

        $inputData = $this->assertDataForUpdate($request);

        if (!$destination->update($inputData)) {
            $this->deleteDestinationPhoto($inputData['photo_1']);
            if ($inputData['photo_2']) {
                $this->deleteDestinationPhoto($inputData['photo_2']);
            }

            Response::badRequest();
        }

        if ($request->hasFile('photo_1')) {
            $this->deleteDestinationPhoto($oldPhoto1);
        }

        if ($request->hasFile('photo_2') and $oldPhoto2) {
            $this->deleteDestinationPhoto($oldPhoto2);
        }

        return Response::ok($destination, 'resource updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        if ($destination->delete()) {
            $this->deleteDestinationPhoto($destination->photo_1);
            if ($destination->photo_2) {
                $this->deleteDestinationPhoto($destination->photo_2);
            }
        }

        return Response::ok($destination, 'resource deleted');
    }

    /**
     * 
     */
    private function assertDataForUpdate(UpdateDestinationRequest $request): array
    {
        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('price')) {
            $data['price'] = Price::USD($request->price);
        }

        if ($request->hasFile('photo_1')) {
            $data['photo_1'] = $this->storeDestinationPhoto($request->file('photo_1'));
        }

        if ($request->hasFile('photo_2')) {
            $data['photo_2'] = $this->storeDestinationPhoto($request->file('photo_2'));
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
