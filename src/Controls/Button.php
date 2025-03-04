<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\DataContract;

/**
 * Class Button
 *
 * @package inkvizytor\FluentForm
 */
class Button extends Control
{
    use CssContract, DataContract;
    
    /** @var array */
    protected $guarded = ['label', 'icon'];

    /** @var string */
    protected $label;
    
    /** @var string */
    protected $type = 'button';

    /** @var string */
    protected $name;
    
    /** @var string */
    protected $value;

    /** @var string */
    protected $icon;

    /** @var string */
    protected $title;

    /** @var string */
    protected $disabled;
    
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
    public function label($label, array $parameters = [], $locale = null)
    {
        $this->label = $this->translator()->get($label, $parameters, $locale);

        return $this;
    }
    
    /**
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = in_array($type, ['button', 'submit', 'reset']) ? $type : 'button';

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * @param string $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = !empty($icon) ? '<i class="'.$icon.'"></i> ' : '';

        return $this;
    }

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
    public function disabled($value = true)
    {
        $this->disabled = $value ? 'disabled' : null;

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
        {
            return "";
        }
        if ($this->type == 'submit' && $this->value === null)
        {
            $this->attr('value', true);
        }

        return $this->html()->tag('button', $this->getOptions(), $this->icon.$this->html()->encode($this->label));
    }
} 
