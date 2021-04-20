<?php

namespace App\Services;

class Service
{
    /**
     * Status update exists.
     *
     * @param  int  $id
     * @param  Model  $model
     */
    public static function UpdateFlagDelete(int $id,$model)
    {
        $model::where('id',$id)->update(
            [
                'flag_delete' => INACTIVE
            ]
        );
    }

    /**
     * Remove the element from the model.
     *
     * @param  int  $id
     * @param  Model  $model
     */
    public static function destroy(int $id,$model)
    {
        $model::where('id',$id)->delete();
    }

    /**
     * Save the image to public and return the image name.
     *
     * @param  Request  $request
     * @return  String $fileName
     */
    public static function uploadimg($request)
    {
        $file =  $request->file('avatar');
        $fileName = time() . '1.' . $file -> getClientOriginalExtension();
        $request -> avatar -> move(public_path('/upload/avatar'), $fileName);

        return $fileName;
    }

    /**
     * Save the image to public and return the image name.
     *
     * @param  Request  $request
     * @return  String $fileName
     */
    public static function uploadimg_background($request)
    {
        $file2 =  $request->file('background');
        $fileName2 = time() . '2.' . $file2 -> getClientOriginalExtension();
        $request -> background -> move(public_path('/upload/avatar'), $fileName2);

        return $fileName2;
    }

    /**
     * Save the image to public and return the image name.
     *
     * @param  Request  $request
     * @return  String $fileName
     */
    public static function uploadLink_trailer($request)
    {
        $file3 =  $request->file('link_trailer');
        $fileName3 = time() . '.' . $file3 -> getClientOriginalExtension();
        $request -> link_trailer -> move(public_path('/upload/mp4'), $fileName3);

        return $fileName3;
    }
}
