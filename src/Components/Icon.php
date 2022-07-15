<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

/**
 * Class Icon
 *
 * @package inkvizytor\FluentForm
 */
class Icon extends Control
{
    use CssContract;
    
    /** @var string */
    protected $title;
    
    /** @var string */
    protected $visibled = true;
    
    /** @var string */
    protected $rendered = true;
    
    /**
     * @param string $label
     * @param array $parameters
     * @param string|null $locale
     * @return $this
     */
    public function title($label, array $parameters = [], $locale = null)
    {
        $this->title = $this->translator()->get($label, $parameters, $locale);

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function visibled($value = true)
    {
        $this->visibled = $value;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisibled()
    {
        return !empty($this->visibled);
    }

    /**
     * @return string
     */
    public function getVisibledCss()
    {
        return $this->visibled ? '' : 'hide';
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function rendered($value = true)
    {
        $this->rendered = $value;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function isRendered()
    {
        return !empty($this->rendered);
    }
    
    /**
     * @return string
     */
    public function render()
    {
        if ($this->rendered == false)
            return "";

        if (!empty($this->getVisibledCss()))
            $this->addClass($this->getVisibledCss());

        return $this->html()->tag('i', $this->getOptions(), '');
    }
}