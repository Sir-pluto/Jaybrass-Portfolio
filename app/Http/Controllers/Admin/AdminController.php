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

use App\Models\Home as Setting;
use App\Models\About;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Projects;
use App\Models\Skills;
use App\Models\Services;
use App\Models\Testimonial;
use App\Models\Tools;
use App\Models\User;



use SweetAlert;
use Alert;
use Log;
use Carbon\Carbon;



class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.home');
    }

    public function homeSettings()
    {
        $setting = Setting::all();
        return view('admin.homeSettings', [
            'setting' => $setting
        ]);
    }
    public function about()
    {
        $about = About::get();
        return view('admin.about', [
            'about' => $about
        ]);
    }

    public function experience()
    {
        $experiences = Experience::get();
        return view('admin.experience', [
            'experiences' => $experiences
        ]);
    }

    public function education()
    {
        $educations = Education::get();
        return view('admin.education', [
            'educations' => $educations
        ]);
    }


    public function projects()
    {
        $projects = Projects::get();
        return view('admin.projects', [
            'projects' => $projects
        ]);
    }

    public function services()
    {
        $services = Services::get();
        return view('admin.services', [
            'services' => $services
        ]);
    }
    public function skills()
    {
        $skills = Skills::get();
        return view('admin.skills', [
            'skills' => $skills
        ]);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial', [
            'testimonials' => $testimonials
        ]);
    }

    public function tools()
    {
        $tools = Tools::get();
        return view('admin.tools', [
            'tools' => $tools
        ]);
    }

    public function contact()
    {
        $contacts = Contact::get();
        return view('admin.contact', [
            'contacts' => $contacts
        ]);
    }





    

    // WEBSITE HOME SETTINGS UPDATE LOGIC
   public function updateHomeSettings(Request $request) {
    // Step 1: Validate the request data
    $validator = Validator::make($request->all(), [
        'image' => 'required',
        'biography' => 'required',
        'title' => 'required',
        'slug' => 'slug'
    ]);

    // Step 2: Handle validation failure
    if ($validator->fails()) {
        alert()->error('Error', $validator->messages()->first())->persistent('Close');
        return redirect()->back();
    }

    // Step 3: Generate a unique identifier for the homeSettings file
    $uuid = 'homeSetting' . Carbon::now();
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $uuid)));
    $imageUrl = null;

    // Step 4: Handle the image upload
    if ($request->has('image')) {
        $imageUrl = 'uploads/homeSetting/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
        $image = $request->file('image')->move('uploads/homeSetting', $imageUrl);
    }

    // Step 5: Find or create the About record
    $setting = Setting::first();
    if (!$setting) {
        $setting = new Setting();
    }

    // Step 6: Update the About record
    $setting->image = $imageUrl;
    $setting->title = $request->title;
    $setting->biography = $request->biography;
    $setting->slug = $slug;

    // Step 7: Save the About record and handle the response
    if ($setting->save()) {
        alert()->success('Changes Saved', 'Site Home Settting updated successfully')->persistent('Close');
        return redirect()->back();
    }

    alert()->error('Oops!', 'Something went wrong')->persistent('Close');
    return redirect()->back();
}









    // ABOUT UPDATE LOGIC
   public function updateAbout(Request $request) {
    // Step 1: Validate the request data
    $validator = Validator::make($request->all(), [
        'image' => 'required',
        'biography' => 'required',
        'title' => 'required',
        'slug' => 'slug'
    ]);

    // Step 2: Handle validation failure
    if ($validator->fails()) {
        alert()->error('Error', $validator->messages()->first())->persistent('Close');
        return redirect()->back();
    }

    // Step 3: Generate a unique identifier for the image file
    $uuid = 'about' . Carbon::now();
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $uuid)));
    $imageUrl = null;

    // Step 4: Handle the image upload
    if ($request->has('image')) {
        $imageUrl = 'uploads/about/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
        $image = $request->file('image')->move('uploads/about', $imageUrl);
    }

    // Step 5: Find or create the About record
    $about = About::first();
    if (!$about) {
        $about = new About();
    }

    // Step 6: Update the About record
    $about->image = $imageUrl;
    $about->title = $request->title;
    $about->biography = $request->biography;
    $about->slug = $slug;

    // Step 7: Save the About record and handle the response
    if ($about->save()) {
        alert()->success('Changes Saved', 'About Us updated successfully')->persistent('Close');
        return redirect()->back();
    }

    alert()->error('Oops!', 'Something went wrong')->persistent('Close');
    return redirect()->back();
    }







    

    //EDUCATION CREATE LOGIC
    public function addEducation(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'degree' => 'required',
            'school' => 'required',
            'year' => 'required',
        ]);

        // If validation fails, return an error
        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        // Prepare the data for insertion
        $newEducation = [
            'degree' => $request->degree,
            'school' => $request->school,
            'year' => $request->year,
        ];

        // Insert the data into the 'education' table
        if (Education::create($newEducation)) {
            alert()->success('Education Added successfully', '')->persistent('Close');
            return redirect()->back();
        }

        // If insertion fails, return an error
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }




    //EDUCATION EDIT LOGIC
    public function editEducation(Request $request) {
        $validator = Validator::make($request->all(), [
            'education_id'=> 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }


        if(!$educations = Education::find($request->education_id)) {
        alert()->error('Oops', 'Invalid Education')->persistent('Close');
        return redirect()->back();
        }

        if(!empty($request->degree) && $request->degree != $educations->degree) {
            $educations->degree = $request->degree;
        }

        if(!empty($request->school) && $request->school != $educations->school) {
            $educations->school = $request->school;
        }

        if(!empty($request->year) && $request->year != $educations->year) {
            $educations->year = $request->year;
        }

        if($educations->save()){
        alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
        return redirect()->back();
        }

        alert()->error('Oops', 'Something went wrong', 'Check your internet');
        return redirect()->back();


    }


    
    //EDUCATION DELETE LOGIC

    public function deleteEducation(Request $request) {
        $validator = Validator::make($request->all(), [
            'education_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$educations = Education::find($request->education_id)) {
            alert()->error('Oopps', 'Invalid Experience')->persistent('Close');
            return redirect()->back();
        }

        if($educations->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }

















    //EXPERIENCE CREATE LOGIC
    public function addExperience(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'duration' => 'required',
            'city' => 'required',
        ]);

        // If validation fails, return an error
        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        // Prepare the data for insertion
        $newExperience = [
            'position' => $request->position,
            'duration' => $request->duration,
            'city' => $request->city,
        ];

        // Insert the data into the 'experiences' table
        if (Experience::create($newExperience)) {
            alert()->success('Experience Added successfully', '')->persistent('Close');
            return redirect()->back();
        }

        // If insertion fails, return an error
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }




    //EXPERIENCE EDIT LOGIC
    public function editExperience(Request $request) {
        $validator = Validator::make($request->all(), [
            'experience_id'=> 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }


        if(!$experiences = Experience::find($request->experience_id)) {
        alert()->error('Oops', 'Invalid Experience')->persistent('Close');
        return redirect()->back();
        }

        if(!empty($request->position) && $request->position != $experiences->position) {
            $experiences->position = $request->position;
        }

        if(!empty($request->duration) && $request->duration != $experiences->duration) {
            $experiences->duration = $request->duration;
        }

        if(!empty($request->city) && $request->position != $experiences->city) {
            $experiences->city = $request->city;
        }

        if($experiences->save()){
        alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
        return redirect()->back();
        }

        alert()->error('Oops', 'Something went wrong', 'Check your internet');
        return redirect()->back();


    }

    public function deleteExperience(Request $request) {
        $validator = Validator::make($request->all(), [
            'experience_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$experiences = Experience::find($request->experience_id)) {
            alert()->error('Oopps', 'Invalid Experience')->persistent('Close');
            return redirect()->back();
        }

        if($experiences->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }









    
    //SKILL CREATE LOGIC
    public function addSkills(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'skills' => 'required',
          
        ]);

        // If validation fails, return an error
        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        // Prepare the data for insertion
        $newSkills = [
            'skills' => $request->skills,
    
        ];

        // Insert the data into the 'skills' table
        if (Skills::create($newSkills)) {
            alert()->success('New Skill Added successfully', '')->persistent('Close');
            return redirect()->back();
        }

        // If insertion fails, return an error
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }




    //SKILLS EDIT LOGIC
    public function editSkills(Request $request) {
        $validator = Validator::make($request->all(), [
            'skill_id'=> 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }


        if(!$skills = Skills::find($request->skill_id)) {
        alert()->error('Oops', 'Invalid Skill')->persistent('Close');
        return redirect()->back();
        }

        if(!empty($request->skills) && $request->skills != $skills->skills) {
            $skills->skills = $request->skills;
        }

        if($skills->save()){
        alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
        return redirect()->back();
        }

        alert()->error('Oops', 'Something went wrong', 'Check your internet');
        return redirect()->back();


    }



    
    public function deleteSkills(Request $request) {
        $validator = Validator::make($request->all(), [
            'skill_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$skills = Skills::find($request->skill_id)) {
            alert()->error('Oopps', 'Invalid Skill')->persistent('Close');
            return redirect()->back();
        }

        if($skills->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }



   







    

    
    //TOOLS CREATE LOGIC
    public function addTools(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'tools' => 'required',
          
        ]);

        // If validation fails, return an error
        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        // Prepare the data for insertion
        $newTools = [
            'tools' => $request->tools,
    
        ];

        // Insert the data into the 'tools' table
        if (Tools::create($newTools)) {
            alert()->success('New Skill Added successfully', '')->persistent('Close');
            return redirect()->back();
        }

        // If insertion fails, return an error
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }




    //TOOLS EDIT LOGIC
    public function editTools(Request $request) {
    $validator = Validator::make($request->all(), [
        'tool_id'=> 'required',
    ]);

    if($validator->fails()) {
        alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
        return redirect()->back();
    }


    if(!$tools = Tools::find($request->tool_id)) {
    alert()->error('Oops', 'Invalid Skill')->persistent('Close');
    return redirect()->back();
    }

    if(!empty($request->tools) && $request->tools != $tools->tools) {
        $tools->tools = $request->tools;
    }

    if($tools->save()){
    alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
    return redirect()->back();
    }

    alert()->error('Oops', 'Something went wrong', 'Check your internet');
    return redirect()->back();


}


    //TOOLS DELETE LOGIC
    public function deleteTools(Request $request) {
        $validator = Validator::make($request->all(), [
            'tool_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$tools = Tools::find($request->tool_id)) {
            alert()->error('Oopps', 'Invalid Tool')->persistent('Close');
            return redirect()->back();
        }

        if($tools->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }




     // SERVICES ADD LOGIC
     public function addServices(Request $request) {
        $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
        ]);

         if($validator->fails()) {
             alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
                return redirect()->back();
        }

         $newServices = [
                'title' => $request->title,
                'description' => $request->description,
        ];

        if(Services::create($newServices)) {
            alert()->success('New Service Added Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Opps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

     }


     
    //SERVICES EDIT LOGIC
    public function editServices(Request $request) {
    $validator = Validator::make($request->all(), [
        'service_id'=> 'required',
    ]);

    if($validator->fails()) {
        alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
        return redirect()->back();
    }


    if(!$services = Services::find($request->service_id)) {
    alert()->error('Oops', 'Invalid Skill')->persistent('Close');
    return redirect()->back();
    }

    if(!empty($request->title) && $request->title != $services->title) {
        $services->title = $request->title;
    }

    if(!empty($request->description) && $request->description != $services->description) {
        $services->description = $request->description;
    }

    if($services->save()){
    alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
    return redirect()->back();
    }

    alert()->error('Oops', 'Something went wrong', 'Check your internet');
    return redirect()->back();


    }



    

    //SERVICES DELETE LOGIC
    public function deleteServices(Request $request) {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$services = Services::find($request->service_id)) {
            alert()->error('Oopps', 'Invalid Service')->persistent('Close');
            return redirect()->back();
        }

        if($services->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }




    
    

     // TESTIMONIAL ADD LOGIC
     public function addTestimonials(Request $request) {
        $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
        ]);

         if($validator->fails()) {
             alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
                return redirect()->back();
        }

         $newTestimonials = [
                'title' => $request->title,
                'description' => $request->description,
        ];

        if(Testimonial::create($newTestimonials)) {
            alert()->success('New Service Added Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Opps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

     }


     
    //TESTIMONIAL EDIT LOGIC
    public function editTestimonials(Request $request) {
    $validator = Validator::make($request->all(), [
        'testimonial_id'=> 'required',
    ]);

    if($validator->fails()) {
        alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
        return redirect()->back();
    }


    if(!$testimonials = Testimonial::find($request->testimonial_id)) {
    alert()->error('Oops', 'Invalid Testimonial')->persistent('Close');
    return redirect()->back();
    }

    if(!empty($request->title) && $request->title != $testimonials->title) {
        $testimonials->title = $request->title;
    }

    if(!empty($request->description) && $request->description != $testimonials->description) {
        $testimonials->description = $request->description;
    }

    if($testimonials->save()){
    alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
    return redirect()->back();
    }

    alert()->error('Oops', 'Something went wrong', 'Check your internet');
    return redirect()->back();


    }



    

    //TESTIMONIAL DELETE LOGIC
    public function deleteTestimonials(Request $request) {
        $validator = Validator::make($request->all(), [
            'testimonial_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$testimonials = Testimonial::find($request->testimonial_id)) {
            alert()->error('Oopps', 'Invalid Service')->persistent('Close');
            return redirect()->back();
        }

        if($testimonials->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }









      

     // PROJECTS ADD LOGIC
     public function addProjects(Request $request) {
        $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
        ]);

         if($validator->fails()) {
             alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
                return redirect()->back();
        }

         $newProjects = [
                'title' => $request->title,
                'description' => $request->description,
        ];

        if(Projects::create($newProjects)) {
            alert()->success('New Project Added Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Opps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

     }


     
    //PROJECTS EDIT LOGIC
    public function editProjects(Request $request) {
    $validator = Validator::make($request->all(), [
        'project_id'=> 'required',
    ]);

    if($validator->fails()) {
        alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
        return redirect()->back();
    }


    if(!$projects = Projects::find($request->project_id)) {
    alert()->error('Oops', 'Invalid Project')->persistent('Close');
    return redirect()->back();
    }

    if(!empty($request->title) && $request->title != $projects->title) {
        $projects->title = $request->title;
    }

    if(!empty($request->description) && $request->description != $projects->description) {
        $projects->description = $request->description;
    }

    if($projects->save()){
    alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
    return redirect()->back();
    }

    alert()->error('Oops', 'Something went wrong', 'Check your internet');
    return redirect()->back();


    }



    

    //PROJECTS DELETE LOGIC
    public function deleteProjects(Request $request) {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$projects = Projects::find($request->project_id)) {
            alert()->error('Oopps', 'Invalid Project')->persistent('Close');
            return redirect()->back();
        }

        if($projects->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }











       

     // CONTACT ADD LOGIC
     public function addContacts(Request $request) {
        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required', 'unique',
                'subject' => 'required',
                'message' => 'required',
        ]);

         if($validator->fails()) {
             alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
                return redirect()->back();
        }

         $newContacts = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                
        ];

        if(Contact::create($newContacts)) {
            alert()->success('New Contact Added Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Opps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

     }


     
    //CONTACT EDIT LOGIC
    public function editContacts(Request $request) {
    $validator = Validator::make($request->all(), [
        'contact_id'=> 'required',
    
    ]);

    if($validator->fails()) {
        alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
        return redirect()->back();
    }


    if(!$contacts = Contact::find($request->contact_id)) {
    alert()->error('Oops', 'Invalid Contact')->persistent('Close');
    return redirect()->back();
    }

    if(!empty($request->name) && $request->name != $contacts->name) {
        $contacts->name = $request->name;
    }

    if(!empty($request->email) && $request->email != $contacts->email) {
        $contacts->email = $request->email;
    }
    
     if(!empty($request->subject) && $request->subject != $contacts->subject) {
        $contacts->subject = $request->subject;
    }

     if(!empty($request->message) && $request->message != $contacts->message) {
        $contacts->message = $request->message;
    }


    if($contacts->save()){
    alert()->success('Changes Saved', 'Value changes saved successfully')->persistent('Close');
    return redirect()->back();
    }

    alert()->error('Oops', 'Something went wrong', 'Check your internet');
    return redirect()->back();


    }



    

    //CONTACT DELETE LOGIC
    public function deleteContacts(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact_id' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]->persistent('Close'));
            return redirect()->back();
        }

        if(!$contacts = Contact::find($request->contact_id)) {
            alert()->error('Oopps', 'Invalid Project')->persistent('Close');
            return redirect()->back();
        }

        if($contacts->delete()) {
            alert()->success('Deleted Successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oopps something went wrong', 'Check your internet')->persistent('Close');
        return redirect()->back();

    }







}




