<?php

namespace Classes;

Class Validator{

    public $errorMessage;

    public $rules = array(
        'username' => 'alpha|max_len,15|min_len,4',
        'password' => 'alpha_numeric|max_len,20|min_len,4',
        'message' => 'max_len,200|min_len,1');

    protected function splitRules ($rules){
        $splitRules = explode('|',$rules);
        return $splitRules;
    }

    protected function splitRulesByComma ($rule){
        $splitRulesByComma = explode(',',$rule);
        return $splitRulesByComma;
    }

    protected function validate_alpha_numeric($key, $value){
        if (preg_match('/[^A-Za-z0-9]/', $value) || !ctype_alnum($value)){
            $this->errorMessage .= $key.'содержать только латинские буквы и цифры<br />';
            return false;
        }
        return true;
    }

    protected function validate_alpha($key, $value){
        if (preg_match('/[^A-Za-z]/', $value)){
            $this->errorMessage .= $key.'содержать только латинские буквы<br />';
            return false;
        }
        return true;
    }

    protected function validate_max_len($key, $value,$parameter){
        if (mb_strlen($value)>$parameter){
            $this->errorMessage .= $key.'содержать '.$parameter.' или меньше символов.<br />';
            return false;
        }
        return true;
    }

    protected function validate_min_len($key,$value,$parameter){
        if (mb_strlen($value)<$parameter){
            $this->errorMessage .= $key.'содержать '.$parameter.' или больше символов.<br />';
            return false;
        }
        return true;
    }

    public function isValid (array $data) {
        foreach ($data as $key=>$value){
            foreach ($this->rules as $key1=>$value1){
                if ($key === $key1){
                    if ($key == 'username'){
                        $key = 'Логин должен ';
                    } elseif($key == 'password') {
                        $key = 'Пароль должен ';
                    } elseif($key == 'message'){
                        $key = 'Сообщение должно ';
                    }
                    $rulesList = $this->splitRules($value1);
                    foreach ($rulesList as $rule){
                        if (preg_match('/,/',$rule)){
                            $rule = $this->splitRulesByComma($rule);
                            $method = 'validate_'.$rule[0];
                            $this->$method($key,$value,$rule[1]);
                        } else {
                            $method = 'validate_'.$rule;
                            $this->$method($key,$value);
                        }

                    }
                }
            }
        }
        if (isset($this->errorMessage)){
            return false;
        }

        return true;
    }

    /**
     * @param array $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }


}