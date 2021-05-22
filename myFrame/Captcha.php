<?php
namespace myFrame;

class Captcha{
    /**
     * 自动生成验证码字符
     * @param int $count
     * @param string|null $charset
     * @return string
     */
    public function create(int $count = 5, string $charset = null){
        if (!$charset)
            $charset = array_merge(range('A','Z'),range('a','z'),range(1,9));
        $code = '';
        foreach (array_rand($charset, $count) as $value){
            $code .= $charset[$value];
        }
        return $code;
    }

    /**
     * 生成验证码图像
     * @param string $code
     * @param int $x
     * @param int $y
     * @throws HttpException
     */
    public function show(string $code = '', int $x = 250, int $y = 40){
        $image = imagecreate($x, $y);
        imagecolorallocate($image,138,174,226);
        $fontColor = imagecolorallocate($image,rand(0,155),rand(0,155),0);
        $fontFile = __DIR__.'/fonts/captcha.ttf';
        // mt_rand  PK  rand
        for ($i = 0, $len = strlen($code); $i < $len; ++$i) {
            imagettftext(
                $image,                                // 图像资源
                25,                                 // 字符尺寸
                mt_rand(0, 20) - mt_rand(0, 25),    // 随机设置字符倾斜角度
                32 + $i * 40,                       // 字符间距
                mt_rand(25, 30),                    // 随机设置字符坐标
                $fontColor,                         // 字符颜色
                $fontFile,                          // 字符样式
                $code[$i]                           // 字符内容
            );
        }
        for ($i=0;$i<10;$i++){
            $lineColor = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
            imageline($image,rand(0,$x),rand(0,$y),rand(0,$x),rand(0,$y),$lineColor);
        }
        for ($i=0;$i<500;$i++) {
            $pointColor = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($image,rand(0,$x),rand(0,$y),$pointColor);
        }
        $this->output($image);
    }

    /**
     * 输出图片
     * @param $image
     * @throws HttpException
     */
    protected function output($image){
        ob_start();
        imagepng($image);
        imagedestroy($image);
        $data = ob_get_contents();
        ob_end_clean();
        $header = ['Content-Type'=>'image/png'];
        throw new HttpException(Response::create($data,$header,200));
    }
}