<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Image Formats
|--------------------------------------------------------------------------
|
| Used by the custom html helper img_format() function where the 'format' 
| parameter needs to correspond with a key in the following array of 
| image formats.
|
| Key and value pairs correspond with class settings as outlined at
| http://www.verot.net/php_class_upload.htm in Colin Verots class
| upload script.
|
| Example format:
| $config['image_formats']['small_gif'] = array('image_resize'=>TRUE, 'image_convert'=>'gif', 'image_x'=>100, 'image_ratio_y'=>TRUE);
|
| Usage:
| echo img_format('upload/default.jpg', 'small_gif');
|
*/

$config['image_formats']['stamp'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>70, 'image_y'=>70,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['stamppng'] = array('image_resize'=>true, 'image_convert'=>'png', 'image_x'=>70, 'image_y'=>70,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['thumb'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>180, 'image_y'=>200,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['thumbpng'] = array('image_resize'=>true, 'image_convert'=>'png', 'image_x'=>180, 'image_y'=>200,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['sthumb'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>117, 'image_y'=>130,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['sthumbpng'] = array('image_resize'=>true, 'image_convert'=>'png', 'image_x'=>117, 'image_y'=>130,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['macro'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>60, 'image_y'=>60,'image_ratio'=>false,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['bthumb'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>200, 'image_y'=>100,'image_ratio'=>true,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['birthmonth'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>230, 'image_y'=>258,'image_ratio'=>true,'jpeg_quality'=>90,'image_unsharp'=>'true');
$config['image_formats']['birthmonthitem'] = array('image_resize'=>true, 'image_convert'=>'jpg', 'image_x'=>150, 'image_y'=>167,'image_ratio'=>true,'jpeg_quality'=>90,'image_unsharp'=>'true');

/* End of file my_image_formats.php */
/* Location: ./system/application/config/my_image_formats.php */  