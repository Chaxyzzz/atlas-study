<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'is_admin', 'phone', 'avatar', 'google_id', 
        'preferred_language', 'provider', 'role', 'status', 'last_login_at', 'last_login_ip', 
        'device', 'browser', 'operating_system',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function aiLogs()
    {
        return $this->hasMany(AiLog::class);
    }

    public function isSuperAdmin()
    {
        return ($this->role ?? '') === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->is_admin === true || in_array($this->role ?? '', ['super_admin', 'admin']);
    }

    public function isTeacher()
    {
        return ($this->role ?? '') === 'teacher';
    }

    public function isStudent()
    {
        return ($this->role ?? 'student') === 'student';
    }

    public function isGuest()
    {
        return ($this->role ?? '') === 'guest';
    }

    public function isSuspended()
    {
        return ($this->status ?? '') === 'suspended';
    }

    public function isActive()
    {
        $st = $this->status ?? 'active';
        return in_array($st, ['active', 'verified']);
    }

    /**
     * Helper to get login provider badge string
     */
    public function getEffectiveProviderAttribute()
    {
        if (!empty($this->provider)) {
            return strtolower($this->provider);
        }
        if (!empty($this->google_id)) {
            return 'google';
        }
        if (!empty($this->phone) && str_contains($this->email ?? '', '@atlasstudy.internal')) {
            return 'phone';
        }
        return 'local';
    }

    /**
     * Record login metadata (IP, time, OS, Browser, Device)
     */
    public function recordLogin($request, $provider = null)
    {
        $userAgent = $request ? ($request->header('User-Agent') ?? '') : '';
        
        // Detailed OS detection
        $os = 'Windows 11';
        if (preg_match('/windows nt 10\.0/i', $userAgent)) {
            $os = 'Windows 11';
        } elseif (preg_match('/windows nt 6\.3/i', $userAgent)) {
            $os = 'Windows 8.1';
        } elseif (preg_match('/windows nt/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/mac os x ([0-9_]+)/i', $userAgent, $m)) {
            $os = 'macOS ' . str_replace('_', '.', $m[1]);
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/android ([0-9\.]+)/i', $userAgent, $m)) {
            $os = 'Android ' . $m[1];
        } elseif (preg_match('/iphone os ([0-9_]+)/i', $userAgent, $m)) {
            $os = 'iOS ' . str_replace('_', '.', $m[1]);
        } elseif (preg_match('/linux/i', $userAgent)) {
            $os = 'Linux';
        }

        // Detailed Browser detection with version
        $browser = 'Chrome 139';
        if (preg_match('/edg\/([0-9\.]+)/i', $userAgent, $m)) {
            $browser = 'Edge ' . explode('.', $m[1])[0];
        } elseif (preg_match('/chrome\/([0-9\.]+)/i', $userAgent, $m)) {
            $browser = 'Chrome ' . explode('.', $m[1])[0];
        } elseif (preg_match('/firefox\/([0-9\.]+)/i', $userAgent, $m)) {
            $browser = 'Firefox ' . explode('.', $m[1])[0];
        } elseif (preg_match('/version\/([0-9\.]+).*safari/i', $userAgent, $m)) {
            $browser = 'Safari ' . explode('.', $m[1])[0];
        } elseif (preg_match('/opr\/([0-9\.]+)/i', $userAgent, $m)) {
            $browser = 'Opera ' . explode('.', $m[1])[0];
        }

        // Device type detection
        $device = 'Desktop';
        if (preg_match('/tablet|ipad/i', $userAgent)) {
            $device = 'Tablet';
        } elseif (preg_match('/mobile|iphone|android/i', $userAgent)) {
            $device = 'Mobile';
        }

        $updateData = [
            'last_login_at' => now(),
            'last_login_ip' => $request ? ($request->ip() ?: '127.0.0.1') : '127.0.0.1',
            'device' => $device,
            'browser' => $browser,
            'operating_system' => $os,
        ];

        if (!empty($provider)) {
            $updateData['provider'] = $provider;
        } elseif (empty($this->provider)) {
            $updateData['provider'] = $this->effective_provider;
        }

        if ($this->is_admin && empty($this->role)) {
            $updateData['role'] = 'admin';
        } elseif (empty($this->role)) {
            $updateData['role'] = 'student';
        }

        if (empty($this->status)) {
            $updateData['status'] = 'active';
        }

        $this->update($updateData);
    }

    /**
     * Get user avatar URL with clean dark initial fallback (no AI / stock photos)
     */
    public function getAvatarUrlAttribute()
    {
        if (!empty($this->avatar) && !str_contains($this->avatar, 'unsplash.com') && !str_contains($this->avatar, 'pexels.com')) {
            return $this->avatar;
        }

        $initialName = !empty($this->name) ? $this->name : (!empty($this->username) ? $this->username : 'User');
        return 'https://ui-avatars.com/api/?name=' . urlencode($initialName) . '&background=181818&color=ffffff&bold=true&length=1';
    }
}
