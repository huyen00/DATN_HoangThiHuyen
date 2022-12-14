<?php

namespace App\Http\Middleware;

use App\Http\FileManager;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Resources\UserResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';
    public $fm;
    public function __construct(FileManager $fm)
    {
        $this->fm = $fm;
    }
    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ?  new UserResource($request->user()) :  $request->user(),
                // 'roles'=>  Auth::user()->roles,
                'can' => $request->user() ? $request->user()->getPermissionArray() : [],
                'roles' => $request->user() ? $request->user()->getRolesArray() : [],
                // 'owner' => $request->user() ? User::find($request->user()['created_byId']) : null
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'warning' => $request->session()->get('warning')

                ];
            },
            'locales'=> config('app.locales')
        ]);
    }
}
