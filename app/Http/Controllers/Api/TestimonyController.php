<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonyRequest;
use App\Http\Requests\UpdateTestimonyRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\Testimony;
use Illuminate\Support\Facades\DB;

class TestimonyController extends Controller
{
    use StorageHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonies = Testimony::orderBy('created_at')->get();

        return Response::ok($testimonies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTestimonyRequest $request
     */
    public function store(StoreTestimonyRequest $request)
    {
        $inputPictureFilename = $this->storeProfilePicture($request->file('picture'));

        $testimony = Testimony::create([
            'name' => $request->name,
            'testimony' => $request->testimony,
            'picture' => $inputPictureFilename,
        ]);

        return Response::created($testimony);
    }

    /**
     * Display the specified resource.
     *
     * @param Testimony $testimony
     */
    public function show(Testimony $testimony)
    {
        return Response::ok($testimony);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTestimonyRequest $request
     * @param Testimony $testimony
     */
    public function update(UpdateTestimonyRequest $request, Testimony $testimony)
    {
        $oldPicture = $testimony->picture;

        $inputData = $this->assertDataForUpdate($request);

        if (!$testimony->update($inputData)) {
            $this->deleteProfilePicture($inputData['picture']);
        }

        if ($request->hasFile('picture')) {
            $this->deleteProfilePicture($oldPicture);
        }

        return Response::ok($testimony);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Testimony $testimony
     */
    public function destroy(Testimony $testimony)
    {
        if ($testimony->delete()) {
            $this->deleteProfilePicture($testimony->picture);
        }

        return Response::ok($testimony);
    }

    /**
     * Display a listing of 3 random resources.
     */
    public function home()
    {
        $newestTestimonies = Testimony::inRandomOrder()->limit(3)->get();

        return Response::ok($newestTestimonies);
    }

    /**
     * 
     */
    private function assertDataForUpdate(UpdateTestimonyRequest $request): array
    {
        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('testimony')) {
            $data['testimony'] = $request->testimony;
        }

        if ($request->hasFile('picture')) {
            $data['picture'] = $this->storeProfilePicture($request->file('picture'));
        }

        return $data;
    }
}
