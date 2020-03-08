<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace App\Http\Middleware;

use App\Services\ProfileService;
use Closure;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;

class Json
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * CREATE CORS MIDDLEWARE
     * @param $request
     * @param Closure $next
     * @return Closure
     */

    public function handle(Request $request, Closure $next)
    {

        try {
            if ($request->user()){
                $profile = $this->profileService->getProfileByUser();
                $request->request->add([
                    'profileId' => $profile->get('id'),
                    'userId' => $profile->get('userId'),
                ]+$request->all());
            }else{
                throw new NotFound('user not found');
            }

        } catch (NotFound $e) {
            $request->request->add([
                'profileId' => null,
                'userId' => null,
            ]+$request->all());
        }

        if ($request->has('data')) {
            $request->request->add($request->get('data'));
        }

        return $next($request);

    }
}
