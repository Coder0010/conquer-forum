<?php

namespace App\Console\Commands;

use Str;
use Artisan;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Core\Traits\GeneratorHelper;

class CRUDGeneratorCommand extends Command
{
    use GeneratorHelper;

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = "crud:generate
                                {domain : Domain (singular) for example Auth}
                                {name   : Entity (singular) for example User}
                            ";

    /**
     * The console command description.
     * @var string
     */
    protected $description = "Generate CRUD For A Domain";

    /**
     * The domain name.
     * @var string
     */
    protected $domain;

    /**
     * The entity name.
     * @var string
     */
    protected $entity;

    /**
     * The crud typePerfix.
     * @var string
     */
    protected $typePerfix = "Admin";

    /**
     * The crud namespace.
     * @var string
     */
    protected $nameSpace = "AdminPanel";

    /**
     * The path of Domain.
     * @var string
     */
    protected $path;

    /**
     * The naming name.
     * @var array
     */
    protected $naming = [];

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->domain = $this->argument("domain");

            $this->entity = $this->argument("name");
            $this->checkEntityName($this->entity);

            $this->path   = $this->getDomainsPath() . "/" . $this->domain;
            $this->checkDomainIsExisit($this->path);

            $this->naming = $this->getNamingConvensions($this->typePerfix, $this->nameSpace, $this->entity, $this->domain);

