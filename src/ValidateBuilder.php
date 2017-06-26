<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit/hlp-rules
 * User: Alexey Berdnikov
 * Date: 17.05.16
 * Time: 14:26
 */

namespace Larakit;

use Illuminate\Support\Arr;

/**
 * Class ValidateBuilder
 *
 * @package Larakit\Helper
 */
class ValidateBuilder {
    
    static $instances = [];
    /**
     * @var array
     */
    protected $rules = [];
    /**
     * @var array
     */
    protected $messages = [];
    /**
     * @var null
     */
    protected $field = null;
    
    /**
     * ValidateBuilder constructor.
     */
    function __construct() {
        $this->build();
    }
    
    function validate($data, $as_html = true) {
        $v = \Validator::make($data, $this->rules(), $this->messages());
        if(!$v->fails()) {
            return false;
        }
        $ret = [];
        foreach($v->errors()->getMessages() as $f => $errors) {
            $ret[$f] = implode($as_html ? '<br>' : PHP_EOL, $errors);
        }
        
        return $ret;
    }
    
    /**
     * Метод генерации правил, переопределяется в классе-потомке
     */
    function build() {
    }
    
    /**
     * @param null $class
     *
     * @return ValidateBuilder
     */
    static function instance($class = null) {
        if(!$class) {
            $class = get_called_class();
        }
        if(!is_a($class, ValidateBuilder::class, true)) {
            throw new \Exception($class . ' is not a subclass of ' . ValidateBuilder::class);
        }
        if(!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        
        return self::$instances[$class];
    }
    
    /**
     * Построитель правила "dimensions"
     *
     * @return HelperRuleDimensions
     */
    static function makeDimension() {
        return new HelperRuleDimensions();
    }
    
    /**
     * Построитель правила "mimetypes"
     *
     * @return HelperRuleMimetypes
     */
    static function makeMimetypes() {
        return new HelperRuleMimetypes();
    }
    
    /**
     * Меняем контекст (поле), для которого будут навешиваться дальнейшие правила и сообщения
     *
     * @param $name
     *
     * @return $this
     */
    function to($name) {
        $this->field = $name;
        
        return $this;
    }
    
    /**
     * Экспортируем сгенерированные сообщения об ошибках наружу, например в форму
     *
     * @return array
     */
    function messages() {
        return $this->messages;
    }
    
    /**
     * Экспортируем сгенерированные правила наружу, например в форму
     *
     * @return array
     */
    function rules() {
        $rules = $this->rules;
        array_walk($rules, function (&$v) {
            $v = implode('|', $v);
        });
        
        return $rules;
    }
    
    /**
     * The field under validation must be yes, on, 1, or true. This is useful for validating "Terms of Service" acceptance.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAccepted($error_message = null) {
        return $this->_rule('accepted', $error_message);
    }
    
    function ruleNullable() {
        return $this->_rule('nullable');
    }
    
    /**
     * @param      $rule
     * @param null $error_message
     *
     * @return $this
     * @throws \Exception
     */
    protected function _rule($rule, $error_message = null) {
        if(!$this->field) {
            throw new \Exception('Not specified fieldname');
        }
        $this->rules[$this->field][$rule] = $rule;
        if($error_message) {
            $this->message($rule, $error_message, $this->field);
        }
        
        return $this;
    }
    
    /**
     * Получение сгенерированных правил
     *
     * @param      $rule
     * @param null $error_message
     * @param null $field
     *
     * @return $this
     */
    function message($rule, $error_message, $field = null) {
        $rule                                                 = explode(':', $rule);
        $rule                                                 = Arr::get($rule, 0);
        $this->messages[($field ? $field . '.' : '') . $rule] = $error_message;
        
        return $this;
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageAccepted($error_message = null) {
        return $this->message('accepted', $error_message);
    }
    
    /**
     * The field under validation must be a valid URL according to the checkdnsrr PHP function.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleActiveUrl($error_message = null) {
        return $this->_rule('active_url', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageActiveUrl($error_message = null) {
        return $this->message('active_url', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAfterTomorrow($error_message = null) {
        return $this->ruleAfter('tomorrow', $error_message);
    }
    
    /**
     * @param      $date
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAfter($date, $error_message = null) {
        if(!strtotime($date)) {
            throw new \Exception('Incorrect date');
        }
        
        return $this->_rule('after:' . $date, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageAfter($error_message = null) {
        return $this->message('after', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAfterYesterday($error_message = null) {
        return $this->ruleAfter('yesterday', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAfterToday($error_message = null) {
        return $this->ruleAfter('today', $error_message);
    }
    
    /**
     * The field under validation must be entirely alphabetic characters.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAlpha($error_message = null) {
        return $this->_rule('alpha', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageAlpha($error_message = null) {
        return $this->message('alpha', $error_message);
    }
    
    /**
     * The field under validation may have alpha-numeric characters, as well as dashes and underscores.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAlphaDash($error_message = null) {
        return $this->_rule('alpha_dash', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageAlphaDash($error_message = null) {
        return $this->message('alpha_dash', $error_message);
    }
    
    /**
     * The field under validation must be entirely alpha-numeric characters.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleAlphaNum($error_message = null) {
        return $this->_rule('alpha_num', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageAlphaNum($error_message = null) {
        return $this->message('alpha_num', $error_message);
    }
    
    /**
     * The field under validation must be a PHP array.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleArray($error_message = null) {
        return $this->_rule('array', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageArray($error_message = null) {
        return $this->message('array', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBeforeTomorrow($error_message = null) {
        return $this->ruleBefore('tomorrow', $error_message);
    }
    
    /**
     * The field under validation must be a value preceding the given date. The dates will be passed into the PHP strtotime function.
     *
     * @param      $date
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBefore($date, $error_message = null) {
        if(!strtotime($date)) {
            throw new \Exception('Incorrect date');
        }
        
        return $this->_rule('before:' . $date, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageBefore($error_message = null) {
        return $this->message('before', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBeforeYesterday($error_message = null) {
        return $this->ruleBefore('yesterday', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBeforeToday($error_message = null) {
        return $this->ruleBefore('today', $error_message);
    }
    
    /**
     * The field under validation must have a size between the given min and max. Strings, numerics, and files are evaluated in the same fashion as the size rule.
     *
     * @param int  $min
     * @param int  $max
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBetween($min, $max, $error_message = null) {
        if(!is_numeric($min)) {
            throw new \Exception('Incorrect parameter MIN in rule between');
        }
        if(!is_numeric($max)) {
            throw new \Exception('Incorrect parameter MAX in rule between');
        }
        
        return $this->_rule('between:' . $min . ',' . $max, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageBetween($error_message = null) {
        return $this->message('between', $error_message);
    }
    
    /**
     * The field under validation must be able to be cast as a boolean. Accepted input are true, false, 1, 0, "1", and "0".
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleBoolean($error_message = null) {
        return $this->_rule('boolean', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageBoolean($error_message = null) {
        return $this->message('boolean', $error_message);
    }
    
    /**
     * The field under validation must have a matching field of foo_confirmation. For example, if the field under validation is password, a matching
     * password_confirmation field must be present in the input.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleConfirmed($error_message = null) {
        return $this->_rule('confirmed', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageConfirmed($error_message = null) {
        return $this->message('confirmed', $error_message);
    }
    
    /**
     * The field under validation must be a valid date according to the strtotime PHP function.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDate($error_message = null) {
        return $this->_rule('date', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDate($error_message = null) {
        return $this->message('date', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleDateFormatYMD($error_message = null) {
        return $this->ruleDateFormat('Y-m-d', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleDateFormatYMDHIS($error_message = null) {
        return $this->ruleDateFormat('Y-m-d H:i:s', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleDateFormatDMY($error_message = null) {
        return $this->ruleDateFormat('d.m.Y', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleDateFormatDMYHIS($error_message = null) {
        return $this->ruleDateFormat('d.m.Y H:i:s', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleDateFormatHIS($error_message = null) {
        return $this->ruleDateFormat('H:i:s', $error_message);
    }
    
    /**
     * The field under validation must match the given format. The format will be evaluated using the PHP date_parse_from_format function. You should use either date or
     * date_format when validating a field, not both.
     *
     * @param      $format
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDateFormat($format, $error_message = null) {
        return $this->_rule('date_format:' . $format, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDateFormat($error_message = null) {
        return $this->message('date_format', $error_message);
    }
    
    /**
     * The field under validation must have a different value than field.
     *
     * @param      $field
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDifferent($field, $error_message = null) {
        return $this->_rule('different:' . $field, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDifferent($error_message = null) {
        return $this->message('different', $error_message);
    }
    
    /**
     * The field under validation must be numeric and must have an exact length of value.
     *
     * @param      $field
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDigest($field, $error_message = null) {
        return $this->_rule('digits:' . $field, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDigits($error_message = null) {
        return $this->message('digits', $error_message);
    }
    
    /**
     * The field under validation must have a length between the given min and max.
     *
     * @param      $min
     * @param      $max
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDigestBetween($min, $max, $error_message = null) {
        if(!is_numeric($min)) {
            throw new \Exception('Incorrect parameter MIN in rule between');
        }
        if(!is_numeric($max)) {
            throw new \Exception('Incorrect parameter MAX in rule between');
        }
        
        return $this->_rule('digits_between:' . $min . ',' . $max, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDigestBetween($error_message = null) {
        return $this->message('digits_between', $error_message);
    }
    
    /**
     * The file under validation must be an image meeting the dimension constraints as specified by the rule's parameters:
     * ->ruleDimension(
     *      ValidateBuilder::makeDimension()
     *          ->setRatio(123)
     *          ->setHeight(123)
     *          ->setWidth(123)
     *          ->setWidth(123)
     *          ->setMaxHeight(123)
     *          ->setMinHeight(123)
     *          ->setMaxWidth(123)
     *          ->setMinWidth(123)
     * )
     *
     * @param      $rule
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDimension($rule, $error_message = null) {
        return $this->_rule('dimensions:' . $rule, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDimensions($error_message = null) {
        return $this->message('dimensions', $error_message);
    }
    
    /**
     * When working with arrays, the field under validation must not have any duplicate values.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleDistinct($error_message = null) {
        return $this->_rule('distinct', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageDistinct($error_message = null) {
        return $this->message('distinct', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleEmail($error_message = null) {
        return $this->_rule('email', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageEmail($error_message = null) {
        return $this->message('email', $error_message);
    }
    
    /**
     * @param      $tablename
     * @param      $field
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleExistsField($tablename, $field, $error_message = null) {
        return $this->ruleExists($tablename, $field, null, $error_message);
    }
    
    /**
     * @param      $tablename
     * @param null $field
     * @param null $value
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleExists($tablename, $field = null, $value = null, $error_message = null) {
        $rule = 'exists:' . $tablename;
        if($field) {
            $rule .= ',' . $field;
            if($value) {
                $rule .= ',' . $value;
            }
        }
        
        return $this->_rule($rule, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageExists($error_message = null) {
        return $this->message('exists', $error_message);
    }
    
    /**
     * @param      $tablename
     * @param      $field
     * @param      $value
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleExistsFieldValueEqual($tablename, $field, $value, $error_message = null) {
        return $this->ruleExists($tablename, $field, $value, $error_message);
    }
    
    /**
     * @param      $tablename
     * @param      $field
     * @param      $value
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleExistsFieldValueNotEqual($tablename, $field, $value, $error_message = null) {
        return $this->ruleExists($tablename, $field, '!' . $value, $error_message);
    }
    
    /**
     * @param      $tablename
     * @param      $field
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleExistsFieldValueNull($tablename, $field, $error_message = null) {
        return $this->ruleExists($tablename, $field, 'NULL', $error_message);
    }
    
    /**
     * @param      $tablename
     * @param      $field
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function ruleExistsFieldValueNotNull($tablename, $field, $error_message = null) {
        return $this->ruleExists($tablename, $field, 'NOT NULL', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleFilled($error_message = null) {
        return $this->_rule('filled', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageFilled($error_message = null) {
        return $this->message('filled', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleImage($error_message = null) {
        return $this->_rule('image', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageImage($error_message = null) {
        return $this->message('image', $error_message);
    }
    
    /**
     * @param array $options
     * @param null  $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleIn(array $options, $error_message = null) {
        return $this->_rule('in:' . implode(',', $options), $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageIn($error_message = null) {
        return $this->message('in', $error_message);
    }
    
    /**
     * @param array $options
     * @param null  $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleInArray(array $options, $error_message = null) {
        return $this->_rule('in_array:' . implode(',', $options), $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageInArray($error_message = null) {
        return $this->message('in_array', $error_message);
    }
    
    /**
     * The field under validation must be an integer.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleInteger($error_message = null) {
        return $this->_rule('integer', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageInteger($error_message = null) {
        return $this->message('integer', $error_message);
    }
    
    /**
     * The field under validation must be an IP address.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleIp($error_message = null) {
        return $this->_rule('ip', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageIp($error_message = null) {
        return $this->message('ip', $error_message);
    }
    
    /**
     * The field under validation must be a valid JSON string.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleJson($error_message = null) {
        return $this->_rule('json', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageJson($error_message = null) {
        return $this->message('json', $error_message);
    }
    
    /**
     * @param      $max
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleMax($max, $error_message = null) {
        if(!is_numeric($max)) {
            throw new \Exception('Incorrect parameter MAX in rule max');
        }
        
        return $this->_rule('max:' . $max, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageMax($error_message = null) {
        return $this->message('max', $error_message);
    }
    
    /**
     * The file under validation must match one of the given MIME types:
     * ->ruleMimetypes(
     *      ValidateBuilder::makeMimetypes()
     *          ->addJpeg()
     *          ->addGif()
     * )
     *
     * @param      $mimetypes
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleMimetypes($mimetypes, $error_message = null) {
        return $this->_rule('mimetypes:' . $mimetypes, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageMimetypes($error_message = null) {
        return $this->message('mimetypes', $error_message);
    }
    
    /**
     * The file under validation must have a MIME type corresponding to one of the listed extensions.
     * ->ruleMimes('jpeg,bmp,png')
     *
     * @param      $mimetypes
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleMimes($mimetypes, $error_message = null) {
        return $this->_rule('mimes:' . $mimetypes, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageMimes($error_message = null) {
        return $this->message('mimes', $error_message);
    }
    
    /**
     * The field under validation must have a minimum value. Strings, numerics, and files are evaluated in the same fashion as the size rule.
     *
     * @param      $min
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleMin($min, $error_message = null) {
        if(!is_numeric($min)) {
            throw new \Exception('Incorrect parameter MIN in rule min');
        }
        
        return $this->_rule('min:' . $min, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageMin($error_message = null) {
        return $this->message('min', $error_message);
    }
    
    /**
     * The field under validation must not be included in the given list of values.
     *
     * @param array $options
     *
     * @param null  $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleNotIn(array $options, $error_message = null) {
        return $this->_rule('not_in:' . implode(',', $options), $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageNotIn($error_message = null) {
        return $this->message('not_in', $error_message);
    }
    
    /**
     * The field under validation must be numeric.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleNumeric($error_message = null) {
        return $this->_rule('numeric', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageNumeric($error_message = null) {
        return $this->message('numeric', $error_message);
    }
    
    /**
     * The field under validation must be present in the input data but can be empty.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function rulePresent($error_message = null) {
        return $this->_rule('present', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messagePresent($error_message = null) {
        return $this->message('present', $error_message);
    }
    
    /**
     * The field under validation must match the given regular expression.
     *
     * @param      $pattern
     *
     * @param null $error_message
     * ->ruleRegex('[\w\d]+')
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRegex($pattern, $error_message = null) {
        return $this->_rule('regex:' . $pattern, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRegex($error_message = null) {
        return $this->message('regex', $error_message);
    }
    
    /**
     * The field under validation must be present in the input data and not empty. A field is considered "empty" if one of the following conditions are true:
     * The value is null.
     * The value is an empty string.
     * The value is an empty array or empty Countable object.
     * The value is an uploaded file with no path.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequired($error_message = null) {
        return $this->_rule('required', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequired($error_message = null) {
        return $this->message('required', $error_message);
    }
    
    /**
     * The field under validation must be present if the anotherfield field is equal to any value.
     *
     * @param      $anotherfield
     * @param      $value
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredIf($anotherfield, $value, $error_message = null) {
        return $this->_rule('required_if:' . $anotherfield . ',' . $value, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredIf($error_message = null) {
        return $this->message('required_if', $error_message);
    }
    
    /**
     * The field under validation must be present unless the anotherfield field is equal to any value.
     *
     * @param      $anotherfield
     * @param      $value
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredUnless($anotherfield, $value, $error_message = null) {
        return $this->_rule('required_unless:' . $anotherfield . ',' . $value, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredUnless($error_message = null) {
        return $this->message('required_unless', $error_message);
    }
    
    /**
     * The field under validation must be present only if any of the other specified fields are present.
     *
     * @param      $anotherfield
     * @param      $value
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredWith($anotherfields, $error_message = null) {
        if(is_array($anotherfields)) {
            $anotherfields = implode(',', $anotherfields);
        }
        
        return $this->_rule('required_with:' . $anotherfields, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredWith($error_message = null) {
        return $this->message('required_with', $error_message);
    }
    
    /**
     * The field under validation must be present only if all of the other specified fields are present.
     *
     * @param      $anotherfields
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredWithAll($anotherfields, $error_message = null) {
        return $this->_rule('required_with_all:' . $anotherfields, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredWithAll($error_message = null) {
        return $this->message('required_with_all', $error_message);
    }
    
    /**
     * The field under validation must be present only when any of the other specified fields are not present.
     *
     * @param      $anotherfields
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredWithout($anotherfields, $error_message = null) {
        if(is_array($anotherfields)) {
            $anotherfields = implode(',', $anotherfields);
        }
        
        return $this->_rule('required_without:' . $anotherfields, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredWithout($error_message = null) {
        return $this->message('required_without', $error_message);
    }
    
    /**
     * The field under validation must be present only when all of the other specified fields are not present.
     *
     * @param      $anotherfields
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleRequiredWithoutAll($anotherfields, $error_message = null) {
        if(is_array($anotherfields)) {
            $anotherfields = implode(',', $anotherfields);
        }
        
        return $this->_rule('required_without_all:' . $anotherfields, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageRequiredWithoutAll($error_message = null) {
        return $this->message('required_without_all', $error_message);
    }
    
    /**
     * The given field must match the field under validation.
     *
     * @param      $field
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleSame($field, $error_message = null) {
        return $this->_rule('same:' . $field, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageSame($error_message = null) {
        return $this->message('same', $error_message);
    }
    
    /**
     * @param      $value
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleSize($value, $error_message = null) {
        if(!is_numeric($value)) {
            throw new \Exception('Incorrect parameter VALUE in rule size');
        }
        
        return $this->_rule('size:' . $value, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageSize($error_message = null) {
        return $this->message('size', $error_message);
    }
    
    /**
     * The field under validation must be a string.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleString($error_message = null) {
        return $this->_rule('string', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageString($error_message = null) {
        return $this->message('string', $error_message);
    }
    
    /**
     * The field under validation must be a valid timezone identifier according to the timezone_identifiers_list PHP function.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleTimezone($error_message = null) {
        return $this->_rule('timezone', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageTimezone($error_message = null) {
        return $this->message('timezone', $error_message);
    }
    
    /**
     * @param      $table
     * @param      $field
     * @param null $ignore_id
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleUnique($table, $field, $ignore_id = null, $error_message = null) {
        $suffix = $table . ',' . $field;
        if($ignore_id) {
            $suffix .= ',' . $ignore_id;
        }
        
        return $this->_rule('unique:' . $suffix, $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageUnique($error_message = null) {
        return $this->message('unique', $error_message);
    }
    
    /**
     * The field under validation must be a valid URL according to PHP's filter_var function.
     *
     * @param null $error_message
     *
     * @return ValidateBuilder
     * @throws \Exception
     */
    function ruleUrl($error_message = null) {
        return $this->_rule('url', $error_message);
    }
    
    /**
     * @param null $error_message
     *
     * @return ValidateBuilder
     */
    function messageUrl($error_message = null) {
        return $this->message('url', $error_message);
    }
    
}