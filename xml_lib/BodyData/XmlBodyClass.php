<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 15.12
 */

abstract class XmlBodyClass {

    protected static function addIfNotNull(SimpleXMLElement $element, $name, $value) {
        if ($value != null)
            return $element->addChild($name, $value);
        else
            return null;
    }

    public abstract function addToXml(SimpleXMLElement $xml);
}