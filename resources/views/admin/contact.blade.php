@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-contacts-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Contacts Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-contact active">Contacts Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Contacts Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Contacts Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addContacts">
                            <i class="ri-add-line align-bottom me-1"></i> Add Contact
                        </button>

                        <!-- Add Contacts Modal -->
                        <div class="modal fade" id="addContacts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addContactsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addContactsLabel">Add Contact</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addContacts') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <p>Name</p>
                                                <textarea name="name" class="form-control" id="name" cols="30" rows="5" placeholder="Enter Name"></textarea>
                                            </div>

                                             <div class="form-floating mb-3">
                                                <p>Email</p>
                                                <textarea name="email" class="form-control" id="email" cols="30" rows="5" placeholder="Enter Your Email"></textarea>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <p>Subject</p>
                                                <textarea name="subject" class="form-control" id="subject" cols="30" rows="5" placeholder="Enter Subject"></textarea>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <p>Message</p>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Enter Message"></textarea>
                                            </div>
                                        
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>




                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>

                             <th>
                                Email
                            </th>

                            <th>
                                Subject
                            </th>

                            <th>
                                Message
                            </th>


                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            
                            <td>{{ $contact->email }}</td>

                            <td>{{ $contact->subject }}</td>

                            <td>{{ $contact->message }}</td>
                          

                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editContacts{{ $contact->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteContacts{{ $contact->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete Contacts Modal -->
                                <div class="modal fade" id="deleteContacts{{ $contact->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteContactsLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteContacts') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to delete this Contact section?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Contacts Modal -->
                                <div class="modal fade" id="editContacts{{ $contact->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editContacts{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editContactsLabel{{ $contact->id }}">Edit Contacts Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editContacts') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="name" class="form-control" id="name" cols="35" rows="5" >{{ $contact->name }}</textarea>
                                                        <label for="name">Name</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea name="email" class="form-control" id="email" cols="35" rows="5" >{{ $contact->email }}</textarea>
                                                        <label for="email">Email</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea name="subject" class="form-control" id="subject" cols="35" rows="5" >{{ $contact->subject }}</textarea>
                                                        <label for="subject">Subject</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea name="message" class="form-control" id="message" cols="35" rows="5" >{{ $contact->message }}</textarea>
                                                        <label for="message">Message</label>
                                                    </div>
                                                   

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection