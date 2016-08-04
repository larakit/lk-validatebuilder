<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.05.16
 * Time: 20:10
 */

namespace Larakit;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CommandMakeValidator extends GeneratorCommand {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:make:validator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new validator class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Validator';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/validator.stub';
    }

    protected function getNameInput()
    {
        return Str::studly(parent::getNameInput().'_validator');
    }



    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Validators';
    }

}
