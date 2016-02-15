<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 23.01.2016
 * Time: 20:34
 */

namespace AppBundle;


class Publication
{
    private $language;
    private $author;
    private $title;
    private $faculty;
    private $year;
    private $city;
    private $volume;

    public function getAuthor()
    {
        return $this->author;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFaculty()
    {
        return $this->faculty;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function setAuthor($author)
    {
        $this->author = mb_convert_encoding($author, "Windows-1251", "UTF-8");
    }

    public function setLanguage($language)
    {
        $this->language = mb_convert_encoding($language, "Windows-1251", "UTF-8");
    }

    public function setTitle($title)
    {
        $title = mb_convert_encoding($title, "Windows-1251", "UTF-8");
        $this->title = $title;
    }

    public function setFaculty($faculty)
    {
        $this->faculty = mb_convert_encoding($faculty, "Windows-1251", "UTF-8");
    }

    public function setCity($city)
    {
        $this->city = mb_convert_encoding($city, "Windows-1251", "UTF-8");
    }

    public function setVolume($volume)
    {
        $this->volume = mb_convert_encoding($volume, "Windows-1251", "UTF-8");;
    }

    public function setYear($year)
    {
        $this->year = mb_convert_encoding($year, "Windows-1251", "UTF-8");;
    }

}