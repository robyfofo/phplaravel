<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit()
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);
    return view('profile.edit', [
      'profile' => $profile
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);
    $profile->name = $request->input('name');
    $profile->surname = $request->input('surname');
    $profile->save();
    return to_route('profile')->with('success', 'Profilo modificato!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function avatar()
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);
    return view('profile.avatar', [
      'profile' => $profile
    ]);
  }

  public function avatar_update(Request $request) 
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);

    if ($request->has('avatar')) {   
      if ($request->file('avatar')->isValid()) {
        $path = $request->file('avatar')->path();    
        $avatar = file_get_contents($path);
        $base64 = base64_encode($avatar);
        $profile->avatar = $base64;
        
        // preleva le info file
        $avatarinfo = array(
          'clientOriginalName'=> $request->file('avatar')->getClientOriginalName(),
          'ClientOriginalExtension' => $request->file('avatar')->getClientOriginalExtension(),
          'size' => $request->file('avatar')->getSize(),
          'mimeType' => $request->file('avatar')->getMimeType()
        );
        $profile->avatar_info = serialize($avatarinfo);      
      } 
    }

    // cancella se selezionato
    if ($request->has('deleteavatar')) {

      $profile->avatar = '';
      $profile->avatar_info = '';
    }

    $profile->save();
    return to_route('profile.avatar')->with('success', 'Avatar modificato!');
  }

  public function password()
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);
    return view('profile.password', [
      'profile' => $profile
    ]);
  }

  public function password_update(profileRequest $request)
  {
    $id = auth()->user()->id;
    $profile = Profile::findOrFail($id);

    $passwordold = $request->input('passwordold');
    $passwordnew = $request->input('passwordnew');
    $passwordck = $request->input('passwordck');

    if ($passwordnew !== $passwordck) {
      return to_route('profile.password')->with('error', 'Le due password non corrispondono!');
    }

    if (Hash::check($passwordold,  $profile->password)) {
      $request->user()->fill(['password' => Hash::make($passwordnew)])->save();
      return to_route('profile.password')->with('success', 'Password modificate!');
    } else {
      return to_route('profile.password')->with('error', 'La vecchia password non corrisponde!');
    }

    return to_route('profile.password')->with('error', 'Password NON modificata!');
  }
}
