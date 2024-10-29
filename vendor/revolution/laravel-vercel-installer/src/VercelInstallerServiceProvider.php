<?php

declare(strict_types=1);

namespace Revolution\Vercel;

use Illuminate\Support\ServiceProvider;
use Revolution\Vercel\Console\InstallCommand;

class VercelInstallerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
