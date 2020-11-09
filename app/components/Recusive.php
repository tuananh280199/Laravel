<?php

namespace App\components;

class Recusive {

    private $data;
    private $htmlSelect = '';

    function __construct($data) {
        $this->data = $data;
    }

    function recursive($parentId ,$id = 0, $text = '') {
        foreach($this->data as $value) {
            if($value['parent_id'] == $id) {
                if( !empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }
                $this->recursive($parentId, $value['id'], $text.'--');
            }
        }
        return $this->htmlSelect;
    }

}