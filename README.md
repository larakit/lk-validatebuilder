# [Larakit ValidateBuilder] 
**Генератор массива правил валидации**

##Задачи, которые решает пакет:
- экономия времени за счет автокомплита при составлении массива правил валидации

Покажем использование на примере Request:

###1. Сгенерируем построитель правил валидации:

~~~bash
php artisan make-lk:validator UserRegister
~~~

будет создан файл 

~~~
./app/Http/Validators/UserRegisterValidator.php
~~~

Откроем его и дополним правилами
~~~php
<?php
namespace App\Validators;

use Larakit\ValidateBuilder;

class UserRegisterValidator extends ValidateBuilder {

    function build() {
        $this
        ->messageRequired('Забыл заполнить?')
        //############################################################
        //составляем правила для поля "логин"
        //############################################################
        ->to('login')
        //это будет обязательное поле
        ->ruleRequired('Мы настаиваем на заполнении этого поля')
        //с минимальной длиной 6 символов
        ->ruleMin(6)
        //с проверкой уникальности по полю логин в таблице пользователей
        ->ruleUnique('users', 'login')
        //############################################################
        //составляем правила для поля "пароль"
        //############################################################
        ->to('password')
        //это будет обязательное поле
        ->ruleRequired()
        //это будет требовать подтверждения
        ->ruleConfirmed()
        //оно должно соотвествовать регулярному выражению
        ->ruleRegex('[\w\d]+')
        //с минимальной длиной 6 символов
        ->ruleMin(8)
        //############################################################
        //составляем правила для поля "фамилия"
        //############################################################
        ->to('last_name')
        //с минимальной длиной 6 символов
        ->ruleMin(3)
        //с максимальной длиной 30 символов
        ->ruleMax(30)
        //состоящей только из букв
        ->ruleAlpha()
        //############################################################
        //составляем правила для поля "логин"
        //############################################################
        ->to('first_name')
        //с минимальной длиной 6 символов
        ->ruleMin(3)
        //с максимальной длиной 30 символов
        ->ruleMax(30)
        //состоящей только из букв
        ->ruleAlpha()
        //будем требовать заполнение поля "имя" ТОЛЬКО когда заполнено поле "отчество"
        ->ruleRequiredWith('middle_name')
        //############################################################
        //составляем правила для поля "логин"
        //############################################################
        ->to('middle_name')
        //с минимальной длиной 6 символов
        ->ruleMin(3)
        //с максимальной длиной 30 символов
        ->ruleMax(30)
        //состоящей только из букв
        ->ruleAlpha()
        //будем требовать заполнение поля "отчество" ТОЛЬКО когда заполнены оба поля: "фамилия" и "отчество"
        ->ruleRequiredWithAll('first_name,last_name')
    }

}
~~~

###2. Сгенерируем сам request
~~~bash
php artisan make:request UserRegister
~~~

будет создан файл 
~~~
./app/Http/Requests/UserRegister.php
~~~

в нем и будет составлять правила, а они будут следующие

~~~php
<?php

namespace App\Http\Requests;

use App\Validators\UserRegisterValidator;
use App\Http\Requests\Request;

class UserRegister extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
      return UserRegisterValidator::instance()->rules();
    }
    
    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
      return UserRegisterValidator::instance()->messages();
    }
    
~~~

##На выходе получим:

###правила:

~~~php
[
  "login" => "required|min:6|unique:users,login"
  "password" => "required|confirmed|regex:[\w\d]+|min:8"
  "last_name" => "min:3|max:30|alpha"
  "first_name" => "min:3|max:30|alpha|required_with:middle_name"
  "middle_name" => "min:3|max:30|alpha|required_with_all:first_name,last_name"
];
~~~

###сообщения об ошибках:

~~~php
[
    'required' => 'Забыл заполнить?',
    'login.required' => 'Мы настаиваем на заполнении этого поля'
];

~~~

###Голова - не чердак и не нужно хранить в ней ненужные вещи!
Доверьте эти вещи автокомплиту!
