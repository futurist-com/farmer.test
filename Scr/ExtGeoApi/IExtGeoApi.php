<?php
namespace Scr\ExtGeoApi;

interface IExtGeoApi{
    public function getAddress(string $point1, string $point2):string;
}