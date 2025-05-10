<?php

namespace App\Console\Commands;

use App\Jobs\MqttSubscribeJob;
use App\Models\Esps;
use App\Models\Linhas;
use App\Models\LinhasEsps;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen mqtt client subscribe esp32 - linha 04';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $server = env('MQTT_BROKER_SERVE', 'localhost');
        $port = env('MQTT_BROKER_PORT', 1883);
        $clientId = env('MQTT_CLIENT_ID', 'wandchain-') . rand();

        $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
        $mqtt->connect();
        echo sprintf("Mqtt Conected With Success " . $clientId);
        $mqtt->subscribe('jws/#', function ($topic, $message, $retained, $matchedWildcards) {
            $data = [];

            if (str_contains($topic, "data")) {
                $data['data'] = json_decode($message, true);

            }

            if (str_contains($topic, "device")) {
                $data['device'] = json_decode($message, true);
            }

            if (str_contains($topic, "error")) {
                $data['error'] = json_decode($message, true);
            }
            echo sprintf("Received message on topic [%s]: %s\n", $topic, json_encode($data));

            // MqttSubscribeJob::dispatch($data);
        }, 1);

        $mqtt->loop(true);

        $mqtt->disconnect();
    }
}
