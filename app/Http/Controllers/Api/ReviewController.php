<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\Review;

class ReviewController extends Controller
{
    use StorageHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::orderBy('created_at')->get();

        return Response::ok($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     */
    public function store(StoreReviewRequest $request)
    {
        $filename = $this->storeProfilePicture($request->file('picture'));

        $review = Review::create([
            'name' => $request->name,
            'review' => $request->review,
            'picture' => $filename,
        ]);

        return Response::created($review);
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     */
    public function show(Review $review)
    {
        return Response::ok($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReviewRequest $request
     * @param Review $review
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $oldPicture = $review->picture;

        $inputData = $this->assertDataForUpdate($request);

        if (!$review->update($inputData)) {
            $this->deleteProfilePicture($inputData['picture']);
        }

        if ($request->hasFile('picture')) {
            $this->deleteProfilePicture($oldPicture);
        }

        return Response::ok($review, 'resource updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     */
    public function destroy(Review $review)
    {
        if ($review->delete()) {
            $this->deleteProfilePicture($review->picture);
        }

        return Response::ok($review, 'resource deleted');
    }

    /**
     * Display a listing of 3 random resources.
     */
    public function home()
    {
        $newestReviews = Review::inRandomOrder()->limit(3)->get();

        return Response::ok($newestReviews);
    }

    /**
     * 
     */
    private function assertDataForUpdate(UpdateReviewRequest $request): array
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
