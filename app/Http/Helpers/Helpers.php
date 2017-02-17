<?php
/**
 * Created by PhpStorm.
 * User: mst
 * Date: 17.2.2017 г.
 * Time: 11:01
 */

namespace App\Http\Helpers;


class Helpers
{
    const TH_WIDTH = 250;
    const TH_HEIGHT = 250;

    public static function makeThumbnail($updir, $filename)
    {
        $thumbnail_width = self::TH_WIDTH;
        $thumbnail_height = self::TH_HEIGHT;

        if (file_exists("../public/images/$updir")) {

            $arr_image_details = getimagesize("../public/images/$updir"); // pass id to thumb name

            $original_width = $arr_image_details[0];
            $original_height = $arr_image_details[1];

            if ($original_width > $original_height) {
                $new_width = $thumbnail_width;
                $new_height = intval($original_height * $new_width / $original_width);
            } else {
                $new_height = $thumbnail_height;
                $new_width = intval($original_width * $new_height / $original_height);
            }
            $dest_x = intval(($thumbnail_width - $new_width) / 2);
            $dest_y = intval(($thumbnail_height - $new_height) / 2);
            $imgt = "ImageGIF";

            if ($arr_image_details[2] == IMAGETYPE_GIF) {
                $imgt = "ImageGIF";
                $imgcreatefrom = "ImageCreateFromGIF";
            }
            if ($arr_image_details[2] == IMAGETYPE_JPEG) {
                $imgt = "ImageJPEG";
                $imgcreatefrom = "ImageCreateFromJPEG";
            }
            if ($arr_image_details[2] == IMAGETYPE_PNG) {
                $imgt = "ImagePNG";
                $imgcreatefrom = "ImageCreateFromPNG";
            }
            if ($imgt) {

                $old_image = $imgcreatefrom("../public/images/$updir");
                $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
                imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
                $imgt($new_image, "../public/images/articles/small_thumbnails/" . "$filename");
            }
            return true;
        } else {
            return false;
        }
    }



}