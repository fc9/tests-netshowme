<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * The contact repository implementation.
     *
     * @var ContactRepository
     */
    protected $contactsRepository;

    /**
     * Create a new controller instance.
     *
     * @param ContactRepository $repository
     * @return void
     */
    public function __construct(ContactRepository $repository)
    {
        $this->contactsRepository = $repository;
    }

    /**
     * Redirect to create method.
     *
     * @return View
     */
    public function index()
    {
        return redirect('contact/create');
    }

    /**
     * Show contact form page.
     *
     * @return View
     */
    public function create()
    {
        return view('contact-form');
    }

    /**
     * Register new contact.
     *
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function store(ContactRequest $request)
    {
        $contact = $this->contactsRepository->register($request);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => [
                'id' => $contact->id
            ]
        ]);
    }
}
