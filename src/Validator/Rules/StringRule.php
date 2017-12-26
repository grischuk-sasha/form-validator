<?php
namespace FormValidator\Validator\Rules;

use FormValidator\Model;

class StringRule extends AbstractRule implements Rule
{
    protected $model;
    protected $params;

    public function __construct(Model $model, $params)
    {
        $this->model = $model;
        $this->params = $params;
    }

    public function validate($value)
    {
        if(!is_string($value))
            return false;

        $value = trim($value);
        $value = strip_tags($value, $this->getAllowedTags());

        $this->model->setAttribute($this->params[0], $value);

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' must be string.';
    }

    public function getAllowedTags()
    {
        return "<h1><h2><h3><h4><h5><h6><del><dd><dl><dt><pre><strong><b><br><em><hr><i><li><ol><p><s><span><table><tr><td><u><ul><div><a><blockquote><code><cite><q>";
    }

}