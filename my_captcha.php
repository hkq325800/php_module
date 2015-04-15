<?php
session_start();
ob_clean();
/**
*结果：$_SESSION['captchaResult']
**/
class My_captcha {
  // 公开接口，绘制验证码图像
  public static function draw($length, $width) {
    // 随机数字
    $num1 = rand(0, 9);
    $num2 = rand(0, 9);

    // 随机运算符 显示在图片上
    $operator = self::randOperator($num1, $num2);

    // 随机问号的位置
    $position_w=rand(0,2)*2;

    // 计算结果并将结果存入 SESSION
    self::setResult($num1, $num2, $operator, $position_w);

    // 创建图像
    $img = imagecreate($length, $width);

    // 背景颜色 
    imagecolorallocate($img, rand(230, 250), rand(230, 250), rand(230, 250));

    // 内容颜色
    $textColor = imagecolorallocate($img, 0, 0, 0);

    // 绘制图像
    self::imageSet($img,$length,$width,$textColor,$num1,$num2,$operator,$position_w);

    // 设置显示格式为图像
    header('Content-type: image/jpeg');
    imagejpeg($img);
    //echo $_SESSION['captchaResult'];
  }

  // 公开接口，判断用户输入的验证码是否正确
  public static function check ($captchaResult) {
    echo $_SESSION['captchaResult'];
    /*if (isset($_SESSION['captchaResult'])) {
      if ($captchaResult == $_SESSION['captchaResult']) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }*/
  }

  // 随机运算符
  private function randOperator($num1, $num2) {
    $operator[] = '-';
    $operator[] = '+';
    //$operator[] = '*';
    return $operator[rand(0,1)];
    /*if ($num1 < $num2) {
      return $operator[rand(1, 2)];
    } else {
      return $operator[rand(0, 2)];
    }*/
  }

  // 计算结果并将结果存入 SESSION
  private function setResult($num1, $num2, $operator, $position) {
    switch ($position) {//确定运算类型
      case '0':
      //$this->session->set_userdata('captchaResult', $operator=='-'?$num1+$num2:$num2-$num1);
        $_SESSION['captchaResult']=$operator=='-'?$num1+$num2:$num2-$num1;
        break;
      case '2':
      //$this->session->set_userdata('captchaResult', $operator=='-'?$num1-$num2:$num2-$num1);
        $_SESSION['captchaResult']=$operator=='-'?$num1-$num2:$num2-$num1;
        break;
      case '4':
      //$this->session->set_userdata('captchaResult', $operator=='-'?$num1-$num2:$num1+$num2);
        $_SESSION['captchaResult']=$operator=='-'?$num1-$num2:$num1+$num2;
        break;
      default:
        break;
    }
  }

  //设置图片
  private function imageSet($img,$length,$width,$textColor,$num1,$num2,$operator,$position_w){
    $rand0=rand(3, 5);
    $rand2=rand($width / 4.0, $width / 2.0);
    switch ($position_w) {
      case '0':$a='?';$b=$num1;$c=$num2;
        break;
      case '2':$a=$num1;$b='?';$c=$num2;
        break;
      case '4':$a=$num1;$b=$num2;$c='?';
        break;
      default:break;
    }
    imagestring($img, $rand0, rand(0 * ($length /5.0) + $length / 20.0, 0 * ($length / 5.0) + $length / 20.0 * 3.0), $rand2, $a, $textColor);
    imagestring($img, $rand0, rand(1 * ($length /5.0) + $length / 20.0, 1 * ($length / 5.0) + $length / 20.0 * 3.0), $rand2, $operator, $textColor);
    imagestring($img, $rand0, rand(2 * ($length /5.0) + $length / 20.0, 2 * ($length / 5.0) + $length / 20.0 * 3.0), $rand2, $b, $textColor);
    imagestring($img, $rand0, rand(3 * ($length /5.0) + $length / 20.0, 3 * ($length / 5.0) + $length / 20.0 * 3.0), $rand2, '=', $textColor);
    imagestring($img, $rand0, rand(4 * ($length /5.0) + $length / 20.0, 4 * ($length / 5.0) + $length / 20.0 * 3.0), $rand2, $c, $textColor);
  }
}