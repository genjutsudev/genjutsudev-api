<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeasureExecutionTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $begin = $this->getCurrentTime();

        $response = $next($request);

        $executionTime = $this->calculateExecutionTime($begin);

        return $this->addExecutionTimeToResponse($response, $executionTime);
    }

    /**
     * Get the current time in microseconds.
     *
     * @return float
     */
    private function getCurrentTime(): float
    {
        return microtime(true);
    }

    /**
     * Calculate the execution time in milliseconds.
     *
     * @param  float  $startTime
     * @return int
     */
    private function calculateExecutionTime(float $startTime): int
    {
        return (int) floor((microtime(true) - $startTime) * 1000);
    }

    /**
     * Add execution time to the JSON response if applicable.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @param  int  $executionTime
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function addExecutionTimeToResponse(Response $response, int $executionTime): Response
    {
        if (! $response instanceof JsonResponse) {
            return $response;
        }

        if ($this->isResultStructureInvalid($data = $response->getData(true))) {
            return $response;
        }

        $data['result'] = array_merge([
            'time' => $executionTime . 'ms'
        ], $data['result']);

        $response->setData($data);

        return $response;
    }

    /**
     * Check if the result structure is invalid.
     *
     * @param  array  $data
     * @return bool
     */
    private function isResultStructureInvalid(array $data): bool
    {
        return ! isset($data['result']) || ! is_array($data['result']);
    }
}
