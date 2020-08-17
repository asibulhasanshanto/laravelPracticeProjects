<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function create($albumId)
    {
        return view('photos.create')->with('albumId',$albumId);

    }
    public function store(Request $request)
    {
        //validating requrest
        $this->validate($request,[
            'title'=> 'required',
            'description'=> 'required',
            'photo'=>'required|image'
        ]);

        //extracting file info from request
        $filenameWithExtension = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameToStore = $filename. '_'.time() . '.' . $extension;

        //storing image file
        $request->file('photo')->storeAs('public/albums/'.$request->input('album-id'),$filenameToStore);

        //storing album info
        $photo = new Photo();
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameToStore;
        $photo->size = $request->file('photo')->getSize();
        $photo->album_id = $request->input('album-id');
        $photo->save();

        return redirect('/albums/'.$request->input('album-id'))->with('success', 'photo uploaded successfully!');
    }
    public function show($id)
    {
        $photo = Photo::find($id);
        return view('photos.show')->with('photo',$photo);
    }
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if(Storage::delete('public/albums/'.$photo->album_id.'/'.$photo->photo))
        {
            $photo->delete();

            return redirect('/')->with('success','Photo deleted successfully!');
        }
    }
}
