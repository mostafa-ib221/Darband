<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 17/12/2016
 * Time: 19:15
 */

namespace App\Library;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Session;
//use Illuminate\Support\Facades\Session;
//use Symfony\Component\HttpFoundation\Session\Session;

class CropPic {
	//<editor-fold desc="Variables">
	private $DirPath = 'CropPic';
	private $imgFieldName = 'pic';
	private $CropPerName = 'Thumb_';//''Crop_';
	private $BaseDirPath = '/MostafaSharami09360170678/storage/app/';
	private $FlashMassege = 'CropPicCode';
	private $loadFuncName;
	private $input_imageCode = "code";
	private $input_imageType = "pic";
	private $LoadPicDivName = 'cropContainerMinimal';
	private $PeropertyName = 'croppicContaineroutputMinimal';
	private $StaticCropPicDir = "/static/%s/croppic";
	private $MoveGoalDirectory = '/static/images/upload/';
	private $StorePath = '';
	private $code;
	private $type;
	//</editor-fold>

	public function __construct($DirPath='CropPic', $imgFieldName='pic', $code='#', $type='@') {
		$this->imgFieldName = $imgFieldName;
		$this->DirPath = $DirPath;
		$this->loadFuncName = $this->DirPath . 'LoadFunc';
		if(($code != '#') && ($type != '@')){
			session([$this->FlashMassege => ['code'=>$code, 'type'=>$type]]);
			$this->code = $code; $this->type = $type;
		}
	} // END function __construct()

	//<editor-fold desc="Main Functions">
	public function ImgSaveToFile(Request $request, $code=null) {
		/*
		*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
		*/
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
		if($code === null) $code = md5(time());
		$file = $request->file($this->imgFieldName);
		//return $file->getClientOriginalName();
		$type = explode('.', $file->getClientOriginalName());
		$type = $type[count($type) - 1];

		// Code in Session
		/*$codes = array();
		if(Session::has($this->FlashMassege))
			$codes = Session::get($this->FlashMassege);
		$codes[] = $code;
		Session::flash($this->FlashMassege, $codes);*/
		//Session::flash($this->FlashMassege, $code);
		session([$this->FlashMassege => ['code'=>$code, 'type'=>$type]]);

		$path = $file->storeAs($this->DirPath, $code.'.'.$type);
		if($path) {
			$filename = $_FILES[$this->imgFieldName]["tmp_name"];
			list($width, $height) = getimagesize( $filename );
			$response = array(
					"status" => 'success',
					"statusBool" => true,
					"url" => $this->BaseDirPath . $this->DirPath . '/' . $code . '.' . $type,
					"onStorage" => $this->DirPath . '/' . $code . '.' . $type,
					"image" => $code . '.' . $type,
					"width" => $width,
					"height" => $height,
					"code" => $code,
					"type" => $type
			);
		} else {
			$response = Array(
					"status" => 'error',
					"statusBool" => false,
					"message" => 'Can`t upload File; no write Access'
			);
		}
		return $response;
		return json_encode($response);


		$extension = end($temp);

		//Check write Access to Directory
		if(!is_writable($imagePath)){
			$response = Array(
				"status" => 'error',
				"message" => 'Can`t upload File; no write Access'
			);
			print json_encode($response);
			return;
		}

		if ( in_array($extension, $allowedExts)) {
			if ($_FILES[$this->imgFieldName]["error"] > 0) {
				$response = array(
					"status" => 'error',
					"message" => 'ERROR Return Code: '. $_FILES[$this->imgFieldName]["error"],
				);
			} else {
				$filename = $_FILES[$this->imgFieldName]["tmp_name"];
				list($width, $height) = getimagesize( $filename );

				move_uploaded_file($filename,  $imagePath . $_FILES[$this->imgFieldName]["name"]);

				$response = array(
					"status" => 'success',
					"url" => $imagePath.$_FILES[$this->imgFieldName]["name"],
					"width" => $width,
					"height" => $height
				);
			}
		} else {
			$response = array(
				"status" => 'error',
				"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
			);
		}

		return json_encode($response);
	} // END function ImgSaveToFile()

