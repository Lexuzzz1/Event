<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->updateEventStatuses();

        $events = Event::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:events,name',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'time' => 'required',
            'location' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'poster' => 'required|image|max:2048',
            'registration_fee' => 'required',
            'max_participants' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ], [
            'name.unique' => 'The name has already been taken'
        ]);

        $validated['registration_fee'] = preg_replace('/[^\d]/', '', $request->registration_fee);

        if ($request->date === now()->toDateString()) {
            $selectedTime = Carbon::createFromFormat('H:i', $request->time);
            $minTime = now()->addHour();

            if ($selectedTime->lessThan($minTime)) {
                return back()
                    ->withErrors(['time' => 'Time must be at least 1 hour from now.'])
                    ->withInput();
            }
        }

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $posterPath;
        }

        $validated['created_by'] = Auth::id();

        Event::create($validated);

        return redirect()->route('event.index')->with('success', 'Event berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.detail', compact('event'));
    }

    public function view(Event $event)
    {
        return view('event.viewonly', compact('event'));
    }

    public function showAll(){
        $events = Event::where('status', 'active')->get();
        return view('event.all', compact('events'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name' => 'unique:events,name,' . $event->id,
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'poster' => 'image|max:2048',
            'registration_fee' => 'required|numeric',
            'max_participants' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['registration_fee'] = preg_replace('/[^\d]/', '', $request->registration_fee);

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($validated);

        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function updateEventStatuses()
    {
        $events = Event::where('status', '!=', 'pass')->get();

        foreach ($events as $event) {
            $eventDateTime = Carbon::parse("{$event->date} {$event->time}");
            if ($eventDateTime->isPast()) {
                $event->update(['status' => 'pass']);
            }
        }
    }
}
