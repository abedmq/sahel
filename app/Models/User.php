<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Support\Facades\Hash;


class User extends BaseModelAuth implements HasLocalePreference
{

    use ImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'status',

            'password',

            'image',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
            'two_factor_recovery_codes',
            'two_factor_secret',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'mobile_code_send' => 'datetime',
        ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends
        = [
            'profile_photo_url',
        ];

    function getProfilePhotoUrlAttribute()
    {
        return $this->image;
    }

    function scopeSearch($q, $query = "")
    {
        $query = request('query')['query'] ?? $query;
        if ($query) {
            $q->where('id', $query);
            $q->orWhere('name', "like", "%$query%");
        }
    }


    function canCreateOrder()
    {
        return $this->orders()->active()->count() < config('env.max_user_active_order');
    }

    function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    function settings()
    {
        return $this->hasMany(UserSetting::class);
    }

    function orders()
    {
        return $this->hasMany(Order::class, $this->isCustomer() ? "user_id" : "provider_id");
    }

    function userApps()
    {
        return $this->hasMany(UserApp::class);
    }

    function language()
    {
        return $this->belongsTo(Language::class);
    }


    function messages()
    {
        return $this->hasMany(Message::class);
    }

    function defaultSettings()
    {
        $this->settings()->delete();
        $this->settings()->createMany([
            ['key' => 'notification', 'type' => 'boolean', 'value' => 1],
        ]);
        return $this->settings()->get();
    }

    function setLanguage()
    {
        $language = Language::active()->where('code', request()->header('Accept-Language'))->first();
        if (!$language) {
            $language = Language::default()->first();
        }
        $this->update(['language_id' => $language->id]);
        return $language;
    }

    function sendMobileCode($type = 'send_code')
    {
        if (config('app.debug'))
            $code = '1111';
        else
            $code = rand(10000, 99999);
        $this->update(['mobile_code' => $code, 'mobile_code_send' => Carbon::now(), 'mobile_code_count' => $this->mobile_code_count + 1]);
        $this->notify(new SendCodeNotification($type));
        return trans('auth.send_code', ['code' => $this->mobile_code]);
    }

    public function preferredLocale()
    {
        return $this->language->code ?? 'ar';
    }

    static function defaultImage()
    {
        return get_images_group('default.png');
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
//        return "fQi6H2t-QIef7l2ST08UoH:APA91bGxUEm21BKPshH4U5H8sWYWAom9sTPeX3mXeX-QyvFZ2FSv-Kq9VkcGZfgsvF3dCkWRmEZj0Na2NpMVXWf_4NcPA6PDXYVmtpDrmShhXy6x675XNGEKCFhXXfb0b04oWysvRvO3";
        return $this->userApps()->pluck('token')->toArray();
    }

    function services()
    {
        return $this->belongsToMany(Service::class);
    }

    function logout($all = false)
    {
        if ($all) {
            $this->tokens()->delete();
            $this->userApps()->delete();
        } else {
            $this->currentAccessToken()->delete();
            $this->userApps()->where('token_id', $this->currentAccessToken()->id)->delete();
        }
        return true;
    }

    function addToFirebase($order = null)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $collectionReference = $database->collection('Users');

        $documentReference = $collectionReference->document($this->id);
        $documentReference->set([
            'type' => $this->type,
            'order_id' => @$order->id ?: 0,
            'is_working' => @$order->is_working ? true : false,
            'complete_at' => @$order->complete_at ? $order->complete_at->getTimestamp() : Carbon::now()->getTimestamp(),
            'status_id' => $order->status_id,
            'duration' => @$order->duration ?: 0,
        ]);
    }

}