	public function ImgCropToFile($post = true) {
		//$codes = session($this->FlashMassege);
		/*
		*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
		*/
		$imgUrl = $_POST['imgUrl'];
		// original sizes
		$imgInitW = $_POST['imgInitW'];
		$imgInitH = $_POST['imgInitH'];
		// resized sizes
		$imgW = $_POST['imgW'];
		$imgH = $_POST['imgH'];
		// offsets
		$imgY1 = $_POST['imgY1'];
		$imgX1 = $_POST['imgX1'];
		// crop box
		$cropW = $_POST['cropW'];
		$cropH = $_POST['cropH'];
		// rotation angle
		$angle = $_POST['rotation'];

		$jpeg_quality = 100;

		$imgUrl = $this->mackStorePath($imgUrl);

		$output_filename = $this->mackOutputPath($imgUrl);

		$what = getimagesize($imgUrl);
		switch(strtolower($what['mime'])) {
			case 'image/png':
				$img_r = imagecreatefrompng($imgUrl);
				$source_image = imagecreatefrompng($imgUrl);
				$type = '.png';
				break;
			case 'image/jpeg':
				$img_r = imagecreatefromjpeg($imgUrl);
				$source_image = imagecreatefromjpeg($imgUrl);
				error_log("jpg");
				$type = '.jpeg';
				break;
			case 'image/gif':
				$img_r = imagecreatefromgif($imgUrl);
				$source_image = imagecreatefromgif($imgUrl);
				$type = '.gif';
				break;
			default: die('image type not supported');
		}

		//Check write Access to Directory
		if(!is_writable(dirname($output_filename))) {
			$response = Array(
				"status" => 'error',
				"message" => 'Can`t write cropped File'
			);
		} else {
			// resize the original image to size of editor
			$resizedImage = imagecreatetruecolor($imgW, $imgH);
			imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
			// rotate the rezized image
			$rotated_image = imagerotate($resizedImage, -$angle, 0);
			// find new width & height of rotated image
			$rotated_width = imagesx($rotated_image);
			$rotated_height = imagesy($rotated_image);
			// diff between rotated & original sizes
			$dx = $rotated_width - $imgW;
			$dy = $rotated_height - $imgH;
			// crop rotated image to fit into original rezized rectangle
			$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
			imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
			imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
			// crop image into selected area
			$final_image = imagecreatetruecolor($cropW, $cropH);
			imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
			imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
			// finally output png image
			imagejpeg($final_image, $output_filename, $jpeg_quality);
			$response = Array(
				"status" => 'success',
				"url" => $this->mackShowPath($output_filename)
			);
		}
		//session($this->FlashMassege, $codes);
		return json_encode($response);
	} // END function ImgCropToFile()
	//</editor-fold>

