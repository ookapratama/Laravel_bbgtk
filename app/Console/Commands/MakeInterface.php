<?php

namespace App\Console\Commands;

// use App\Helpers\Helper;
use App\Helpers\Helpers as Helper;
use App\Traits\NameSpaceFixer;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class MakeInterface extends Command
{
    use NameSpaceFixer;

    protected $basePathInterface = 'App\Repositories\Contracts';
    protected $basePathRepository = 'App\Repositories';
    protected $basePathService = 'App\Services';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {interface : The name of the contract}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Interface service and repository';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contractName = $this->argument('interface');

        if ($contractName === '' || is_null($contractName) || empty($contractName)) {
            $this->error('Name Invalid..!');
        }

        $this->createContract($contractName);
        $this->createRepository($contractName);
        $this->createService($contractName);
    }

    /**
     * create Service Contract
     */
    public function createContract($contractName)
    {
        $contractName .= "Interface";
        // create if folder Contracts not exists 
        if (!File::exists($this->getBaseDirectory($this->basePathInterface, $contractName))) {
            File::makeDirectory($this->getBaseDirectory($this->basePathInterface, $contractName), 0777, true);
        }

        $title = Helper::title($contractName);

        $eloquentFileName = 'app/Repositories/Contracts/' . $title . '.php';

        if (!File::exists($eloquentFileName)) {
            $eloquentFileContent = "<?php\n\nnamespace " . $this->basePathInterface
                . ";\n"
                . "\nuse Illuminate\Database\Eloquent\Collection;"
                . "\n\n"
                . "interface " . $contractName
                . "\n{\n"

                . "\t/**"
                . "\n\t * params string \$search"
                . "\n\t * @return Collection"
                . "\n\t*/"

                . "\n\n"
                . "\tpublic function paginated(array \$request);\n}";

            File::put($eloquentFileName, $eloquentFileContent);

            $this->info('Service Interface Created Successfully.');
        } else {
            $this->error('Service Interface Files Already Exists.');
        }
    }


    /**
     * create Repository Contract
     */
    public function createRepository($repoName)
    {
        $repoName .= "Repository";
        // create if folder Contracts not exists 
        if (!File::exists($this->getBaseDirectory($this->basePathRepository, $repoName))) {
            File::makeDirectory($this->getBaseDirectory($this->basePathRepository, $repoName), 0777, true);
        }

        $title = Helper::title($repoName);

        $nameModel = str_replace('Repository', '', $repoName);
        $eloquentFileName = 'app/Repositories/' . $title . '.php';
        $nameContract = str_replace('Repository', 'Interface', $repoName);

        if (!File::exists($eloquentFileName)) {
            $eloquentFileContent = "<?php\n\nnamespace " . $this->basePathRepository
                . ";\n"
                . "\nuse App\Repositories\BaseRepository;"
                . "\nuse App\Repositories\Contracts\\" . $nameContract
                . ";\nuse App\Models\\" . $nameModel

                . ";\n\nclass " . $repoName . " extends BaseRepository implements " . $nameContract
                . "\n{\n"

                . "\t/**"
                . "\n\t * @var"
                . "\n\t */\n"

                . "\tprotected \$model;\n\n"
                . "\tpublic function __construct(" . $nameModel . " \$model)\n"
                . "\t{\n"
                . "\t\tparent::__construct(\$model);\n"
                . "\t}\n\n"

                . "\tpublic function paginated(array \$criteria)"
                . "\n\t{\n"
                . "\t\t\$perPage = \$criteria['per_page'] ?? 5;\n"
                . "\t\t\$field = \$criteria['sort_field'] ?? 'id';\n"
                . "\t\t\$sortOrder = \$criteria['sort_order'] ?? 'desc';\n"
                . "\t\t"
                . "return \$this->model->orderBy(\$field, \$sortOrder)->paginate(\$perPage);"
                . "\n\t}\n"
                . "\n}";


            File::put($eloquentFileName, $eloquentFileContent);

            $this->info('Repository Created Successfully.');
        } else {
            $this->error('Repository Files Already Exists.');
        }
    }

    /**
     * create Service
     */
    public function createService($serviceName)
    {
        $serviceName .= "Service";
        // create if folder Contracts not exists 
        if (!File::exists($this->getBaseDirectory($this->basePathService, $serviceName))) {
            File::makeDirectory($this->getBaseDirectory($this->basePathService, $serviceName), 0777, true);
        }

        $title = Helper::title($serviceName);

        $nameInterface = str_replace('Service', 'Interface', $serviceName);
        $eloquentFileName = 'app/Services/' . $title . '.php';
        $nameContract = str_replace('Service', '', $serviceName);

        if (!File::exists($eloquentFileName)) {
            $eloquentFileContent = "<?php\n\nnamespace " . $this->basePathService
                . ";\n"
                . "\nuse App\Models\\" . $nameContract . ";"
                . "\nuse App\Repositories\Contracts\\" . $nameInterface

                . ";\n\nclass " . $serviceName . " extends BaseService "
                . "\n{\n"

                . "\t/**"
                . "\n\t * @var"
                . "\n\t */\n"

                . "\tprotected \$model;\n\n"
                . "\tpublic function __construct(" . $nameInterface . " \$interface)\n"
                . "\t{\n"
                . "\t\tparent::__construct(\$interface);\n"
                . "\t}\n\n"

                . "\n}";


            File::put($eloquentFileName, $eloquentFileContent);

            $this->info('Service Created Successfully.');
        } else {
            $this->error('Service Files Already Exists.');
        }
    }
}