            $this->generateCrud();
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }

    /**
     * generate crud files from stubs.
     * @return mixed
     */
    public function generateCrud()
    {
        $this->mainStub("Model", "{$this->path}/Entities/{$this->naming['vals']['word']}.php");
        $this->mainStub("EloquentRepository", "{$this->path}/Repositories/Eloquent/Eloquent{$this->naming['vals']['word']}Repository.php");
        $this->mainStub("Repository", "{$this->path}/Repositories/Contracts/{$this->naming['vals']['word']}Repository.php");
        $bindingEntityfilePath = "{$this->path}/Providers/RepositoryServiceProvider.php";
        $bindingEntityOldValue = "/*Your Repos Here 'interface => eloquent class'*/";
        $bindingEntityNewValue = "\App\Domains\\{$this->naming['vals']['domainName']}\Repositories\Contracts\\{$this->naming['vals']['word']}Repository::class => \App\Domains\\{$this->naming['vals']['domainName']}\Repositories\Eloquent\Eloquent{$this->naming['vals']['word']}Repository::class,\n\t\t" . $bindingEntityOldValue;
        $this->findAndReplace($bindingEntityfilePath, $bindingEntityOldValue, $bindingEntityNewValue);
        $this->mainStub("{$this->typePerfix}Controller", "{$this->path}/Http/Controllers/AdminPanel/{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller.php");
        $this->mainStub("Request", "{$this->path}/Http/Requests/{$this->nameSpace}/{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Request.php");
        $this->createMigration();
        $this->views();
        $this->routes();
    }

    /**
     * generate Migration File.
     * @return void
     */
    public function createMigration(): void
    {
        try {
            Artisan::call("make:migration create_{$this->naming['vals']['wordPluralLowerCase']}_table --path=app/{$this->naming['vals']['domainParentName']}/{$this->domain}/Database/Migrations/");
            $migrationsPath = $this->path . '/Database/Migrations/';
            $scannedDir = scandir($migrationsPath, SCANDIR_SORT_DESCENDING);
            if (count($scannedDir)) {
                $file = $scannedDir[0];
                $migrationOldValue   = '$table->id();';
                $migrationNewValue  = '$table->increments(\'id\',11)->key()->unsigned(false);'."\n\t\t\t";
                $migrationNewValue .= '$table->string(\'name_en\');'."\n\t\t\t";
                $migrationNewValue .= '$table->string(\'name_ar\')->nullable();'."\n\t\t\t";
                $migrationNewValue .= '$table->longText(\'data\')->nullable();'."\n\t\t\t";
                $migrationNewValue .= '$table->string(\'order\')->default(0);'."\n\t\t\t";
                $migrationNewValue .= '$table->enum(\'status\',[config(\'system.status\')])->default(config(\'system.status.deactivate\'));'."\n\t\t\t";
                $migrationNewValue .= '$table->softDeletes();'."\n\t\t\t";
                $fileContent = File::get($migrationsPath . "/" . $file);
                $newContent = str_replace($migrationOldValue, $migrationNewValue, $fileContent);
                File::put($migrationsPath . '/' . $file, $newContent);
                $this->info("Migration File Created {$file}");
            }
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }

    /**
     * findAndReplace.
     * @param string $filePath
     * @param string $oldValue
     * @param string $newValue
     * @return void
     */
    public function findAndReplace(string $filePath, string $oldValue, string $newValue) : void
    {
        try {
            if (!File::exists($filePath)) {
                $this->error("This File {$filePath} Isn't exisit");
                return;
            }
            $fileContent  = File::get($filePath);
            if (Str::contains($fileContent, $newValue)) {
                $this->warn("New Content to Replace Is Already Exisit");
                return;
            }
            $newContent   = str_replace($oldValue, $newValue, $fileContent);
            File::put($filePath, $newContent);
            $this->info($oldValue);
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }

    /**
     * Generates The mainStub.
     * @param string $fileName
     * @param string $newFilePath
     * @return void
     */
    public function mainStub(string $fileName, string $newFilePath) : void
    {
        $filePath = explode("/", $newFilePath);
        $stubFile = array_pop($filePath);
        $dirPath  = implode($filePath, "/");

        if (!File::exists($dirPath)) {
            $this->warn("This Folder Path [ {$dirPath} ] For {$fileName} Not Exisit");
            return;
        }

        $oldValues     = $this->naming["keys"];
        $newValues     = $this->naming["vals"];
        $modelStubFile = $this->getStub("crud", $fileName);
        $stub          = str_replace($oldValues, $newValues, $modelStubFile);
        if (!File::exists($newFilePath)) {
            File::put($newFilePath, $stub);
            $this->info("{$fileName} [ {$this->naming['vals']['word']} ] Created Successfully & Added to {$this->nameSpace} NameSpace");
        } else {
            $this->warn("{$fileName} [ {$this->naming['vals']['word']} ] File Is Already Eixist at NameSpace {$this->nameSpace}");
        }
    }

    /**
     * Generate Route.
     * @return void
     */
    public function routes() : void
    {
        if ($this->naming["vals"]["nameSpace"] == "AdminPanel") {
            $adminRouteFilePath = "{$this->path}/Routes/admin.php";
            $adminRouteOldValue = "/*AddAdminRoutesCrud*/";
            $adminRouteNewValue = "\n\tRoute::resource('{$this->naming['vals']['wordPluralLowerCase']}', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller')->except(['show',]);\n\t";
            $adminRouteNewValue .= "Route::group(['as' => '{$this->naming['vals']['wordPluralLowerCase']}.'], function () {\n\t";
            $adminRouteNewValue .= "\tRoute::get('{$this->naming['vals']['wordPluralLowerCase']}/{{$this->naming['vals']['wordSingularLowerCase']}}/changeStatus', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@changeStatus')->name('changeStatus');\n\t";
            $adminRouteNewValue .= "\tRoute::delete('{$this->naming['vals']['wordPluralLowerCase']}/{{$this->naming['vals']['wordSingularLowerCase']}}/delete', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@delete')->name('delete');\n\t";
            $adminRouteNewValue .= "\tRoute::post('{$this->naming['vals']['wordPluralLowerCase']}/{{$this->naming['vals']['wordSingularLowerCase']}}/restore', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@restore')->name('restore');\n\t";
            $adminRouteNewValue .= "\tRoute::post('{$this->naming['vals']['wordPluralLowerCase']}/multi-delete', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@multiDelete')->name('multi.delete');\n\t";
            $adminRouteNewValue .= "\tRoute::post('{$this->naming['vals']['wordPluralLowerCase']}/multi-restore', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@multiRestore')->name('multi.restore');\n\t";
            $adminRouteNewValue .= "\tRoute::post('{$this->naming['vals']['wordPluralLowerCase']}/multi-order', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller@multiOrder')->name('multi.order');\n\t";
            $adminRouteNewValue .= "});\n\t";
            $adminRouteNewValue .= $adminRouteOldValue;
            $this->findAndReplace($adminRouteFilePath, $adminRouteOldValue, $adminRouteNewValue);
        } elseif ($this->naming["vals"]["nameSpace"] == "EndUser") {
            $webRouteFilePath = "{$this->path}/Routes/web.php";
            $webRouteOldValue = "/*AddWebRoutesCrud*/";
            $webRouteNewValue = "Route::resource('/{$this->naming['vals']['wordPluralLowerCase']}', '{$this->typePerfix}{$this->naming['vals']['wordPluralCase']}Controller')->except(['create', 'destory']); \n \t".$webRouteOldValue;
            $this->findAndReplace($webRouteFilePath, $webRouteOldValue, $webRouteNewValue);
        }
    }

    /**
     * Generate Views.
     * @return void
     */
    public function views() : void
    {
        try {
            $this->nameSpace = Str::lower($this->nameSpace);

            for ($i = 0; $i < 3; $i++) {
                $stubsFolderName = "views/{$this->nameSpace}";
                if ($i == 1) {
                    $stubsFolderName .= "/_modal";
                } elseif ($i == 2) {
                    $stubsFolderName .= "/_form";
                }

                foreach (glob(base_path("resources/stubs/crud/$stubsFolderName/*.stub")) as $file) {
                    $filename = explode(".", last(explode("/", $file)))[0];

                    $domainFolderName = $this->nameSpace ."/". $this->naming["vals"]["wordPluralLowerCase"];
                    if ($i == 1) {
                        $domainFolderName .= "/_modal";
                    } elseif ($i == 2) {
                        $domainFolderName .= "/_form";
                    }

                    $this->createDirectory("{$this->path}/Resources/Views", $domainFolderName);

                    $stub = str_replace($this->naming["keys"], $this->naming["vals"], File::get($file));

                    File::put("{$this->path}/Resources/Views/{$domainFolderName}/{$filename}.blade.php", $stub);
                    $this->info("This Blade File {$filename} Created Successfully");
                }
            }
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }
}