	//<editor-fold desc="Path and Store Functions">
	/*public function getCodes($flash = true) {
		$codes = '';
		if(Session::has($this->FlashMassege)) {
			if ($flash) {
				$codes = Session::get($this->FlashMassege);
				Session::flash($this->FlashMassege, $codes);
			} else $codes = session($this->FlashMassege);
		} else $codes = 'no session';
		return $codes;
	}*/ // END function getCodes()
	/**
	 * return Code and clear garbage image. if not exist return false
	 * @param string $type : type of image files
	 * @return string|bool
	 */
	private function getCodeOLD() {
		if(Session::has($this->FlashMassege)) {
			//$codes = Session::get($this->FlashMassege);
			$codes = session($this->FlashMassege);
			return $codes;
			/*$type = '.' . $code['type'];
			$code = $code['code'];*/
			/*if(count($codes) == 1) {
				return $codes;
			} else {
				if($type !== false) {
					for($i=0; $i<count($codes)-2; $i++) {
						// delete $codes[$i]
						$delPath = $this->mackStorePathByCode($codes[$i], true, $type);
						if (file_exists($delPath[0])) unlink($delPath[0]);
						if (file_exists($delPath[1])) unlink($delPath[1]);
				}} return $codes[count($codes)-1];
			}*/
		} else return false;
	} // END function getCodeOLD()
	public function getCode() {
		if(($ret = $this->getCodeFromSession()) === false) {
			if(($ret = $this->getCodeFromFiles()) === false) {
				$ret = $this->getCodeFromPublicVariables();
			}
		} return $ret;
	} // END function getCode()
	private function getCodeFromSession() {
		if(Session::has($this->FlashMassege)) {
			//$codes = Session::get($this->FlashMassege);
			$codes = session($this->FlashMassege);
			return $codes;
		} else return false;
	} // END function getCodeFromSession()
	private function getCodeFromFiles() {
		return false;
	} // END function getCodeFromSession()
	private function getCodeFromPublicVariables() {
		if(isset($this->code) && isset($this->type)) {
			return ['code'=>$this->code, 'type'=>$this->type];
		}
		return false;
	} // END function getCodeFromPublicVariables()
	/**
	 * Move two files in /static/images/upload/[$goalDirectory]/
	 * @param string $goalDirectory
	 * @param bool|true $double
	 *          if false, Thumb_[CODE] only move and rename to [CODE]
	 * @return array|bool
	 */
	public function MoveFiles($goalDirectory = 'portfolio', $double=true) {
		//$code = $this->getCode(false);
		$code = $this->getCode();
		if($code !== false) {
			$typeGetOut = $code['type'];
			$type = '.' . $typeGetOut;
			$code = $code['code'];
			if($code !== false) {
				$fromPath = $this->mackStorePath();
				/*$toPath = $this->MoveGoalDirectory . $goalDirectory . DIRECTORY_SEPARATOR;
				$toPath = getcwd() . str_replace('/', DIRECTORY_SEPARATOR, $toPath);*/
				$toPath = $this->mackGoalPath($goalDirectory);
				if(!file_exists($toPath))
					if(!mkdir($toPath, 0777, true))
						return false;
				if($double) {
					if (file_exists($fromPath.$code.$type))
						rename ($fromPath.$code.$type, $toPath.$code.$type);
					else return false;
					if (file_exists($fromPath.$this->CropPerName.$code.$type)) {
						rename($fromPath.$this->CropPerName.$code.$type, $toPath.$this->CropPerName.$code.$type);
					} else { unlink($toPath.$code.$type); return false;
				}} else {
					if (file_exists($fromPath.$this->CropPerName.$code.$type))
						rename ($fromPath.$this->CropPerName.$code.$type, $toPath.$code.$type);
					else return false;
			}} return array(['code'=>$code, 'type'=>$typeGetOut]);
		} return false;
	} // END function moveFiles()
	/** delete all files in store path */
	public function DeleteGarbageFiles() {
		$path = $this->mackStorePath();
		$files = scandir($path);
		$files[0] = $path;
		if(count($files) > 2)
			for($i=2; $i<count($files); $i++)
				if (file_exists($path.$files[$i]))
					unlink($path.$files[$i]);
	} // END function DeleteGarbageFiles()
	/**
	 * Move uploaded images and Delete other files
	 * @param string $goalDirectory
	 * @param bool|true $double
	 * @return array|bool
	 */
	public function getCodeAndMoveFilesAndDeleteGarbageFiles($goalDirectory='portfolio', $double=true) {
		$code = $this->MoveFiles($goalDirectory, $double);
		if($code !== false) $this->DeleteGarbageFiles();
		return $code;
	}

	/**
	 * mack store path: C:\laragon\www\Hatam\MostafaSharami09360170678\storage\app\CropPic
	 * @param string $path
	 * @return mixed|string
	 */
	private function mackStorePath($path = '') {
		if($this->StorePath === '') {
			if ($path == '') $path = $this->BaseDirPath . $this->DirPath . DIRECTORY_SEPARATOR;
			$imgPath = (strpos($path, '/') >= 0) ? str_replace('/', DIRECTORY_SEPARATOR, $path) : $path;
			$imgPath = getcwd() . $imgPath;
			$this->StorePath = $imgPath;
		}else $imgPath = $this->StorePath;
		return $imgPath;
	} // END function mackStorePath()

