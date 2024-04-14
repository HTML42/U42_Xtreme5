<?php
class Image
{
    public static function x_2_webp($image)
    {
        $image_type = self::get_image_type($image);

        switch ($image_type) {
            case 'png':
                return file_get_contents(self::png_2_webp($image));
            case 'jpg':
                return file_get_contents(self::jpg_2_webp($image));
            case 'gif':
                return file_get_contents(self::gif_2_webp($image));
            default:
                throw new Exception("Unsupported image type: " . $image_type);
        }
    }
    public static function png_2_webp($image)
    {
        $im = imagecreatefrompng($image);
        if (!$im) {
            throw new Exception("Could not create image from PNG");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function jpg_2_webp($image)
    {
        $im = imagecreatefromjpeg($image);
        if (!$im) {
            throw new Exception("Could not create image from JPG");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function gif_2_webp($image)
    {
        $im = imagecreatefromgif($image);
        if (!$im) {
            throw new Exception("Could not create image from GIF");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function get_image_type($image)
    {
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        return $ext;
    }
    public static function resize_to_max_width($imageContent, $max_width)
    {
        $source_image = imagecreatefromstring($imageContent);
        list($width, $height) = getimagesizefromstring($imageContent);

        if ($width <= $max_width) {
            return $imageContent;
        }

        $ratio = $max_width / $width;
        $new_height = $height * $ratio;

        $new_image = imagecreatetruecolor($max_width, $new_height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $transparent);

        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $max_width, $new_height, $width, $height);

        ob_start();
        imagewebp($new_image, null, 90);
        $resized_image = ob_get_clean();

        imagedestroy($new_image);
        imagedestroy($source_image);

        return $resized_image;
    }
    public static function resize_to_max_height($imageContent, $max_height)
    {
        $source_image = imagecreatefromstring($imageContent);
        list($width, $height) = getimagesizefromstring($imageContent);

        if ($height <= $max_height) {
            return $imageContent;
        }

        $ratio = $max_height / $height;
        $new_width = $width * $ratio;

        $new_image = imagecreatetruecolor($new_width, $max_height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $transparent);

        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $max_height, $width, $height);

        ob_start();
        imagewebp($new_image, null, 90);
        $resized_image = ob_get_clean();

        imagedestroy($new_image);
        imagedestroy($source_image);

        return $resized_image;
    }

}