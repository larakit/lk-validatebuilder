<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 17.05.16
 * Time: 15:06
 */

namespace Larakit;

class HelperRuleDimensions {

    protected $min_width  = null;
    protected $max_width  = null;
    protected $min_height = null;
    protected $max_height = null;
    protected $width      = null;
    protected $height     = null;
    protected $ratio      = null;

    function __toString() {
        $ret = [];
        foreach($this as $k => $v) {
            if($v) {
                $ret[] = $k . '=' . $v;
            }
        }

        return (string)implode(',', $ret);
    }

    /**
     * @param null $ratio
     *
     * @return HelperRuleDimensions;
     */
    public function setRatio($ratio) {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * @param null $height
     *
     * @return HelperRuleDimensions;
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * @param null $width
     *
     * @return HelperRuleDimensions;
     */
    public function setWidth($width) {
        $this->width = $width;

        return $this;
    }

    /**
     * @param null $max_height
     *
     * @return HelperRuleDimensions;
     */
    public function setMaxHeight($max_height) {
        $this->max_height = $max_height;

        return $this;
    }

    /**
     * @param null $min_height
     *
     * @return HelperRuleDimensions;
     */
    public function setMinHeight($min_height) {
        $this->min_height = $min_height;

        return $this;
    }

    /**
     * @param null $max_width
     *
     * @return HelperRuleDimensions;
     */
    public function setMaxWidth($max_width) {
        $this->max_width = $max_width;

        return $this;
    }

    /**
     * @param null $min_width
     *
     * @return HelperRuleDimensions;
     */
    public function setMinWidth($min_width) {
        $this->min_width = $min_width;

        return $this;
    }
}