	/**
	 * mack store path: C:\laragon\www\SepehrSazeh\static\images\upload\$path\
	 * @param string $path
	 * @return mixed|string
	 */
	private function mackGoalPath($path = null) {
		//if($path == null) return false;
		if($path == null) $path = $this->DirPath;
		//$path = $this->MoveGoalDirectory . $path . DIRECTORY_SEPARATOR;
		//$path = $this->MoveGoalDirectory . $path . DIRECTORY_SEPARATOR;
		$path = $this->BaseDirPath . $path . DIRECTORY_SEPARATOR;
		$path = getcwd() . str_replace('/', DIRECTORY_SEPARATOR, $path);
		return $path;
	} // END function mackStorePath()
	/**
	 * give code and return full store path
	 *      C:\laragon\www\Hatam\MostafaSharami09360170678\storage\app\CropPic\CODE.jpg
	 *      C:\laragon\www\Hatam\MostafaSharami09360170678\storage\app\CropPic\Thumb_CODE.jpg
	 * @param $code
	 * @param bool|true $double : if true, mack two path, with and without $CropPerName (Thumb_)
	 * @param string $type : type of image files
	 * @return array|string
	 */
	public function mackStorePathByCode($code, $double=true, $type='.jpg') {
		$path = $this->mackStorePath();
		if(stripos($type, '.') != 0) $type = '.' . $type;
		if($double) {
			return array(
				$path . $code . $type,
				$path . $this->CropPerName . $code . $type
			);
		} return $path . $code . $type;
	} // END function mackStorePathByCode()

	/**
	 * mack store path: /MostafaSharami09360170678/storage/app/CropPic/
	 * @param string $path
	 * @return string
	 */
	private function mackShowPath($path = '') {
		if($path == '') return $this->BaseDirPath . $this->DirPath . '/';
		$filename = substr($path, strrpos($path, DIRECTORY_SEPARATOR) + 1);
		return $this->BaseDirPath . $this->DirPath . '/' . $filename;
	} // END function mackShowPath()
	/**
	 * give code and return full show path
	 *      /MostafaSharami09360170678/storage/app/CropPic/CODE.jpg
	 *      /MostafaSharami09360170678/storage/app/CropPic/Thumb_CODE.jpg
	 * @param $code
	 * @param bool|true $double
	 * @param string $type
	 * @return array|string
	 */
	public function mackShowPathByCode($code, $double=true, $type='.jpg') {
		$path = $this->mackShowPath();
		if(stripos($type, '.') != 0) $type = '.' . $type;
		if($double)
			return array(
				$path . $code . $type,
				$path . $this->CropPerName . $code . $type
			);
		return $path . $code . $type;
	} // END function mackShowPathByCode()

	/**
	 * mack output path for upload pictures
	 * @param string $path
	 * @return mixed|string
	 */
	private function mackOutputPath($path = '') {
		$type = '';
		if($path != '') {
			$type = substr($path, strrpos($path, '.') + 1);
			$output_filename = substr($path, 0, strlen($path) - strlen($type) - 1);
			$type = '.' . $type;
		} else $output_filename = $this->mackStorePath();
		$tmp_filename = substr($output_filename, strrpos($output_filename, DIRECTORY_SEPARATOR)+1);
		$output_filename = substr($output_filename, 0, strlen($output_filename) - strlen($tmp_filename));
		$tmp_filename = $this->CropPerName . $tmp_filename . $type;
		$output_filename .= $tmp_filename;
		return $output_filename;
	} // END function mackOutputPath()

	/**
	 * @param string $goalDirectory
	 * @param string $code
	 * @param string $type
	 * @return bool|void
	 */
	public function delete($code=null, $type=null) {
	//public function delete($goalDirectory = 'portfolio', $code=null, $type=null) {
		$ret = false;
		try {
			//if ($goalDirectory == null) return;
			if (($code != null) && ($type == null)) {
				$code = explode('.', $code);
				$type = $code[1];
				$code = $code[0];
			} elseif (($code == null) && ($type == null)) {
				if (($getCode = $this->getCode()) !== false) {
					$code = $getCode['code'];
					$type = $getCode['type'];
				} else return false;
			}
			//$path = $this->mackGoalPath($goalDirectory);
			$path = $this->mackGoalPath($this->DirPath);
			//return $path;
			//$path = $this->BaseDirPath . $this->DirPath . '/';

			$del = $path . $code . '.' . $type;
			//return $del;
			//return $del."<br />" . (file_exists($path . $code . '.' . $type) ? 'Exist' : 'not Exist');

			if (file_exists($path . $code . '.' . $type)) {
				unlink($path . $code . '.' . $type);  $ret = true;
			} else $ret = false;
			if (file_exists($path . $this->CropPerName . $code . '.' . $type)) {
				unlink($path . $this->CropPerName . $code . '.' . $type); $ret = true;
			} else $ret = $ret || false;
		} catch(Exception $e) {return false;}
		return $ret;
	} // END function delete()
	//</editor-fold>

