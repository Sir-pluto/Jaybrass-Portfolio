<!-- 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class templateController extends Controller
{
    //
}





namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use App\Models\SiteInfo as Setting;
use App\Models\Social;
use App\Models\Admin;
use App\Models\About;
use App\Models\ContactInfo;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Skill;
use App\Models\Counter;
use App\Models\Certificate;
use App\Models\Service;
use App\Models\BlogPost;


use SweetAlert;
use Alert;
use Log;
use Carbon\Carbon;

class BlogController extends Controller
{
    //

    public function post()
    {
        $post = BlogPost::get();
        return view('admin.post', [
            'post' => $post
        ]);
    }

    public function allPosts()
    {
        $posts = BlogPost::all();
        return view('admin.allPosts', [
            'posts' => $posts
        ]);
    }

    public function viewPost($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        return view('viewPost', [
            'post' => $post,
        ]);
    }

    public function addPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        if ($request->hasFile('image')) {
            $imagePath = cloudinary()->uploadFile($request->file('image')->getRealPath())->getSecurePath();
        }

        $newBlogPost = [
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
        ];

        if (BlogPost::create($newBlogPost)) {
            alert()->success('Changes Saved', 'Blog post added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deletePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if (!$blogPost = Project::find($request->post_id)) {
            alert()->error('Oops', 'Invalid Project')->persistent('Close');
            return redirect()->back();
        }

        if ($blogPost->delete()) {
            alert()->success('Changes Saved', 'Blog post deleted successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function editPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if (!$blogPost = BlogPost::find($request->post_id)) {
            alert()->error('Oops', 'Invalid Blog Post Information')->persistent('Close');
            return redirect()->back();
        }

        if (!empty($request->title) && $request->title != $blogPost->title) {
            $blogPost->title = $request->title;
        }

        $blogPost->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        if (!empty($request->content) && $request->content != $blogPost->content) {
            $blogPost->content = $request->content;
        }

        if ($request->hasFile('image')) {
            $imagePath = cloudinary()->uploadFile($request->file('image')->getRealPath())->getSecurePath();
            $blogPost->image = $imagePath;
        }

        if ($blogPost->save()) {
            alert()->success('Changes Saved', 'Blog post updated successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }




































    public function addStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'othernames' => 'required',
            'email' => 'required|unique:staff',
            'password' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'confirm_password' => 'required',
            'role' => 'required',
            'image' => 'required',
            'bio' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',

        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if ($request->password == $request->confirm_password) {
            $password = bcrypt($request->password);
        } else {
            alert()->error('Oops!', 'Password mismatch')->persistent('Close');
            return redirect()->back();
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname . '-' . $request->othernames)));
        $imageUrl = null;
        if ($request->has('image')) {
            $imageUrl = 'uploads/staff/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->move('uploads/staff', $imageUrl);
        }
        $role = Role::all();

        $newStaff = ([
            'lastname' => $request->lastname,
            'othernames' => $request->othernames,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => $request->role,
            'bio' => $request->bio,
            'slug' => $slug,
            'image' => $imageUrl,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);

        if (Staff::create($newStaff)) {
            alert()->success('Changes Saved', 'Staff added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function editStaff(Request $request)
    {
        if (!empty($request->staff_id) && !$staff = Staff::find($request->staff_id)) {
            alert()->error('Oops', 'Invalid Staff Information')->persistent('Close');
            return redirect()->back();
        }


        $slug = $staff->slug;
        if (!empty($request->lastname) && $request->lastname != $staff->lastname) {
            $staff->lastname = $request->lastname;
            $staff->othernames = $request->othernames;
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname . '-', $request->othernames)));
            $staff->slug = $slug;
        }

        if (!empty($request->staffId) && $request->staffId != $staff->staffId) {
            $staff->staffId = $request->staffId;
        }

        if (!empty($request->email) && $request->email != $staff->email) {
            $staff->email = $request->email;
        }

        if (!empty($request->password) && $request->password != $staff->password) {
            $staff->password = $request->password;
        }

        if (!empty($request->phone_number) && $request->phone_number != $staff->phone_number) {
            $staff->phone_number = $request->phone_number;
        }

        if (!empty($request->address) && $request->address != $staff->address) {
            $staff->address = $request->address;
        }

        if (!empty($request->role) && $request->role != $staff->role) {
            $staff->role = $request->role;
        }

        if (!empty($request->bio) && $request->bio != $staff->bio) {
            $staff->bio = $request->bio;
        }

        if (!empty($request->marital_status) && $request->marital_status != $staff->marital_status) {
            $staff->marital_status = $request->marital_status;
        }

        if (!empty($request->religion) && $request->religion != $staff->religion) {
            $staff->religion = $request->religion;
        }

        if (!empty($request->gender) && $request->gender != $staff->gender) {
            $staff->gender = $request->gender;
        }

        if (!empty($request->dob) && $request->dob != $staff->dob) {
            $staff->dob = $request->dob;
        }


        if ($request->has('password') && !empty($request->password)) {
            if ($request->password == $request->confirm_password) {
                $password = bcrypt($request->password);
            } else {
                alert()->error('Oops!', 'Password mismatch')->persistent('Close');
                return redirect()->back();
            }
            $staff->password = $password;
        }

        if ($request->hasFile('image')) {
            $imageUrl = 'uploads/staff/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->move('uploads/staff', $imageUrl);
            $staff->image = $imageUrl;
        }

        if ($staff->save()) {
            alert()->success('Changes Saved', 'Staff details updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }

    public function deleteStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
        if (!$staff = Staff::find($request->staff_id)) {
            alert()->error('Oops', 'Invalid Staff ')->persistent('Close');
            return redirect()->back();
        }

        if ($staff->delete()) {
            alert()->success('Deleted Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }
}


























































 -->
