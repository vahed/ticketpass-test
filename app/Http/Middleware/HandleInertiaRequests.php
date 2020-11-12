<?php

namespace App\Http\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
        ]);
    }
}
