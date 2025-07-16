<?php

namespace Lib;

/**
 * helix FW
 *
 * Copyright (c) 2015
 *
 * Author(s): Selman TUNÇ www.selmantunc.com <selmantunc@gmail.com>
 * url yani link gibi yonlendirme ile ilgili kodlar bulunur
 *
 * @author Selman TUNÇ <selmantunc@gmail.com>
 * @copyright Copyright (c) 2015 SELMAN TUNÇ
 * @link http://github.com/helix
 * @link https://github.com/helix/helix-framework/
 * @version 2.0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Url
{



    /**
     * Redirect to chosen url
     *
     * @param string $url
     *            the url to redirect to
     * @param boolean $fullpath
     *            if true use only url in redirect instead of using DIR
     */
    public static function redirect($url = null, $fullpath = false)
    {
        if ($fullpath == false) {
            $url = DIR . $url;
        }
        header('Location: ' . $url);
        exit();
    }

 
    /**
     * css img js klasorunünü verir .
     * ..
     *
     * @return string
     */
    public static function publicPath()
    {
        return DIR . 'public';
    }

    /**
     * converts plain text urls into HTML links, second argument will be
     * used as the url label <a href=''>$custom</a>
     *
     * @param string $text
     *            data containing the text to read
     * @param string $custom
     *            if provided, this is used for the link label
     * @return string returns the data with links created around urls
     */
    public static function autolink($text, $custom = null)
    {
        $regex = '@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,.\s])@';

        if ($custom === null) {
            $replace = '<a href="http$2://$4">$1$2$3$4</a>';
        } else {
            $replace = '<a href="http$2://$4">' . $custom . '</a>';
        }

        return preg_replace($regex, $replace, $text);
    }

    /**
     * This function converts and url segment to an safe one, for example:
     * `test name @132` will be converted to `test-name--123`
     * Basicly it works by replacing every character that isn't an letter or an number to an dash sign
     * It will also return all letters in lowercase
     *
     * @param $slug -
     *            The url slug to convert
     *
     * @return mixed|string
     */
    public static function generateSafeSlug($slug)
    {
        $tr = array(
            'ş',
            'Ş',
            'ı',
            'İ',
            'ğ',
            'Ğ',
            'ü',
            'Ü',
            'ö',
            'Ö',
            'Ç',
            'ç',
            '/'
        );
        $eng = array(
            's',
            's',
            'i',
            'i',
            'g',
            'g',
            'u',
            'u',
            'o',
            'o',
            'c',
            'c',
            '_'
        );
        $slug = str_ireplace($tr, $eng, $slug);

        // transform url
        $slug = preg_replace('/[^a-zA-Z0-9]/', '-', $slug);
        $slug = mb_strtolower(trim($slug, '-'));

        // Removing more than one dashes
        $slug = preg_replace('/\-{2,}/', '-', $slug);

        return $slug;
    }

    /*
     * urunun linkini oluşturup verir
     * @param $stokisim urun ismi
     * @param $id urun id
     * @return string
     * @example sonuc urun/cappy-m-suyu-tetra-330ml-elma-karisik-100-x12/43941
     * urun /urun_isim / id
     */
    public static function productLink($stokisim, $id)
    {
        return DIR . 'urun/' . Url::generateSafeSlug($stokisim) . '/' . $id;
    }

    /*
     * urunler linkini oluşturup verir
     * @param $stokisim urun ismi
     *
     * @return string
     * @example sonuc urunler/sicak_icecekler
     * urun /urun_isim
     */
    public static function urunlerLink($kategori)
    {
        return DIR . 'urunler/' . Url::generateSafeSlug($kategori);
    }

    /**
     * Go to the previous url.
     */
    public static function previous()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }




    /*
     *
     * https://secure.php.net/manual/tr/function.parse-url.php
     * https://secure.php.net/parse_str
     * https://secure.php.net/manual/tr/function.http-build-query.php
     *
     */
    function getCurrentUrl()
    {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    /**
     * link içindeki boş olan key değerlerinin sileri
     *
     * @example LinkTemizle(http://smvc.dev/kategori/gida_ve_icecek?page=2&m=&cinsiyet=erkek )
     *          sonuc = http://smvc.dev/kategori/gida_ve_icecek?page=2&cinsiyet=erkek
     * @param string $link
     * @return string
     */
    private function LinkTemizle($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        // query var mı ona bakılır
        $queryKontrolQueryName = parse_url($url, PHP_URL_QUERY);
        $dir = substr(DIR, 0, -1); // bu / işareti sil
        parse_str($queryKontrolQueryName, $output);

        $deleted = array(
            ''
        );
        $sonuc = array_diff($output, $deleted); // boşlukları sildir
        $yeni = array_unique($sonuc); // aynı olanları sil

        $query = http_build_query($yeni);
        return $dir . $path . '?' . $query;
    }

    /**
     * link içindeki key value değerlerini siler
     *
     * @example TumLinkiTemizle(http://smvc.dev/kategori/gida_ve_icecek?page=2&m=&cinsiyet=erkek )
     *          sonuc = http://smvc.dev/kategori/gida_ve_icecek
     * @param string $link
     * @return string
     */
    public static function TumLinkiTemizle()
    {
        $url = \Lib\Tools::currentPageURL();
        $path = parse_url($url);
        return $path['scheme'] . '://' . $path['host'] . $path['path'];
    }






}
