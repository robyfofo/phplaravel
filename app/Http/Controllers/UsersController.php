<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UserRequest;


class UsersController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';

    
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('users itemsforpage')) $request->session()->put('users itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('users itemsforpage', request()->input('itemsforpage'));

    // paginazione
    if ($request->session()->missing('users page')) $request->session()->put('users page', 1);
    if (request()->input('page')) $request->session()->put('users page', request()->input('page'));

    if ($request->session()->has('users itemsforpage')) $this->itemsforpage = $request->session()->get('users itemsforpage');
    if ($request->session()->has('users page')) $this->page = $request->session()->get('users page');

    // ricerca 
    if ($request->session()->missing('projeks searchFromTable')) $request->session()->put('projeks searchFromTable', '');
    if (request()->input('searchFromTable')) {
      $request->session()->put('projeks searchFromTable', request()->input('searchFromTable'));
    } else {
      $request->session()->put('projeks searchFromTable', '');
    }
    if ($request->session()->has('projeks searchFromTable')) $this->searchFromTable = $request->session()->get('projeks searchFromTable');

    $where = array();
    $fieldsSearch = array('title', 'content');
    if ($this->searchFromTable != '') {
      $words = explode(',', $this->searchFromTable);
      if (count($fieldsSearch) > 0) {
        foreach ($fieldsSearch as $key => $value) {
          if (count($words) > 0) {
            foreach ($words as $value1) {
              $where[] = array($value, 'LIKE', '%' . $value1 . '%');
            }
          }
        }
      }
    }

    $appJavascriptLinks = array('<script src="js/modules/users.index.20230612.js"></script>');

    $users = User::orderBy('id', $this->orderType)
      ->where($where)
      ->paginate($this->itemsforpage);

    return view('users.index', ['users' => $users])
    ->with('itemsforpage', $this->itemsforpage)
    ->with('searchFromTable', $this->searchFromTable)
    ->with('orderType', $this->orderType)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $user = new User;
    return view('users.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $user = new User;
    $user->name = $request->input('name');
    $user->surname = $request->input('surname');
    $user->email = $request->input('email');
    
    $user->password = '';

    // avatar
    if ($request->has('avatar')) {   
      if ($request->file('avatar')->isValid()) {
        $path = $request->file('avatar')->path();    
        $avatar = file_get_contents($path);
        $base64 = base64_encode($avatar);
        $user->avatar = $base64;
        
        // preleva le info file
        $avatarinfo = array(
          'clientOriginalName'=> $request->file('avatar')->getClientOriginalName(),
          'ClientOriginalExtension' => $request->file('avatar')->getClientOriginalExtension(),
          'size' => $request->file('avatar')->getSize(),
          'mimeType' => $request->file('avatar')->getMimeType()
        );

        // controllo dimensioni
        if ($avatarinfo['size'] > 65000) return to_route('users.index')->with('error', "Le dimensioni dell'immagine superano gli 65000 byte!");


        $user->avatar_info = serialize($avatarinfo);      
      } 
    }

    // cancella se selezionato
    if ($request->has('deleteavatar')) {
      $user->avatar = '';
      $user->avatar_info = '';
    }
    // fine avatar

    $user->save();
    return to_route('users.index')->with('success', 'Utente inserito!');
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
    public function edit(string $id)
    {
      $user = User::findOrFail($id);
      return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
      $user = User::findOrFail($id);
      $user->name = $request->input('name');
      $user->surname = $request->input('surname');
      $user->email = $request->input('email');

      // avatar
      if ($request->has('avatar')) {   
        if ($request->file('avatar')->isValid()) {
          $path = $request->file('avatar')->path();    
          $avatar = file_get_contents($path);
          $base64 = base64_encode($avatar);
          $user->avatar = $base64;
          
          // preleva le info file
          $avatarinfo = array(
            'clientOriginalName'=> $request->file('avatar')->getClientOriginalName(),
            'ClientOriginalExtension' => $request->file('avatar')->getClientOriginalExtension(),
            'size' => $request->file('avatar')->getSize(),
            'mimeType' => $request->file('avatar')->getMimeType()
          );
          // controllo dimensioni
          if ($avatarinfo['size'] > 65000) return to_route('users.index')->with('error', "Le dimensioni dell'immagine superano gli 65000 byte!");
          $user->avatar_info = serialize($avatarinfo);      
        } 
      }
  
      // cancella se selezionato
      if ($request->has('deleteavatar')) {
        $user->avatar = '';
        $user->avatar_info = '';
      }
      // fine avatar
      $user->save();

    return to_route('users.index')->with('success', 'Utente modificato!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
