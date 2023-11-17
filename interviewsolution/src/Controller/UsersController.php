<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Service\QueryParameterExtractor;
use App\Service\CacheService;
use App\Formatter\UserResponseFormatter;

class UsersController extends AbstractController
{
    /**
     * List the users
     *
     * This call allows to filter by  `isActive`, `isMember`, `lastLoginAtFrom`, `lastLoginAtTo` and `userType[]`
     *
     * @Route("/api/users", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of users",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"full"}))
     *     )
     * )
     * @OA\Parameter(
     *     name="isActive",
     *     in="query",
     *     description="Filter by isActive true or false",
     *     @OA\Schema(type="boolean"),
     *     required=false
     * )
     * @OA\Parameter(
     *     name="isMember",
     *     in="query",
     *     description="Filter by isMember true or false",
     *     @OA\Schema(type="boolean"),
     *     required=false
     * )
     * @OA\Parameter(
     *     name="lastLoginAtFrom",
     *     in="query",
     *     description="Filter lastLoginAt greater than provided value",
     *     @OA\Schema(type="string", format="date", pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/"),
     *     required=false
     * )
     * @OA\Parameter(
     *     name="lastLoginAtTo",
     *     in="query",
     *     description="Filter lastLoginAt less than provided value",
     *     @OA\Schema(type="string", format="date", pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/"),
     *     required=false
     * )
     * @OA\Parameter(
     *     name="userType[]",
     *     in="query",
     *     description="Filter userType, accepts more than one value at the same time",
     *     @OA\Schema(
     *          type="array",
     *          @OA\Items(type="integer", enum={1, 2, 3}),
     *          collectionFormat="multi"
     *      ),
     *      required=false
     * )
     * @OA\Tag(name="users")
     */
    public function index(Request $request, UserRepository $userRepository, CacheService $cacheService, QueryParameterExtractor $parameterExtractor): JsonResponse
    {
        //Extract parameters from http request
        $params = $parameterExtractor->extract($request);

        //Define cache key based on query parameters
        $cacheKey = urlencode(json_encode($params));

        //Retrieve data from cache or DB
        $users = $cacheService->getOrSetCacheItem($cacheKey, function() use ($userRepository, $params) {
            return $userRepository->findUsersByFilters(...$params);
        });

        //Return formatted response
        return $this->json(UserResponseFormatter::format($users));
    }
}
