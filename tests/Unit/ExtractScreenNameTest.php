<?php

namespace Tests\Unit;

use App\Http\Controllers\TwitterController;
use ReflectionMethod;
use Tests\TestCase;

class ExtractScreenNameTest extends TestCase
{
    private function extract($tweetResult, $tweetLegacy = null)
    {
        $method = new ReflectionMethod(TwitterController::class, 'extractScreenName');
        $method->setAccessible(true);

        return $method->invoke(new TwitterController, $tweetResult, $tweetLegacy);
    }

    public function test_reads_screen_name_from_user_legacy(): void
    {
        $tweetResult = json_decode(json_encode([
            'core' => ['user_results' => ['result' => ['legacy' => ['screen_name' => 'NWSWPC']]]],
        ]));

        $this->assertSame('NWSWPC', $this->extract($tweetResult));
    }

    public function test_reads_screen_name_from_user_core_in_newer_responses(): void
    {
        $tweetResult = json_decode(json_encode([
            'core' => ['user_results' => ['result' => ['core' => ['screen_name' => 'NWSWPC']]]],
        ]));

        $this->assertSame('NWSWPC', $this->extract($tweetResult));
    }

    public function test_reads_screen_name_from_singular_user_result_key(): void
    {
        $tweetResult = json_decode(json_encode([
            'core' => ['user_result' => ['result' => ['core' => ['screen_name' => 'NWSWPC']]]],
        ]));

        $this->assertSame('NWSWPC', $this->extract($tweetResult));
    }

    public function test_falls_back_to_handle_embedded_in_expanded_url(): void
    {
        $tweetResult = json_decode(json_encode(['core' => new \stdClass]));
        $tweetLegacy = json_decode(json_encode([
            'extended_entities' => ['media' => [
                ['expanded_url' => 'https://x.com/NWSWPC/status/2104666425897918502/photo/1'],
            ]],
        ]));

        $this->assertSame('NWSWPC', $this->extract($tweetResult, $tweetLegacy));
    }

    public function test_returns_empty_string_when_unresolvable(): void
    {
        $this->assertSame('', $this->extract(json_decode('{}')));
    }
}
