<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    // Public: List advertisements with filters and pagination
    public function index(Request $request)
    {
        $query = Advertisement::where('status', 'published')->with(['user', 'category', 'subject', 'location']);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->has('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->has('country')) {
            $query->where('country', $request->country);
        }
        if ($request->has('city')) {
            $query->where('city', $request->city);
        }
        if ($request->has('teaching_mode')) {
            $query->where('teaching_mode', $request->teaching_mode);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'lowest_fee') {
            $query->orderBy('fee_min', 'asc');
        } elseif ($sort === 'highest_fee') {
            $query->orderBy('fee_min', 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // default newest
        }

        return response()->json($query->paginate(20));
    }

    // Public: Get advertisement by slug
    public function show($slug)
    {
        $ad = Advertisement::where('slug', $slug)
            ->where('status', 'published')
            ->with(['user', 'category', 'subject', 'location'])
            ->firstOrFail();

        return response()->json($ad);
    }

    // Protected: Get current user's advertisements
    public function myAds(Request $request)
    {
        $ads = Advertisement::where('user_id', $request->user()->id)
            ->with(['category', 'subject', 'location'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($ads);
    }

    // Protected: Create new advertisement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:tutor,lsa,student_requirement',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'location_id' => 'nullable|exists:locations,id',
            'education_level' => 'nullable|string',
            'qualification' => 'nullable|string',
            'experience' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'area' => 'nullable|string',
            'address' => 'nullable|string',
            'teaching_mode' => 'nullable|string',
            'availability' => 'nullable|string',
            'preferred_days' => 'nullable|array',
            'fee_min' => 'nullable|numeric',
            'fee_max' => 'nullable|numeric',
            'fee_type' => 'nullable|string',
            'requirements' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['status'] = 'draft'; // or pending_review depending on logic

        $ad = Advertisement::create($validated);

        return response()->json($ad, 201);
    }

    // Protected: Update an advertisement
    public function update(Request $request, $id)
    {
        $ad = Advertisement::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:tutor,lsa,student_requirement',
            'description' => 'sometimes|string',
            'category_id' => 'nullable|exists:categories,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'location_id' => 'nullable|exists:locations,id',
            'education_level' => 'nullable|string',
            'qualification' => 'nullable|string',
            'experience' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'area' => 'nullable|string',
            'address' => 'nullable|string',
            'teaching_mode' => 'nullable|string',
            'availability' => 'nullable|string',
            'preferred_days' => 'nullable|array',
            'fee_min' => 'nullable|numeric',
            'fee_max' => 'nullable|numeric',
            'fee_type' => 'nullable|string',
            'requirements' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
        ]);

        if (isset($validated['title']) && $validated['title'] !== $ad->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        // Return to pending review if published and edited (based on business rules)
        if ($ad->status === 'published') {
            $validated['status'] = 'pending_review';
        }

        $ad->update($validated);

        return response()->json($ad);
    }

    // Protected: Delete an advertisement
    public function destroy(Request $request, $id)
    {
        $ad = Advertisement::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $ad->delete();

        return response()->json(['message' => 'Advertisement deleted successfully.']);
    }
}
