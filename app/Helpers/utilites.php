<?php


use Intervention\Image\Facades\Image;

function settings($key, $defaultValue = false)
{
    $settings = Cache::remember('settings', 5000,
        function () {
            return \App\Models\Setting::get()->pluck('value', 'key')->toArray();
        }
    );
    return (isset($settings[$key]) ? $settings[$key] : ($defaultValue ?: ''));
}

function resize_image($name)
{
    $imgName = get_file_name_after_upload($name);
    $path = storage_path("app/$name");
    if (file_exists($path)) {
        $img = Image::make($path);
        image_resize_width($imgName, $img, 100);
        image_resize_width($imgName, $img, 400);
        image_resize_width($imgName, $img, 800);
        image_resize_width($imgName, $img, 1200);
        return $imgName;
    }
    return false;
}

function prepare_file_after_upload($name)
{
    $fileName = get_file_name_after_upload($name);
    $newPath = 'public/files/' . $fileName;

    \Illuminate\Support\Facades\Storage::move($name, $newPath);
    return $fileName;
}

function get_file_name_after_upload($name)
{
    $fileName = \Illuminate\Support\Str::replaceFirst('public/original/', '', $name);
    return \Illuminate\Support\Str::replaceFirst('original/', '', $fileName);

}

function image_resize_width($name, $img, $widh)
{
    $tmpImg = clone $img;
    $tmpImg->resize($widh, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    $newPath = storage_path("app/public/$widh");
    if (!file_exists($newPath)) {
        mkdir($newPath);
    }
    $newPath .= "/" . $name;
    $tmpImg->save($newPath);
    return $newPath;
}

function get_image($id, $size = 'low')
{
    $sizes = ['thump' => 100, 'low' => 400, 'med' => 800, 'high' => 1200];
    $path = 'storage/' . ($sizes[$size] ?? '100') . '/' . $id;
    if (file_exists(public_path($path)))
        return $path;
    return "media/image-not-found.jpg";
}

function get_images_folder($size = 'low')
{
    $sizes = ['thump' => 100, 'low' => 400, 'med' => 800, 'high' => 1200];
    return 'storage/' . ($sizes[$size] ?? '100') . '/';
}

function get_images_group($id, $sizes = ['thump' => 100, 'low' => 400, 'med' => 800, 'high' => 1200])
{
    $images = [];
    foreach ($sizes as $key => $size) {
        if (!$id) {
            $images[$key] = '';
        } else {
            $path = storage_path("app/public/$size/$id");
            if (file_exists($path)) {
                $images[$key] = url("storage/$size/$id");
            }
        }
    }
    if ($id)
        $images['original'] = url('storage/original/' . $id);
    else
        $images['original'] = '';
    return $images;
}

function remove_image($name)
{
    $sizes = ['thump' => 100, 'low' => 400, 'med' => 800, 'high' => 1200];
    foreach ($sizes as $size) {
        $path = storage_path("app/public/$size/$name");
        if (file_exists($path))
            unlink($path);
    }
    $path = storage_path("app/original/$name");
    if (file_exists($path))
        unlink($path);
}

function get_default_language_id()
{
    return \Illuminate\Support\Facades\Cache::remember('default_language', 3000, function () {
        return \App\Models\Language::where('is_default', 1)->first()->id;
    });
}

function get_language_id_by_code($code)
{
    return \Illuminate\Support\Facades\Cache::remember('language' . $code, 3000, function () use ($code) {
        return \App\Models\Language::where('code', $code)->first()->id;
    });
}

function custom_format($number)
{
    return number_format($number, 2, '.', '');
}

function hex_color_allocate($im, $hex)
{
    $hex = ltrim($hex, '#');
    $length = 1;
    if (strlen($hex) > 3)
        $length = 2;
    $r = hexdec(substr($hex, 0, $length)."".($length==1?substr($hex, 0, $length):""));
    $g = hexdec(substr($hex, 1 * $length, $length)."".($length==1?substr($hex, 1, $length):""));
    $b = hexdec(substr($hex, 2 * $length, $length)."".($length==1?substr($hex, 2, $length):""));
    return imagecolorallocate($im, $r, $g, $b);
}


function getImageInfo($id)
{
    $data = getimagesize(public_path($id));
    $data['retion'] = $data[0] / $data[1] ?: 1;
    return $data;
}
