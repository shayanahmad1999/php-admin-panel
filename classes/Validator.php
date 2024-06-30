<?php

class Validator {
    protected $data;
    protected $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function rules(array $rules) {
        foreach ($rules as $field => $rule) {
            $ruleList = explode('|', $rule);
            foreach ($ruleList as $r) {
                if ($r == 'required' && empty($this->data[$field])) {
                    $this->addError($field, ucfirst($field) . ' is required.');
                } elseif ($r == 'email' && !filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, ucfirst($field) . ' must be a valid email address.');
                } elseif (strpos($r, 'min:') === 0) {
                    $minLength = (int) substr($r, 4);
                    if (strlen($this->data[$field]) < $minLength) {
                        $this->addError($field, ucfirst($field) . " must be at least $minLength characters.");
                    }
                }
                // Add more elseif blocks for other validation rules
            }
        }
    }

    public function fails() {
        return !empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    protected function addError($field, $message) {
        $this->errors[$field] = $message;
    }
}
?>
