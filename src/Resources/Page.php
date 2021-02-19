<?php

namespace Filament\Resources;

class Page extends \Filament\Page
{
    protected static $resource;

    public static function getResource()
    {
        return static::$resource;
    }

    public static function routeTo($uri, $name)
    {
        return new Route(static::class, $uri, $name);
    }

    protected static function getModel()
    {
        return static::getResource()::getModel();
    }

    protected static function getQuery()
    {
        return static::getModel()::query();
    }

    protected function columns()
    {
        return static::getResource()::columns();
    }

    protected function fields()
    {
        return static::getResource()::fields();
    }

    protected function filters()
    {
        return static::getResource()::filters();
    }
}
