<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use App\Helpers\Wizard;
use App\Models\WebAddress;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CheckUrls extends Command
{
    use Wizard;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckUrls:webaddress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the urls are available and update the status and save the content';

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
     * @return void
     */
    public function handle()
    {
        try {
            $web    = new WebAddress();
            $client = new Client();
            $list   = $this->urlsList();

            if ($list->count()) {
                foreach ($list as $item) {
                    $request    = $client->createRequest('GET', $item->url);
                    $response   = $client->send($request);
                    $status     = $response->getStatusCode();
                    $content    = $response->getBody();
                    $webAddress = $web->find($item->id);

                    $data = [
                        'content'     => $content,
                        'status_code' => $status
                    ];
                    $data['visible'] = $status < 400 ? true : false;

                    $webAddress->update($data);
                }
            }

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            Wizard::createLog($className,$error);
        }
    }

    /**
     * Get urls list
     *
     * @return Collection
     */
    public function urlsList(): Collection
    {
        return (new WebAddress())->whereNull('content')->get();
    }
}
