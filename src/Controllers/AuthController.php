<?php

namespace Go2Flow\ApiPlatform\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Authenticate
     *
     * @param Request $request The incoming HTTP request containing user credentials.
     *
     * @return array An array containing a newly generated token for the authenticated user.
     * @throws ValidationException If the user credentials are invalid.
     *
     */
    public function index(Request $request)
    {

        // Retrieve the state from somewhere
        $user = User::where('email', $request->get('email'))->first();

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken('webinterface')->plainTextToken];
    }
}
