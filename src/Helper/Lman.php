<?php

namespace Kalamsoft\Langman;
/**
 * Created by Decipher Lab.
 * User: Prabakar
 * Date: 19-Mar-18
 * Time: 9:11 PM
 */
class Lman
{

    public static function TranslationSwitch()
    {
        $html = '<li class="dropdown">';
        $iso = 'En';
        $lang_name = 'English';
        foreach (self::langOption() as $lang):
            if ($lang['folder'] == \App::getLocale()) {
                $iso = $lang['folder'];
                continue;
            }
        endforeach;
        $html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' .
            strtoupper($iso) . '<span class="caret"></span>
                   </a>
                   <ul class="dropdown-menu" role="menu">';
        foreach (self::langOption() as $lang):
            $html .= '<li><a href="' . route('lang.switch', $lang['folder']) . '"> ' . $lang['name'] . '</a></li>';
            endforeach;
        $html .= '<li><a href="'.url('translation').'">Manage Translation</a></li>
                    </ul>
                    </li>';
         return $html;
    }

    static function langOption()
    {
        $path = base_path() . '/resources/lang/';
        $lang = scandir($path);
        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/config.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }
}