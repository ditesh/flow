<?php

class Render {

	public static function fixwebroot($data) {

		// A naive implementation to keep things really quick for now
		// Should be swapped out with an XML/regex parser and cached
		$path = Config::get("url_path");
		$jsBuster = Config::get("js_cache_buster");
		$cssBuster = Config::get("css_cache_buster");
		$data = str_replace(':webroot href="', ' href="'.$path, $data);
		$data = str_replace(':webroot src="', ' src="'.$path, $data);
//		$data = str_replace(".css", "-$cssBuster.css", $data);
//		$data = str_replace(".js", "-$jsBuster.js", $data);

		return $data;

	}

	public static function header($title, $css=array()) {

		$includes = "";
		$header = Config::getTemplate("header");
		$header = str_replace("{title}", $title, $header);

		foreach ($css as $file) {

			if (substr($file, 0, 4) == "http")
				$includes .= "<link href=\"$file\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />\n";
				
			else
				$includes .= "<link:webroot href=\"/resources/css/$file.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />\n";

		}

		$header = str_replace("<include:css />", $includes, $header);
		return self::fixwebroot($header);

	}

	public static function body($template, $data) {

		$filename = Config::getTemplateFilename($template);

		ob_start();
		require_once($filename);
		$body = ob_get_clean();

		foreach ($data as $key=>$value)
			$body = str_replace("{".$key."}", $value, $body);

		return self::fixwebroot($body);

	}

	public static function footer($templates=array(), $js=array()) {

		$includes = "";
		$footer = Config::getTemplate("footer");

		foreach ($templates as $file) {

			if (file_exists($file))
				$includes .= file_get_contents($file);

		}

		foreach ($js as $file)
			$includes .= "<script:webroot src=\"/resources/js/$file.js\"></script>\n";

		$footer = str_replace("<include:js />", $includes, $footer);

		return self::fixwebroot($footer);

	}
}

class RenderPrint {

	public static function header($title, $css=array()) {
		echo Render::header($title, $css);
	}

	public static function body($template, $data=array()) {
		echo Render::body($template, $data);
	}

	public static function footer() {
		echo Render::footer();
	}
}

?>
