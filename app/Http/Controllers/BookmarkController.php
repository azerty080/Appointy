<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Bookmark;

class BookmarkController extends Controller
{
    public function bookmarks(Request $request)
    {
        if ($request->session()->get('user_type') == 'klant') {
            $client_id = $request->session()->get('user_data')->id;

            $bookmarks = Bookmark::with('business.user')->where('client_id', $client_id)->get();
        } else {
            return redirect('/');
        }
        
        return view('bookmark.index', compact('bookmarks'));
    }





    public function addbookmark(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $bookmark = new Bookmark();

        $bookmark->business_id = $request->business_id;
        $bookmark->client_id = $request->session()->get('user_data')->id;

        $bookmark->save();

        return redirect()->back()->with(compact('id', 'name'));
    }


    
    public function removebookmark(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $bookmark = Bookmark::where('business_id', $request->business_id)->where('client_id', $request->session()->get('user_data')->id);

        $bookmark->delete();
        
        return redirect()->back()->with(compact('id', 'name'));
    }
}
