<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use SweetAlert;
use Mail;
use Alert;
use Log;
use Carbon\Carbon;

use App\Models\About;

class AboutController extends Controller
{
    //

    public function addAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'about' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->message()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->about)));
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = 'uploads/about/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads/about', $imageUrl);
        }

        $newAbout = [
            'image' => $imageUrl,
            'about' => $request->about,
        ];

        if (About::create($newAbout)) {
            alert()->success('Changes Saved', 'About added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function editAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_id' => 'required',
            'about' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $about = About::find($request->about_id);

        if (!empty($request->about)) {
            $about->about = $request->about;
        }

        if ($request->hasFile('image')) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->about)));
            $imageUrl = 'uploads/about/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads/about', $imageUrl);
            $about->image = $imageUrl;
        }

        if ($about->save()) {
            alert()->success('Changes Saved', 'About changes saved successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deleteAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_id' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if (!$about = About::find($request->about_id)) {
            alert()->error('Oops', 'Invalid About Information')->persistent('Close');
            return redirect()->back();
        }

        if ($about->delete()) {
            alert()->success('Changes Saved', 'About deleted successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }
}
