<?php

namespace App\Http\Controllers;

use Request;


use App\Models\Link;

class LinksController extends Controller
{



  public function ListLinks($id) {
    $links = Link::where(['artist_id' => $id])->pluck('link');
    return view('links')
    ->with('links',$links)
    ->with('artist_id',$id);
  }

  public function newLink() {
      if (Auth::user()->admin==true){
      $newlink = Request::get('newlink', '');
      $artist_id = Request::get('artist_id', 0);
      //  Store data in database
            if (!empty($newlink)){
            Link::create([
              'artist_id' => $artist_id,
              'link' => $newlink
            ]);

            return back()->with('success', 'You have successfully added a new link');
          }

        }else{
          return "Not allowed";
        }
      //

  }

}
