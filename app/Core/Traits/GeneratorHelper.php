<?php

namespace App\Core\Traits;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait GeneratorHelper
{
    /**
     * Check Given Name is singular or not.
     * @return array
     */
    public function checkEntityName(string $name) : void
    {
        if ($name == Str::plural($name)) {
            $this->error("Crud name should be Singular");
            exit;
        }
    }

    /**
     * Check Given Domain Name is Exisit or not.
     * @return array
     */
    public function checkDomainIsExisit(string $name) : void
    {
        if (!File::exists($name)) {
            $this->error("This Domain Is Not Exisit");
            exit;
        }
    }

    /**
     * Get Domain Files Structure.
     * @return array
     */
    public function getDomainFilesStructure() : array
    {
        return config("domain.structure");
    }

    /**
     * Get The Domains Path.
     * Check if Domain Folder if Exisit or not then return it"s path
     * @return string
     */
    public function getDomainsPath() : string
    {
        $fpath = app_path(config("domain.path"));
        if (!File::exists($fpath)) {
            File::makeDirectory($fpath);
        }
        return $fpath;
    }

    /**
     * Get Naming Convensions.
     * @param  string $word
     * @return array
     */
    public function getNamingConvensions(string $typePerfix = "", string $nameSpace = "", string $word, string $domain = null) : array
    {
        $word                  = Str::title(Str::lower(Str::studly($word)));
        $wordPluralCase        = Str::plural($word);
        $wordSingularLowerCase = Str::snake(Str::singular($word));
        $wordPluralLowerCase   = Str::snake(Str::plural($word));
        $domainParentName      = config("domain.path");
        $domainName            = Str::title(Str::lower(Str::studly($domain)));
        $domainAlias           = Str::snake(Str::plural($domain));

        $keys = [
            "{{typePerfix}}",
            "{{typePerfixSingularLowerCase}}",
            "{{nameSpace}}",
            "{{nameSpaceSingularLowerCase}}",
            "{{word}}",
            "{{wordPluralCase}}",
            "{{wordSingularLowerCase}}",
            "{{wordPluralLowerCase}}",
            "{{domainParentName}}",
            "{{domainName}}",
            "{{domainAlias}}"
        ];

        $vals = [
            "typePerfix"                   => $typePerfix,
            "typePerfixSingularLowerCase"  => Str::lower($typePerfix),
            "nameSpace"                    => $nameSpace,
            "nameSpaceSingularLowerCase"   => Str::lower($nameSpace),
            "word"                         => $word,
            "wordPluralCase"               => $wordPluralCase,
            "wordSingularLowerCase"        => $wordSingularLowerCase,
            "wordPluralLowerCase"          => $wordPluralLowerCase,
            "domainParentName"             => config("domain.path"),
            "domainName"                   => $domainName,
            "domainAlias"                  => $domainAlias,
        ];

        /*   */
        $headers = ["key", "value"];
        $combine = array_combine($keys, $vals);
        foreach ($combine as $key => $value) {
            $data[] = [ "key" => $key, "val" => $value ];
        }
        $this->table($headers, $data);
        /*   */

        return [
            "keys" => $keys,
            "vals" => $vals,
        ];
    }

    /**
     * Get The Stub File Contents.
     * @param  string $path
     * @param  string $type
     * @return string
     */
    protected function getStub(string $path, string $type) : string
    {
        $fpath = resource_path("stubs/{$path}/{$type}.stub");

        if (File::exists($fpath)) {
            return File::get($fpath);
        }
        $this->error("The Requested Stub [ {$type} ] Does Not Exist");
        exit;
    }

    /**
     * Create New Directory
     * @param $path
     * @param $directory
     */
    public function createDirectory($path, $directory) : void
    {
        if (!File::isDirectory($path . "/" . $directory)) {
            File::makeDirectory($path . "/" . $directory);
            $this->comment("----Helper.createDirectory For [ {$directory} ] Created Successfully----");
        }
    }

    /**
     * Generate Files.
     * @param  string $type [ Domain Or Crud]
     * @param  string $folder [ Folder Came from Structure Config("domain") ]
     * @param  string $path [ Path of Domain Or Crud ]
     * @param  string $domain
     * @return void
     */
    public function generateFiles(string $type, string $folder, string $path, string $domain) : void
    {
        try {
            $filesPath = resource_path("stubs/$type/$folder");

            if (File::exists($filesPath)) {
                $this->comment("--------==/*Start Helper.generateFiles for [ $folder ]*\==--------");
                $names = $this->getNamingConvensions($domain, $domain, $domain, $domain);

                foreach (glob($filesPath . "/*.stub") as $file) {
                    $fileName = explode(".", last(explode("/", $file)))[0];

                    $this->comment("----This File => $fileName Copied Successfully----");

                    $cpfile = $path . "/" . $folder . "/" . $fileName . ".php";

                    File::copy($file, $cpfile);

                    File::put($cpfile, str_replace($names["keys"], $names["vals"], File::get($cpfile)));
                }
                $this->comment("--------==/*Finish Helper.generateFiles for [ $folder ]*\==--------");
            }
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }
}
