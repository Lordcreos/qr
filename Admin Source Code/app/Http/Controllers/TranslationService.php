<?php

namespace App\Http\Controllers;

use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TranslationService extends Controller
{
  public function language_switcher(Request $request){


      request()->validate([
          'selected_language'=>'required',
      ]);
      Session::put('selected_language', $request->selected_language) ;

      return back();


  }

  public function languages(){
 return Translation::all()->where("is_active", "=", 1);
  }

  public function selected_language(){
      if(Session::has('selected_language'))
         return Translation::find(Session::get('selected_language'));
      else
          return Translation::all()->where("is_default", "=", 1)->first();
  }
    public function selected_language_api($language_id){

        if($language_id != NULL)
            return Translation::find($language_id);
        else
            return Translation::all()->where("is_default", "=", 1)->first();

    }
}
