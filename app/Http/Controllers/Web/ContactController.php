<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('web.contacts.index', [
            'contacts' => Contact::query()
                ->orderByDesc('updated_at')
                ->paginate(6),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $messages = [
            'name.required' => trans('web.contact_validate.name.required'),
            'name.min' => trans('web.contact_validate.name.min'),
            'name.max' => trans('web.contact_validate.name.max'),
            'email.required' => trans('web.contact_validate.email.required'),
            'email.email' => trans('web.contact_validate.email.email'),
            'phone.required' => trans('web.contact_validate.phone.required'),
            'phone.digits' => trans('web.contact_validate.phone.digits'),
            'content.required' => trans('web.contact_validate.content.required'),
            'content.min' => trans('web.contact_validate.content.min'),
        ];

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'content' => 'required|min:10',
        ], $messages);

        Contact::create($validatedData);

        return back()->with('success', trans('web.alerts.success.contact'));
    }
}
