<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    public function index()
    {
        $wishes = Wish::where('user_id', Auth::id())->get();
        return view('wishes.index', compact('wishes'));
    }

    public function showUser($userId)
    {
        $wishes = Wish::where('user_id', $userId)->get();
        return view('wishes.user', compact('wishes'));
    }

    public function create()
    {
        return view('wishes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
            'image' => 'nullable|url',
            'price' => 'nullable|numeric',
        ]);
        $data['user_id'] = Auth::id();
        Wish::create($data);
        return redirect()->route('wishes.index');
    }

    public function edit(Wish $wish)
    {
        $this->authorize('update', $wish);
        return view('wishes.edit', compact('wish'));
    }

    public function update(Request $request, Wish $wish)
    {
        $this->authorize('update', $wish);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|url',
            'image' => 'nullable|url',
            'price' => 'nullable|numeric',
        ]);
        $wish->update($data);
        return redirect()->route('wishes.index');
    }

    public function destroy(Wish $wish)
    {
        $this->authorize('delete', $wish);
        $wish->delete();
        return redirect()->route('wishes.index');
    }
} 