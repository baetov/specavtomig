<?php

namespace app\components;

use yii\web\UploadedFile;

/**
 * Class MyUploadedFile
 * @package app\components
 */
class MyUploadedFile extends UploadedFile
{
    /**
     * @var array
     */
    private static $_files;

    /**
     * @param string $name
     * @param bool $findDistrict
     * @return array
     */
    public static function getInstancesByName($name, $findDistrict = false)
    {
        $files = static::loadFiles();
        if (isset($files[$name])) {
            return [new static($files[$name])];
        }
        $results = [];
        foreach ($files as $key => $file) {
            if($findDistrict == false){
                if (strpos($key, "{$name}[") === 0) {
                    $results[] = new static($file);
                }
            } else {
                if (strpos($key, "{$name}") !== false) {
                    $results[] = new static($file);
                }
            }
        }

        return $results;
    }


    /**
     * Creates UploadedFile instances from $_FILE.
     * @return array the UploadedFile instances
     */
    private static function loadFiles()
    {
        if (self::$_files === null) {
            self::$_files = [];
            if (isset($_FILES) && is_array($_FILES)) {
                foreach ($_FILES as $class => $info) {
                    self::loadFilesRecursive($class, $info['name'], $info['tmp_name'], $info['type'], $info['size'], $info['error']);
                }
            }
        }

        return self::$_files;
    }

    /**
     * Creates UploadedFile instances from $_FILE recursively.
     * @param string $key key for identifying uploaded file: class name and sub-array indexes
     * @param mixed $names file names provided by PHP
     * @param mixed $tempNames temporary file names provided by PHP
     * @param mixed $types file types provided by PHP
     * @param mixed $sizes file sizes provided by PHP
     * @param mixed $errors uploading issues provided by PHP
     */
    private static function loadFilesRecursive($key, $names, $tempNames, $types, $sizes, $errors)
    {
        if (is_array($names)) {
            foreach ($names as $i => $name) {
                self::loadFilesRecursive($key . '[' . $i . ']', $name, $tempNames[$i], $types[$i], $sizes[$i], $errors[$i]);
            }
        } elseif ((int) $errors !== UPLOAD_ERR_NO_FILE) {
            self::$_files[$key] = [
                'name' => $names,
                'tempName' => $tempNames,
                'type' => $types,
                'size' => $sizes,
                'error' => $errors,
            ];
        }
    }
}