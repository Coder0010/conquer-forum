<?php

namespace App\Console\Commands;

use File;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Core\Traits\GeneratorHelper;

class DomainGeneratorCommand extends Command
{
    use GeneratorHelper;

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = "domain:generate {name : Domain (singular) for example User}";

    /**
     * The console command description.
     * @var string
     */
    protected $description = "Generate Domain";

    /**
     * the new Domain Name.
     * @var string
     */
    protected $domainName;

    /**
     * The new Domain Path.
     * @var string
     */
    protected $domainPath;

    /**
     * The new Generate Type.
     * @var string
     */
    protected $generateType = "domain";

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $this->domainName = $this->argument("name");
        if ($this->domainName == Str::plural($this->domainName)) {
            $this->error("Please Provide Me Singular Name");
            return;
        }
        if ($this->domainName != Str::title($this->domainName)) {
            $this->error("Please Provide Me Name with fist char is upper");
            return;
        }

        $this->domainPath = $this->getDomainsPath() . "/" . $this->domainName;
        if (File::exists($this->domainPath)) {
            $this->error("This Domain Is already exisit");
            return;
        }

        $this->createDirectory($this->getDomainsPath(), $this->domainName);

        $this->generate($this->getDomainFilesStructure(), $this->domainPath);

        $this->updateConfigApp();
    }

    /**
     * Folder & Files Generator.
     * @param array $structure
     * @param string $path
     * @return void
     */
    public function generate(array $structure, string $path) : void
    {
        foreach ($structure as $key => $value) {
            if (is_array($value)) {
                $this->info("--------==/*Start Domain.generate for Parent Dir [ {$key} ]*\==--------");
                $this->createDirectory($path, $key);
                $this->generate($value, "{$path}/{$key}/", $this->domainName);
                if (is_string($key)) {
                    $this->generateFiles($this->generateType, $key, $path, $this->domainName);
                }
                $this->info("--------==/*End Domain.generate for Parent Dir [ {$key} ]*\==--------");
                $this->question("--------------------------------");
            } else {
                $this->createDirectory($path, $value);
                $this->generateFiles($this->generateType, $value, $path, $this->domainName);
                $this->info("Domain.generate Dir [ {$value} ] Created Successfully");
            }
        }
    }

    /**
     * Update Config App file.
     * @return void
     */
    public function updateConfigApp() : void
    {
        $this->domainName = Str::title(Str::lower(Str::studly($this->domainName)));
        $configAppFilePath = config_path("app.php");
        $oldValue          = "/*NewDomainsServiceProvider*/";
        $newValue          = "App\\".config("domain.path")."\\{$this->domainName}\Providers\DomainServiceProvider::Class,";
        $newValue         .= "\n\t\t/*NewDomainsServiceProvider*/";
        $newContent        = Str::replaceFirst($oldValue, $newValue, File::get($configAppFilePath));
        File::put($configAppFilePath, $newContent);
        $this->info("App Config File Updated and Added the new Service Provider of Domain");
    }
}
