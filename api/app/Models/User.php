<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Lib\ApiLibrary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public static function register(\Illuminate\Http\Request $request): ?User {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $user = new User([
            'name'  => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        if ($user->save()) return $user;
        return null;
    }
    
    public static function login(\Illuminate\Http\Request $request): ?User {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        
        $user = User::where('email', $validated['email'])->first();
        
        if ($user !== null && $user->password === bcrypt($validated['password'])) return $user;
        return null;
    }
    
    public static function intoAuthenticationResponse(?User $user): \Illuminate\Http\JsonResponse {
        if ($user !== null) {
            return response()->json([
                'res_type' => 'authenticated',
                'message' => 'Successfully created user!',
                'token' => $user->createToken('Personal Access Token')->plainTextToken,
            ],201);
        }

        return ApiLibrary::headError('Failed to authenticate user!');
    }
}
