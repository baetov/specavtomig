<?php

namespace app\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class DocxForm
 * @package app\models\forms
 */
class DocxForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            ['file', 'file'],
        ];
    }

    /**
     * @return string
     */
    public function parse()
    {
        if(is_dir('documents') == false){
            mkdir('documents');
        }

        $this->file->saveAs('documents/tmp.'.$this->file->extension);

        if($this->file->extension == 'docx'){
            $zip = new \ZipArchive();

            if($zip->open('documents/tmp.docx') === true){
                $index = $zip->locateName('word/document.xml');

                $text = $zip->getFromIndex($index);

                $parser = new \SimpleXMLElement($text);

                $parser->asXML();

                $text = trim(strip_tags($parser->asXML()));
                $text = str_replace("\n", '', $text);
                $text = str_replace("\r", '', $text);
                $text = str_replace("\t", '', $text);
                $text = str_replace("     ", ' ', $text);
                $text = str_replace("     ", ' ', $text);
                $text = str_replace("     ", ' ', $text);
                $text = str_replace("     ", ' ', $text);
                $text = str_replace("     ", ' ', $text);
                $text = str_replace("   ", ' ', $text);
                $text = str_replace("  ", ' ', $text);
                $text = str_replace("А ", 'А', $text);

                $work = $this->getStringBetween($text, 'Опыт работы', 'Образование');
                $name = iconv_substr($text, 0, mb_strpos($text, ' ', 12, 'utf-8'));
                $age = self::getStringBetween($text, ' , ', 'Проживает');
                $phone = '+'.$this->getStringBetween($text, '+', '— ');
                $phone = '';
                $education = $this->getStringBetween($text, 'Образование', 'Ключевые навыки');
                $additional = self::getStringBetween($text, 'Дополнительная информация', 'Мои интересы');
                $skills = self::getStringBetween($text, 'Навыки', 'История');
                $email = '';

                if(preg_match('/[a-z]{1,}[^\s]+@[^\s\.]+\.[a-z]+/', $text, $matches))
                {
                    if(isset($matches[0])){
                        $email = $matches[0];
                    }
                }

                if(  preg_match( '/[+][\d \-\(\)]{5,}/', $text,  $matches ) )
                {
                    if(isset($matches[0])){
                        $phone = $matches[0];
                    }
                }

                if($phone == ''){
                    $phone = '+'.$this->getStringBetween($text, '+', '— ');
                    $phone = str_replace($email, ' ', $phone);
                }

                if(  preg_match( '/(родил(ась|ся))\s[\d]\s([а-я]+)\s[\d]{4}/ui', $text,  $matches ) )
                {
                    if(isset($matches[0])){
                        $age = $matches[0];
                    }
                }

                if(  preg_match( '/[\d]{2}\s(года|год|лет)/ui', $text,  $matches ) )
                {
                    if(isset($matches[0])){
                        $age = $matches[0] . ', ' . $age;
                    }
                }

                mb_internal_encoding( 'UTF-8');
                mb_regex_encoding( 'UTF-8');

                $skills = mb_split('(?=[А-Я])',$skills);
//            echo '<br><br>';

//            VarDumper::dump($work, 10, true);

            }
        } else if($this->file->extension == 'rtf') {
            $text = rtf2text('documents/tmp.rtf');

            $text = str_replace("\n", '', $text);
            $text = str_replace("\r", '', $text);
            $text = str_replace("\t", '', $text);
            $text = str_replace("     ", ' ', $text);
            $text = str_replace("     ", ' ', $text);
            $text = str_replace("     ", ' ', $text);
            $text = str_replace("     ", ' ', $text);
            $text = str_replace("     ", ' ', $text);
            $text = str_replace("   ", ' ', $text);
            $text = str_replace("  ", ' ', $text);
            $text = str_replace("А ", 'А', $text);

            $work = $this->getStringBetween($text, 'Опыт работы', 'Образование');
            $name = iconv_substr($text, 0, mb_strpos($text, ' ', 12, 'utf-8'));
            $age = self::getStringBetween($text, ' , ', 'Проживает');
            $phone = '';
//        $phone = '+'.$this->getStringBetween($text, '+', '— ');
            $education = $this->getStringBetween($text, 'Образование', 'Ключевые навыки');
            if($education == ''){
                $education = $this->getStringBetween($text, 'Образов ание', 'Ключевые навыки');
            }
            $skills = self::getStringBetween($text, 'Навыки', 'История');
            $additional = self::getStringBetween($text, 'Дополнительная информация', 'Мои интересы');
            $email = '';

            if(  preg_match( '/[+][\d \-\(\)]{5,}/', $text,  $matches ) )
            {
                if(isset($matches[0])){
                    $phone = $matches[0];
                }
            }

            if(  preg_match( '/(родил(ась|ся))\s[\d]\s([а-я]+)\s[\d]{4}/ui', $text,  $matches ) )
            {
                if(isset($matches[0])){
                    $age = $matches[0];
                }
            }

            if(preg_match('/[^\s]+@[^\s\.]+\.[a-z]+/', $text, $matches))
            {
                if(isset($matches[0])){
                    $email = $matches[0];
                }
            }

            if(  preg_match( '/[\d]{2}\s(года|год|лет)/ui', $text,  $matches ) )
            {
                if(isset($matches[0])){
                    $age = $matches[0] . ', ' . $age;
                }
            }



            mb_internal_encoding( 'UTF-8');
            mb_regex_encoding( 'UTF-8');

            $skills = mb_split('(?=[А-Я])',$skills);
//            echo '<br><br>';

//            VarDumper::dump($work, 10, true);

        } else {
            return null;
        }


        return [
            'name' => $this->file->basename,
            'work' => $work,
            'email' => $email,
            'age' => $age,
            'phone' => $phone,
            'education' => $education,
            'additional' => $additional,
            'skills' => $skills,
        ];
    }

    private function getStringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = mb_strpos($string, $start, 0, 'utf-8');
        if ($ini == 0) return '';
        $ini += iconv_strlen($start);
        $len = mb_strpos($string, $end, $ini) - $ini;
        return iconv_substr($string, $ini, $len);
    }
}