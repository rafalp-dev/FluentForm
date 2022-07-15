<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;
use Illuminate\Support\Arr;

/**
 * Class TabStrip
 *
 * @package inkvizytor\FluentForm
 */
class Panel extends Control
{
    use CssContract;
    
    /** @var array */
    protected $guarded = ['mode', 'heading', 'footer'];

    /** @var string */
    protected $mode;
    
    /** @var string */
    protected $heading = null;

    /** @var array */
    protected $footer = [];
    
    /** @var string */
    protected $visibled = true;
    
    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
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
     * @param string $heading
     * @return $this
     */
    public function open($heading = null)
    {
        $this->mode = 'panel:begin';
        $this->heading = $heading;
        
        return $this;
    }

    /**
     * @param array $footer
     * @return $this
     */
    public function close(array $footer = [])
    {
        $this->mode = 'panel:end';
        $this->footer = $footer;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        if ($this->getMode() == 'panel:begin')
        {
            return $this->renderPanelBegin();
        }

        if ($this->getMode() == 'panel:end')
        {
            return $this->renderPanelEnd();
        }
        
        return '';
    }
    
    /**
     * @return string
     */
    private function renderPanelBegin()
    {
        $attributes = Arr::except($this->getOptions(), ['heading', 'body', 'footer']);
        
        $header = '';

        if (!empty($this->heading))
        {
            $header = $this->html()->tag('div', $this->getAttr('heading'), $this->heading)."\n";
        }
        
        return
            $this->html()->tag('div', $attributes)."\n".
            $header.
            $this->html()->tag('div', $this->getAttr('body'));
    }

    /**
     * @return string
     */
    private function renderPanelEnd()
    {
        $footer = '';
        
        if (count($this->footer) > 0)
        {
            $footer = $this->html()->tag('div', $this->getAttr('footer'), implode("\n", $this->footer))."\n";
        }
        
        return
            $this->html()->close('div')."\n".
            $footer.
            $this->html()->close('div');
    }
} 