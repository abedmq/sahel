<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class UpdateFileImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file = null;
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $Glyphs = new \ArPHP\I18N\Arabic();

        $NeoSans = resource_path('fonts/NeoSansW23-Medium.ttf');
        $IBM = resource_path('fonts/IBM Plex Arabic Regular.otf');
//            header("Content-type: image/jpg");
        $fz_default = 30;
        $imageKey = $this->file->image;
        $image = $this->file->letter->images[$imageKey] ?? $this->file->letter->images[0];
        $image_path = storage_path('app/original/' . $image);

        if (file_exists($image_path)) {
            $im = imagecreatefromjpeg($image_path);
            $letter = $this->file->letter;
//            $text_color = hex_color_allocate($im, $color);
//            $black = imagecolorallocate($im, 40, 40, 40);
//            $name = App::$arabic->utf8Glyphs(clean($this->subscription->user->name));
//            $en_name = $this->subscription->user->en_name;
//            $course = App::$arabic->utf8Glyphs($this->subscription->entity->title);
//            $en_corse = $this->subscription->entity->en_title;
//            $trainer_ar_name = App::$arabic->utf8Glyphs($this->subscription->entity->trainer->name);
//            $trainer_en_name = $this->subscription->entity->trainer->details->en_name;

            $imageInfo = $this->file->getImageInfo();
            $imageWidth = $imageInfo[0];
            $screenRatio = $imageWidth / $imageInfo[0];
            foreach ($letter->variable as $key => $var) {
//                $fzRatio = $imageInfo[0] / 800;

                $fz = intval(Str::replace('px', '', $letter->getStyle($key, 'font-size'))) ;

                $color = $letter->getStyle($key, 'color');
                $var_default_width = $letter->getStyle($key, 'width');
                if (Str::contains($var_default_width, '%')) {
                    $var_default_width = intval(Str::replace('%', '', $var_default_width));
                    $var_default_width = $var_default_width * $imageWidth / 100;
                }
//                $backColor = $letter->getStyle($key, 'background');
                $text_color = hex_color_allocate($im, $color);
//                $background_color = hex_color_allocate($im, $backColor);
                $val = $Glyphs->utf8Glyphs($this->file->variable[$key]??'asd');

                $fontwidth = ImageTTFBBox($fz, 0, $IBM, $val);
                $var_width = abs($fontwidth[4] - $fontwidth[0]);
                if ($var_default_width)
                    $center_width = ($var_default_width - $var_width) / 2;
                else
                    $center_width = 0;
//                dd($center_width);
                //                dump($var_width);
//                $name_x_pos = $imageWidth - ($name_width / 2);

//                imagerectangle($im,  0, $orig_height*0.8, 0, $orig_height, $bcolor);
                $a = (($var['x_' . $imageKey] ?? 50 * $screenRatio) + $center_width);
//                dd($var['y_' . $imageKey],$imageInfo[1]);
                imagettftext($im, $fz, 0, $a, $var['y_' . $imageKey]+70, $text_color, $IBM, $val);

            }
//            dd('asd');
//            imagettftext($im, $fz, 0, $name_x_pos, 490, $text_color, $NeoSans, $name);
//            imagettftext($im, $fz, 0, $en_name_x_pos, 490, $text_color, $NeoSans, $en_name);
//            imagettftext($im, 30, 0, $course_x_pos, 620, $text_color, $NeoSans, $course);
//            imagettftext($im, 25, 0, $trainer_ar_x_pos, 1055, $text_color, $NeoSans, $trainer_ar_name);
//            imagettftext($im, 25, 0, $trainer_en_x_pos, 1055, $text_color, $NeoSans, $trainer_en_name);
//            imagettftext($im, $fz, 0, $en_corse_x_pos, 620, $text_color, $NeoSans, $en_corse);
//            imagettftext($im, 23, 0, 1089, 750, $black, $Arial, $this->subscription->certificate_date ? $this->subscription->certificate_date->format('Y/m/d') : Carbon::now()->format('Y/m/d'));
//            imagettftext($im, 23, 0, 431, 750, $black, $Arial, $this->subscription->certificate_date ? $this->subscription->certificate_date->format('d/m/Y') : Carbon::now()->format('Y/m/d'));
//            imagettftext($im, 22, 0, 1276, 693, $black, $Arial, $this->subscription->entity->details->hours);
//            imagettftext($im, 22, 0, 594, 693, $black, $Arial, $this->subscription->entity->details->hours);
            $path = 'preview_files/' . Str::random('5') . '.jpg';
            if (!file_exists(public_path('preview_files')))
                mkdir(public_path('preview_files'), 0777);
            imagejpeg($im, public_path($path));
            $this->file->update([
                'image_preview' => $path,
                'preview_date' => Carbon::now(),
            ]);



//            generate pdf file
            return $path;

        }
        return false;
    }
}
