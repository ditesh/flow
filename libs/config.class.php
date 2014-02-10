<?php

class Config {

	public static function get($key, $section='application') {

                if (!is_array($GLOBALS['config']) || count($GLOBALS['config']) == 0 || (!is_null($key) && strlen($GLOBALS['config'][$section][$key]) == 0))
                        $GLOBALS['config'] = @parse_ini_file(LIB_PATH."/config.ini", TRUE);

                if (is_null($key) && is_array($GLOBALS['config'][$section]) && count($GLOBALS['config'][$section]) > 0)
                        return $GLOBALS['config'][$section];

                else if (strlen($GLOBALS['config'][$section][$key]) > 0)
                        return $GLOBALS['config'][$section][$key];

                return FALSE;

	}

	public static function getTemplateFilename($template) {

		$dir = self::get("template_path");
		$filename = "$dir/$template.tmpl";

		if (file_exists($filename))
			return $filename;

		return FALSE;

	}

	public static function getTemplate($template) {

		$filename = self::getTemplateFilename($template);

		if ($filename)
			return file_get_contents($filename);

		return FALSE;

	}
}

?>