	//<editor-fold desc="Mack UI Functions">
	//<editor-fold desc="Links to JS and CSS">
	/**
	 * link tags for main.css and croppic.css
	 * @return string
	 */
	public function CssLinks() {
		$CssDir = sprintf($this->StaticCropPicDir,'css');
		$ret = "\n".sprintf('<link href="%s/main.css" rel="stylesheet" />',$CssDir);
		$ret.= "\n".sprintf('<link href="%s/croppic.css" rel="stylesheet" />',$CssDir);
		return $ret."\n";
	}
	/**
	 * script tags for croppic.min.js and main.js
	 * @param bool|true $WhiteJQuery : script tag for jquery-2.1.3.min.js
	 * @return string
	 */
	public function JsLinks($WhiteJQuery=true) {
		$JsDir = sprintf($this->StaticCropPicDir,'js');
		$ret = (!$WhiteJQuery) ? "" :
				"\n".'<script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>';
		//$ret.= "\n".sprintf('<script src="%s/croppic.min.js"></script>',$JsDir);
		$ret.= "\n".sprintf('<script src="%s/croppic.js"></script>',$JsDir);
		$ret.= "\n".sprintf('<script src="%s/main.js"></script>',$JsDir);
		return $ret."\n";
	}
	/**
	 * join two upper functions
	 * @return string
	 */
	public function CssAndJsLinks($WhiteJQuery=true) {return $this->CssLinks() . $this->JsLinks($WhiteJQuery);}
	//</editor-fold>
	//<editor-fold desc="HTML">
	/**
	 * load function. best place in body tag
	 * @return string
	 */
	public function LoadFuncInBody() {return ' onload="'.$this->loadFuncName.'();"';}
	/**
	 * input (form item) for code and type of image
	 * @return string
	 */
	public function CodeAndTypeInput() {
		$ret = '<input type="hidden" name="'.$this->input_imageCode.'" id="'.$this->input_imageCode.'" />';
		$ret.= '<input type="hidden" name="'.$this->input_imageType.'" id="'.$this->input_imageType.'" />';
		return $ret;
	} // END function CodeAndTypeInput()
	/**
	 * div tag of show and crop uploaded image
	 *      $width and $height for calculate Ratio of width to height of cropped image
	 * @param int $width
	 * @param int $height
	 * @param int $divWidth: if want div tag be smaller of self place
	 * @return string
	 */
	public function LoadPicDiv($width=600, $height=400, $divWidth=100) {
			$ret = "\n".'<div id="'.$this->LoadPicDivName.'"';
			if($divWidth < 100) $ret.= ' style="width: '.$divWidth.'%; margin: 0 auto"';
			$ret.= ' data-width="'.$width.'"';
			$ret.= ' data-height="'.$height.'">';
			$ret.= '</div>'."\n";
			return $ret;
		} // END function LoadPicDiv()
	/**
	 * image info: input tags for code and type, and div tag for upload
	 * @param int $width
	 * @param int $height
	 * @param int $divWidth
	 * @return string
	 */
	public function inBodyTag($width=600, $height=400, $divWidth=100) {
		$ret = "\n";
		$ret.= $this->CodeAndTypeInput()."\n";
		$ret.= $this->LoadPicDiv($width, $height, $divWidth)."\n";
		return $ret;
	} // END function inBodyTag()
	//</editor-fold>
	//<editor-fold desc="JavaScript">
	/**
	 * public JS variables for inputs (id and name) of code and type of image
	 * @return string
	 */
	public function CodeAndTypeInput_NameAndIdVar() {
		$ret = 'var input_imageCode = "'.$this->input_imageCode.'";';
		$ret.= 'var input_imageType = "'.$this->input_imageType.'";';
		return $ret;
	}
	/**
	 * mack property JS variable for upload image
	 * @return string
	 */
	public function PropertyJsVar() {
		$ret = "\n\t".'var csrf = $("input[name=_token]").val();'."\n";
		$ret.= "\n\t".'if(csrf == undefined) csrf = $("#_token").val();'."\n";
		$ret.= "\n\t".'var ' . $this->PeropertyName . ' = {'."\n";
			/*$ret.= "\t\t".'uploadUrl:"http://hatam.dev/CropPic/ImgSaveToFile",'."\n";
			$ret.= "\t\t".'cropUrl:"http://hatam.dev/CropPic/ImgCropToFile",'."\n";*/
			$ret.= "\t\t".'csrf:csrf,'."\n";
			$ret.= "\t\t".'uploadUrl:"/CropPic/ImgSaveToFile",'."\n";
			$ret.= "\t\t".'cropUrl:"/CropPic/ImgCropToFile",'."\n";
			$ret.= "\t\t".'modal:false,'."\n";
			$ret.= "\t\t".'doubleZoomControls:false,'."\n";
			$ret.= "\t\t".'rotateControls: false,'."\n";
			$ret.= "\t\t".'loaderHtml:\'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> \','."\n";
			$ret.= "\t\t".'onBeforeImgUpload: function(){ console.log("onBeforeImgUpload") },'."\n";
			$ret.= "\t\t".'onAfterImgUpload: function(){ console.log("onAfterImgUpload") },'."\n";
			$ret.= "\t\t".'onImgDrag: function(){ console.log("onImgDrag") },'."\n";
			$ret.= "\t\t".'onImgZoom: function(){ console.log("onImgZoom") },'."\n";
			$ret.= "\t\t".'onBeforeImgCrop: function(){ console.log("onBeforeImgCrop") },'."\n";
			$ret.= "\t\t".'onAfterImgCrop:function(){ console.log("onAfterImgCrop") },'."\n";
			$ret.= "\t\t".'onReset:function(){ console.log("onReset") },'."\n";
			$ret.= "\t\t".'onError:function(errormessage){ console.log("onError:"+errormessage) }'."\n";
		$ret.= "\t".'}'."\n";
		return $ret;
	} // END function PropertyJsVar()
	/**
	 * js function for calculate Ratio of width to height of cropped image
	 * and set for upload div tag.
	 * this function call into onLoad
	 * @return string
	 */
	public function LoadFunc() {
		$ret = "\n\t".'function '.$this->loadFuncName.'() {'."\n";
			$ret.= "\t\t".'var div = document.getElementById("'.$this->LoadPicDivName.'");'."\n";
			$ret.= "\t\t".'var divWidth = div.offsetWidth;'."\n";
			$ret.= "\t\t".'var imgWidth = div.getAttribute("data-width");'."\n";
			$ret.= "\t\t".'var imgHeight = div.getAttribute("data-height");'."\n";
			$ret.= "\t\t".'var divHeight = parseInt((imgHeight / imgWidth) * divWidth);'."\n";
			$ret.= "\t\t".'div.style.height = divHeight + "px";'."\n";
			$ret.= "\t\t".'new Croppic("'.$this->LoadPicDivName.'", '.$this->PeropertyName.');'."\n";
		$ret.= "\t".'}'."\n";
		return $ret;
	} // END function LoadFunc()
	/**
	 * join two upper function and variable into an script tag
	 * @return string
	 */
	public function CompleteJsFunc() {
		$ret = "\n".'<script>';
			$ret.= $this->CodeAndTypeInput_NameAndIdVar();
			$ret.= $this->PropertyJsVar();
			$ret.= $this->LoadFunc();
		$ret.= '</script>'."\n";
		return $ret;
	} // END function CompleteJsFunc()
	//</editor-fold>
	//---------------------------------------------------------------------------------
	/**
	 * div tag of show and crop uploaded image
	 * script tag of JS function and variable
	 * @param int $width
	 * @param int $height
	 * @param bool|false $WhiteJs
	 * @param bool|true $WhiteJQuery
	 * @return string
	 */
	public function CompleteInBody($width=600, $height=400, $WhiteJs=false, $WhiteJQuery=true) {
		$ret = !$WhiteJs ? "" : "\n".$this->JsLinks($WhiteJQuery);
		$ret.= "\n".$this->inBodyTag($width, $height)."\n";
		$ret.= $this->CompleteJsFunc()."\n";
		return $ret;
	} // END function CompleteInBody()
	/**
	 * div tag of show and crop uploaded image
	 * script tag of JS function and variable
	 * @param int $width
	 * @param int $height
	 * @param bool|false $WhiteJs
	 * @param bool|true $WhiteJQuery
	 * @return string
	 */
	public function CompleteInHTML($width=600, $height=400, $WhiteJs=false, $WhiteJQuery=true) {
		//return $WhiteJQuery ? 'TRUE' : 'FALSE';
		$ret = (!$WhiteJs) ? "" : "\n".$this->JsLinks($WhiteJQuery);
		$ret.= "\n".$this->inBodyTag($width, $height)."\n";
		$ret.= $this->CssAndJsLinks($WhiteJQuery)."\n";
		$ret.= $this->CompleteJsFunc()."\n";
		return $ret;
	} // END function CompleteInBody()
	//</editor-fold>
} // END class CropPic

