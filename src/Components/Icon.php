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

        return $this->html()->tag('i', $this->getOptions(), '');
    }
}