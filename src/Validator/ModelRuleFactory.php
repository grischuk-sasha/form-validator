<?php
namespace FormValidator\Validator;

use FormValidator\Model;
use FormValidator\Validator\Rules\ArrayRule;
use FormValidator\Validator\Rules\CustomRule;
use FormValidator\Validator\Rules\DefaultRule;
use FormValidator\Validator\Rules\EmailRule;
use FormValidator\Validator\Rules\InRule;
use FormValidator\Validator\Rules\IntegerRule;
use FormValidator\Validator\Rules\NumericRule;
use FormValidator\Validator\Rules\RequiredRule;
use FormValidator\Validator\Rules\Rule;
use FormValidator\Validator\Rules\StringRule;

class ModelRuleFactory
{
    /**
     * @param array $params
     * @param Model $model
     * @return Rule
     * @throws \Exception
     */
    public static function create(array $params, Model $model)
    {
        switch ($params[1]) {

            case Model::RULE_REQUIRED:
                return new RequiredRule();

            case Model::RULE_CUSTOM:
                return new CustomRule($model, $params['method']);

            case Model::RULE_IN:
                return new InRule($params['values']);

            case Model::RULE_EMAIL:
                return new EmailRule();

            case Model::RULE_INTEGER:
                return new IntegerRule($params);

            case Model::RULE_NUMERIC:
                return new NumericRule();

            case Model::RULE_STRING:
                return new StringRule($model, $params);

            case Model::RULE_DEFAULT:
                return new DefaultRule($model, $params);

            case Model::RULE_ARRAY:
                return new ArrayRule();
        }

        throw new \Exception('Rule was not found.');
    }
}