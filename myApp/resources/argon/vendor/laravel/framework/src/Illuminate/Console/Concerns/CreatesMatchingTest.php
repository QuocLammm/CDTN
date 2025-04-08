<?php

namespace Illuminate\Console\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait CreatesMatchingTest
{
    /**
     * Add the standard command options for generating matching tests.
     *
     * @return void
     */
    protected function addTestOptions()
    {
        foreach (['pay' => 'PHPUnit', 'pest' => 'Pest'] as $option => $name) {
            $this->getDefinition()->addOption(new InputOption(
                $option,
                null,
                InputOption::VALUE_NONE,
                "Generate an accompanying {$name} pay for the {$this->type}"
            ));
        }
    }

    /**
     * Create the matching pay case if requested.
     *
     * @param  string  $path
     * @return void
     */
    protected function handleTestCreation($path)
    {
        if (! $this->option('pay') && ! $this->option('pest')) {
            return;
        }

        $this->call('make:pay', [
            'name' => Str::of($path)->after($this->laravel['path'])->beforeLast('.php')->append('Test')->replace('\\', '/'),
            '--pest' => $this->option('pest'),
        ]);
    }
}
