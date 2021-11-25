<?php

namespace SparrowSilence\OperationLog\Http\Middleware;

use Closure;
use Dcat\Admin\Admin;
use Dcat\Admin\Support\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SparrowSilence\OperationLog\Models\OperationLog;
use SparrowSilence\OperationLog\OperationLogServiceProvider;

class LogOperation
{
    protected array $secretFields = [
        'password',
        'password_confirmation',
    ];

    protected array $except = [
        'sparrow-silence.operation-log.*',
    ];

    protected array $defaultAllowedMethods = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'];

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->shouldLogOperation($request)) {
            $user = Admin::user();

            $log = [
                'user_id' => $user ? $user->id : 0,
                'path' => substr($request->path(), 0, 255),
                'method' => $request->method(),
                'ip' => $request->getClientIp(),
                'input' => $this->formatInput($request->input()),
            ];

            try {
                OperationLog::create($log);
            }catch (\Exception $exception) {
                // pass
            }
        }
        return $next($request);
    }

    /**
     * @param array $input
     * @return false|string
     */
    protected function formatInput(array $input): bool|string
    {
        foreach ($this->getSecretFields() as $field) {
            if ($field && !empty($input[$field])) {
                $input[$field] = Str::limit($input[$field], 3, '******');
            }
        }
        return json_encode($input, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    protected function setting($key, $default = null): mixed
    {
        return OperationLogServiceProvider::setting($key, $default);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function shouldLogOperation(Request $request): bool
    {
        return !$this->inExceptArray($request)
            && $this->inAllowedMethods($request->method());
    }

    /**
     * Whether requests using this method are allowed to be logged.
     * @param string $method
     * @return bool
     */
    protected function inAllowedMethods(string $method): bool
    {
        $allowedMethods = collect($this->getAllowedMethods())->filter();

        if ($allowedMethods->isEmpty()) {
            return true;
        }

        return $allowedMethods->map(function ($method) {
           return strtoupper($method);
        })->contains($method);
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     * @param $request
     * @return bool
     */
    protected function inExceptArray($request): bool
    {
        if ($request->routeIs(admin_api_route_name('value'))) {
            return true;
        }

        foreach ($this->except() as $except) {
            if ($request->routeIs($except)) {
                return true;
            }

            $except = admin_base_path($except);
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if (Helper::matchRequestPath($except)) {
                return true;
            }
        }
        return false;
    }

    protected function except(): array
    {
        return array_merge((array)$this->setting('except'), $this->except);
    }

    protected function getSecretFields(): array
    {
        return array_merge((array)$this->setting('secret_fields'), $this->secretFields);
    }

    protected function getAllowedMethods(): array
    {
        return (array)($this->setting('allowed_methods') ?: $this->defaultAllowedMethods);
    }
}
