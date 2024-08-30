<?php

namespace App\Http\Controllers;

use App\Enums\TalkType;
use App\Http\Requests\UpdateTalkRequest;
use App\Models\Talk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TalkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view('talks.index', ['talks' => $user->talks()->latest()->get(), 'presenter' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('talks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:talks|max:255',
            'length' => 'required',
            'type' => Rule::enum(TalkType::class),
            'abstract' => '',
            'organizer_notes' => '',
        ]);

        Talk::create($data + ['user_id' => $request->user()->id]);

        return redirect(route('talks.index'))->with('message', 'Post created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Talk $talk)
    {
        abort_if(auth()->user()->id !== $talk->user_id, code: Response::HTTP_FORBIDDEN, message: 'You do not have permission to show this talk');

        return view('talks.show', ['talk' => $talk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talk $talk)
    {
        abort_if(auth()->user()->id !== $talk->user_id, code: Response::HTTP_FORBIDDEN, message: 'You do not have permission to edit talk');

        return view('talks.edit', ['talk' => $talk]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTalkRequest $request, Talk $talk)
    {
        $talk->update($request->validated());

        return redirect(route('talks.index'))->with('message', 'Post created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talk $talk)
    {
        abort_if(auth()->user()->id !== $talk->user_id, code: Response::HTTP_FORBIDDEN, message: 'You do not have permission to delete talk');

        $talk->delete();

        return redirect()->back()->with('message', 'Delete successfully');
    }
}