/**
 * -----------------------------------------------------------------------------
 * ============================== Scenario of Use ==============================
 * -----------------------------------------------------------------------------
 * :::::::::::::::::::::::::::::::::: in  PHP ::::::::::::::::::::::::::::::::::
 * .................... Send to HTML:
 * return view('viewFile', array('CropPic' => new CropPic()));
 * .................... Use in PHP:
 * $CropPic = new CropPic();
 * $info = $CropPic->getCodeAndMoveFilesAndDeleteGarbageFiles('myFolderName', true);
 *          1-if not exist uploaded files return (false)
 *          2-if exist return array by two value ($info['code'] and info['type'])
 *          3-if parameter #2 in be false, only Thumb_CODE move and rename to CODE
 * :::::::::::::::::::::::::::::::::: in HTML ::::::::::::::::::::::::::::::::::
 * .................... Example 1:
 *  <head>
 *      ...
 *      {!! $CropPic->CssAndJsLinks() !!}
 *      ...
 *  </head>
 *  <body{!! $CropPic->LoadFuncInBody() !!}>
 *      ...
 *      {!! $CropPic->CompleteInBody() !!}
 *      ...
 *  </body>
 *
 * .................... Example 2:
 *  <head>
 *      ...
 *      {!! $CropPic->CssLinks() !!}
 *      ...
 *  </head>
 *  <body{!! $CropPic->LoadFuncInBody() !!}>
 *      ...
 *      {!! $CropPic->CompleteInBody(600, 400, true) !!}
 *      ...
 *  </body>
 *
 * .................... Example 3:
 *  <head>
 *      ...
 *      {!! $CropPic->CssAndJsLinks() !!}
 *      ...
 *  </head>
 *  <body{!! $CropPic->LoadFuncInBody() !!}>
 *      ...
 *      {!! $CropPic->LoadPicDiv() !!}
 *      ...
 *      {!! $CropPic->CompleteJsFunc() !!}
 *      ...
 *  </body>
 *
 * .................... Example 4:
 *  <head>
 *      ...
 *      {!! $CropPic->CssLinks() !!}
 *      ...
 *  </head>
 *  <body{!! $CropPic->LoadFuncInBody() !!}>
 *      ...
 *      {!! $CropPic->LoadPicDiv() !!}
 *      ...
 *      {!! $CropPic->JsLinks() !!}
 *      ...
 *      {!! $CropPic->CompleteJsFunc() !!}
 *      ...
 *  </body>
 *
 * .................... Example 5:
 *  <head>
 *      ...
 *      {!! $CropPic->CssLinks() !!}
 *      ...
 *  </head>
 *  <body{!! $CropPic->LoadFuncInBody() !!}>
 *      ...
 *      {!! $CropPic->LoadPicDiv() !!}
 *      ...
 *      {!! $CropPic->JsLinks() !!}
 *      ...
 *      <script>
 *          {!! $CropPic->PropertyJsVar() !!}
 *          {!! $CropPic->LoadFunc() !!}
 *      </script>
 *      ...
 *  </body>
 */
