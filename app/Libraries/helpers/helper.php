<?php
if (!function_exists('uploadImages')) {
    /**
     * It takes an image and a destination, and uploads the image to the destination.
     *
     * @param image The image file that you want to upload.
     * @param destination The destination folder where you want to upload the image.
     * @return The name of the image.
     */
    function uploadImages($image, $destination)
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($destination);
        $image->move($destinationPath, $name);

        return $name;
    }
}
?>