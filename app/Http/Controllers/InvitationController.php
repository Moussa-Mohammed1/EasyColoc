<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Colocation;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        $colocation = $user->colocations()->firstWhere('status', 'active');
        $token = Str::random(40);

        $invitation = Invitation::create([
            'email' => $request->email,
            'colocation_id' => $colocation->id,
            'token' => $token,
            'status' => 'pending',
        ]);

        Mail::to($request->email)->send(new InvitationMail($invitation));
        return back();
    }

    public function accept($token)
    {
        $invitation = Invitation::with('colocation')->where('token', $token)->where('status', 'pending')->firstOrFail();

        if (Auth::check()) {
            return view('invitation', ['invitation' => $invitation]);
        } else {
            session(['invitation_token' => $token]);
            return redirect()->route('register');
        }
    }

    public function process(Request $request, $token)
    {
        $invitation = Invitation::firstWhere('token',$token);
        if (!User::where('email', $invitation->email)) {
            session(['invitation_token' => $token]);
            return redirect()->route('register');
        }

        $invitation = Invitation::where('token', $token)->where('status', 'pending')->firstOrFail();
        
        if ($request->has('accept')) {
            $user = Auth::user();
            if ($invitation->colocation->members->contains($user->id)) {
                $invitation->update(['status' => 'accepted', 'responded_at' => now()]);
                return redirect()->route('dashboard.index')->with('info', 'Vous êtes déjà membre de cette colocation.');
            }

            $invitation->colocation->members()->attach($user->id, ['role' => 'member']);

            $invitation->update(['status' => 'accepted', 'responded_at' => now()]);

            return redirect()->route('dashboard.index')->with('info', 'Bienvenue dans votre nouvelle colocation');
        }

        if ($request->has('refuse')) {
            $invitation->update(['status' => 'declined', 'responded_at' => now()]);
            return view('invitation', compact('invitation'))->with('info', 'Invitation refusée.');
        }

        return back();
    }
}
