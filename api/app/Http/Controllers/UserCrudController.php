<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrudUserRequest;
use App\Models\UserCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stacCrud = UserCrud::get();
        return response()->json($stacCrud);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrudUserRequest $request)
    {

        $imageUrl = null;
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(storage_path('app/public/uploads'), $imageName);
            $imageUrl = asset('storage/uploads/' . $imageName);
        }
        $user = UserCrud::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'name' => $request->name,
                'image' =>  $imageUrl,
        ]);

      return  response()->json(['success' => 'successfully Added',$user]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $user = UserCrud::FindOrFail($id);
        return response()->json($user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserCrud $userCrud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CrudUserRequest $request, $id)
    {
        // Find the user by ID or throw a 404 error if not found
        $user = UserCrud::findOrFail($id);
        $imageUrl = null;
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(storage_path('app/public/uploads'), $imageName);
            $imageUrl = asset('storage/uploads/' . $imageName);
        }
        // Update user details
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->image = $imageUrl;

    
        // Save the updated user
        $user->save();
    
        // Return success response
        return response()->json(['success' => 'Successfully updated', 'user' => $user]);
    }
    
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = UserCrud::FindOrFail($id);
        $user->delete();
    }
}
