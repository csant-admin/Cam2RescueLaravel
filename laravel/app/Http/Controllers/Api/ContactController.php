<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index() {
        $contact = Contact::all();
        if($contact->count() > 0):
            $data = array(
                'status' => 200,
                'contact' => $contact,
                'message' => 'success'
            );
            return response()->json($data, 200);
        else: 
            $data = array(
                'status' => 404,
                'contact' => [],
                'message' => 'No Records Found'
            );
            return response()->json($data, 404);
        endif;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:191',
            'contact_no'    => 'required|digits:11',
            'email'         => 'required|email|max:191'
        ]);

        if($validator->fails()):
            return response()->json([
                'status' => 422,
                'error'     => $validator->messages()
            ], 422);
        else:
            $contact = Contact::create([
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'email' => $request->email
            ]);

            if($contact):
                return response()->json([
                    'status' => 200,
                    'message' => 'Contact added successfully'
                ], 200);
            else:
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            endif;
        endif;
    }

    public function show($id) {
        $contact = Contact::find($id);
        if($contact):
            return response()->json([
                'status' => 200,
                'contact' => $contact
            ], 200);
        else:
            return response()->json([
                'status' => 404,
                'message' => 'No Such Contact Found'
            ], 404);
        endif;
    }

    public function edit($id) {
        // $this->show($id);
        $contact = Contact::find($id);
        if($contact):
            return response()->json([
                'status' => 200,
                'contact' => $contact
            ], 200);
        else:
            return response()->json([
                'status' => 404,
                'message' => 'No Such Contact Found'
            ], 404);
        endif;
    }

    public function update(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:191',
            'contact_no'    => 'required|digits:11',
            'email'         => 'required|email|max:191'
        ]);

        if($validator->fails()):
            return response()->json([
                'status' => 422,
                'error'     => $validator->messages()
            ], 422);
        else:
            $contact = Contact::find($id);

            if($contact):
                $contact->update([
                    'name' => $request->name,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email
                ]);
            
                return response()->json([
                    'status' => 200,
                    'message' => 'Contact updatec successfully'
                ], 200);

            else:
                return response()->json([
                    'status' => 404,
                    'message' => 'No Such Contact Found!'
                ], 404);
            endif;
        endif;
    }

    public function remove($id) {

        $contact = Contact::find($id);
        if($contact):
            $contact->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Contact deleted successfully!'
            ], 200);
        else:
            return response()->json([
                'status' => 404,
                'message' => 'No Such Contact Found!'
            ], 404);
        endif;
    }
}
