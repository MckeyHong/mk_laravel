<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Image;

class ImageController extends Controller
{
    /**
     * 介面：圖片處理
     * ref：http://image.intervention.io/
     * @return layout image
     */
    public function getIndex($type = '')
    {
        $img = Image::make(public_path().'/images/demo.jpg');
        switch ($type) {
            /* 模糊 */
            case 'blur':
                $img = $img->blur(15);
            break;
            /* 倒轉 */
            case 'flip':
                $img = $img->flip('v');
            break;
            /* 裁剪 */
            case 'resize':
                $img = $img->resize(300, 150);
            break;
            /* 亮化 */
            case 'brightness':
                $img = $img->brightness(35);
            break;
            /* 灰階 */
            case 'greyscale':
                $img = $img->greyscale();
            break;
            /* 製作圖像 */
            case 'canvas':
                $img = Image::canvas(800, 600, '#ccc');
            break;
            default:
        }

        return $img->response('jpg');
    }

}
